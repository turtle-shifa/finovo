<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Stock;
use App\Models\Outbound;
use App\Models\OutboundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CompanyFinancial;

class OutboundController extends Controller
{
    public function create(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to sell products.');
        }

        $company = Company::where('user_id', session('user_id'))->first();
        if (!$company) {
            return redirect('/company-create')->with('error','You must have a company to sell products.');
        }

        $query = Stock::with('product')
            ->where('company_id', $company->id)
            ->where('quantity', '>', 0)
            ->whereRelation('product', 'is_active', 1);

        $stocks = $query->orderBy('product_id')->orderByDesc('created_at')->get();

        $lines = 5;
        return view('outbound-multiline', compact('stocks', 'lines', 'company'));
    }

    public function store(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to sell products.');
        }

        $company = Company::where('user_id', session('user_id'))->firstOrFail();

        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_address' => 'nullable|string|max:2000',
            'tax_rate'         => 'nullable|numeric|min:0|max:100',
            'delivery_fee'     => 'nullable|numeric|min:0',
            'items'            => 'required|array',
            'items.*.stock_id' => 'nullable|exists:stocks,id',
            'items.*.quantity' => 'nullable|integer|min:1',
        ]);

        $rawItems = $request->items ?? [];
        $filtered = [];
        foreach ($rawItems as $row) {
            if (!empty($row['stock_id']) && !empty($row['quantity'])) {
                $filtered[] = [
                    'stock_id' => (int)$row['stock_id'],
                    'quantity' => (int)$row['quantity'],
                ];
            }
        }

        if (count($filtered) === 0) {
            return back()->with('error', 'Please add at least one line item.')->withInput();
        }

        $taxRate     = (float)($request->tax_rate ?? 0);
        $deliveryFee = (float)($request->delivery_fee ?? 0);

        DB::beginTransaction();

        $lineItems = [];
        $subtotal  = 0;

        foreach ($filtered as $idx => $entry) {
            // $idx = 0; $entry = ['stock_id' => 12, 'quantity' => 3];
            $stock = Stock::where('id', $entry['stock_id'])
                ->where('company_id', $company->id)
                ->lockForUpdate()
                ->first();

            if (!$stock) {
                DB::rollBack();
                return back()->with('error', "Invalid batch selected on line ".($idx+1).".")->withInput();
            }

            // Check stock quantity
            if ($entry['quantity'] > $stock->quantity) {
                DB::rollBack();
                return back()->with('error', "Not enough stock for batch {$stock->batch_number} on line ".($idx+1).".")->withInput();
            }

            $unitPrice = (float)$stock->selling_price;
            $qty       = (int)$entry['quantity'];
            $lineSub   = round($unitPrice * $qty, 2);

            $lineItems[] = [
                'stock'      => $stock,
                'quantity'   => $qty,
                'unit_price' => $unitPrice,
                'subtotal'   => $lineSub,
            ];

            $subtotal += $lineSub;
        }

        $taxRate   = (float)($request->tax_rate ?? 0);
        $deliveryFee = (float)($request->delivery_fee ?? 0);
        $taxAmount = round(($subtotal * $taxRate) / 100, 2);
        $total     = $subtotal + $taxAmount + $deliveryFee;

        $outbound = Outbound::create([
            'company_id'       => $company->id,
            'customer_name'    => $request->customer_name,
            'customer_address' => $request->customer_address,
            'subtotal'         => $subtotal,
            'tax_rate'         => $taxRate,
            'tax_amount'       => $taxAmount,
            'delivery_fee'     => $deliveryFee,
            'total_amount'     => $total,
            'invoice_number'   => 'INV-'.strtoupper(Str::random(8)),
        ]);


        foreach ($lineItems as $li) {
            OutboundItem::create([
                'outbound_id' => $outbound->id,
                'stock_id'    => $li['stock']->id,
                'quantity'    => $li['quantity'],
                'unit_price'  => $li['unit_price'],
                'subtotal'    => $li['subtotal'],
            ]);

            $li['stock']->decrement('quantity', $li['quantity']);
        }

        DB::commit();

        $company->transactions()->create([
            'type' => 'outbound',
            'description' => route('outbound.invoice', $outbound->id),
            'amount' => $total, // invoice total
            'created_at' => now(),
        ]);

        $companyFinancial = CompanyFinancial::firstOrCreate(
            ['company_id' => $company->id],
            ['total_cost' => 0, 'total_revenue' => 0]
        );

        $companyFinancial->total_revenue += $total;
        $companyFinancial->save();

        return redirect()->route('outbound.invoice', $outbound->id)
            ->with('success', 'Invoice generated successfully.');
        }

    public function invoice($id)
    {
        $company = Company::where('user_id', session('user_id'))->firstOrFail();

        $outbound = Outbound::with(['items.stock.product'])
            ->where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        return view('outbound-invoice', compact('outbound', 'company'));
    }

    public function pdf($id)
    {
        $company = Company::where('user_id', session('user_id'))->firstOrFail();

        $outbound = Outbound::with(['items.stock.product'])
            ->where('id', $id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $pdf = \PDF::loadView('outbound-invoice-pdf', compact('outbound', 'company'));
        return $pdf->download($outbound->invoice_number.'.pdf');
    }
}
