<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Outbound;
use App\Models\Stock;
use App\Models\ReturnModel;
use App\Models\ReturnItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyFinancial;

class ReturnController extends Controller
{
    public function create()
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error', 'You must be logged in to process returns.');
        }

        return view('return');
    }


    public function fetchInvoice(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error', 'You must be logged in to process returns.');
        }

        $request->validate([
            'invoice_number' => 'required|string'
        ]);

        $company = Company::where('user_id', session('user_id'))->first();
        if (!$company) {
            return redirect('/company-create')->with('error', 'You must have a company to process returns.');
        }

        $outbound = Outbound::with(['items.stock.product'])
            ->where('invoice_number', $request->invoice_number)
            ->where('company_id', $company->id)
            ->first();

        if (!$outbound) {
            return back()->with('error', 'Invoice not found.');
        }

        return view('return', compact('outbound'));
    }


    public function store(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error', 'You must be logged in to process returns.');
        }

        $request->validate([
            'outbound_id' => 'required|exists:outbounds,id',
            'items' => 'required|array',
            'items.*.stock_id' => 'required|exists:stocks,id',
            'items.*.quantity' => 'nullable|integer|min:0',
        ]);

        $company = Company::where('user_id', session('user_id'))->firstOrFail();
        $outbound = Outbound::with('items')->where('id', $request->outbound_id)
            ->where('company_id', $company->id)
            ->firstOrFail();

        $rawItems = $request->items;
        $subtotal = 0;

        DB::beginTransaction();

        $return = ReturnModel::create([
            'outbound_id' => $outbound->id,
            'company_id' => $company->id,
            'customer_name' => $outbound->customer_name,
            'total_amount' => 0,
        ]);

        foreach ($rawItems as $item) {

            $qty = (int)($item['quantity'] ?? 0);
            if ($qty <= 0) continue;

            $stock = Stock::findOrFail($item['stock_id']);

            $soldQty = $outbound->items->where('stock_id', $stock->id)->first()->quantity ?? 0;
            $alreadyReturnedQty = ReturnItem::whereHas('return', function($q) use ($outbound, $company){
                $q->where('outbound_id', $outbound->id)
                  ->where('company_id', $company->id);
            })->where('stock_id', $stock->id)->sum('quantity');

            $remainingQty = $soldQty - $alreadyReturnedQty;

            if ($remainingQty <= 0) {
                DB::rollBack();
                return back()->with('error', "No remaining quantity available to return for {$stock->batch_number}.");
            }

            if ($qty > $remainingQty) {
                DB::rollBack();
                return back()->with('error', "Return quantity cannot exceed remaining quantity ({$remainingQty}) for batch {$stock->batch_number}.");
            }

            $unitPrice = (float)$stock->selling_price;
            $lineSubtotal = round($qty * $unitPrice, 2);

            ReturnItem::create([
                'return_id' => $return->id,
                'stock_id' => $stock->id,
                'quantity' => $qty,
                'unit_price' => $unitPrice,
                'subtotal' => $lineSubtotal,
            ]);

            $stock->increment('quantity', $qty);

            $subtotal += $lineSubtotal;
        }

        $return->update(['total_amount' => $subtotal]);

        DB::commit();

        $company->transactions()->create([
            'type' => 'return',
            'description' => route('outbound.invoice', $outbound->id),
            'amount' => $subtotal,
            'created_at' => now(),
        ]);

        $companyFinancial = CompanyFinancial::firstOrCreate(
            ['company_id' => $company->id],
            ['total_cost' => 0, 'total_revenue' => 0]
        );

        $companyFinancial->total_revenue -= $subtotal;
        $companyFinancial->save();

        return redirect()->route('return.create')->with('success', 'Items returned successfully.');
    }
}