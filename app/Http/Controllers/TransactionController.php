<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Transaction;
use App\Models\CompanyFinancial;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to view transactions.');
        }

        $company = Company::where('user_id', session('user_id'))->firstOrFail();

        $query = $company->transactions()->latest();


        if ($request->filled('type') && in_array($request->type, ['inbound', 'outbound', 'return'])) {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->paginate(10)->withQueryString();

        return view('transactions', compact('transactions'));
    }


    public function createOpex()
    {
        return view('create_opex');
    }

public function storeOpex(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'note' => 'nullable|string|max:255',
        ]);

        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error','You must be logged in to add OPEX.');
        }

        $company = Company::where('user_id', session('user_id'))->firstOrFail();

        Transaction::create([
            'company_id' => $company->id,
            'type' => 'opex',
            'amount' => $request->amount,
            'description' => $request->note ?? 'Operating Expense',
        ]);

        $companyFinancial = CompanyFinancial::firstOrCreate(
            ['company_id' => $company->id],
            ['total_cost' => 0, 'total_revenue' => 0]
        );

        $companyFinancial->total_cost += $request->amount;
        $companyFinancial->save();

        return redirect()->route('transactions.index')->with('success', 'Operating expense added successfully!');
    }
}