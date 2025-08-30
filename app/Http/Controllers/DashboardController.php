<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyFinancial;
use App\Models\User;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/signin')->with('error', 'You must be logged in.');
        }

        $user = User::find(session('user_id'));

        $company = $user->company;
        if (!$company) {
            return redirect('/company-create')->with('error', 'Please create a company first.');
        }

        $financial = CompanyFinancial::firstOrCreate(
            ['company_id' => $company->id],
            ['total_cost' => 0, 'total_revenue' => 0]
        );

        $totalCost = $financial->total_cost;
        $totalRevenue = $financial->total_revenue;
        $totalProfit = $totalRevenue - $totalCost;

        $profitMargin = $totalRevenue > 0 ? ($totalProfit / $totalRevenue) * 100 : 0;
        $profitMargin = round($profitMargin, 2);


        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $company = Company::find($company->id);

        $query = $company->transactions();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $inboundTotal = (clone $query)->where('type', 'inbound')->sum('amount');
        $opexTotal = (clone $query)->where('type', 'opex')->sum('amount');
        $outboundTotal = (clone $query)->where('type', 'outbound')->sum('amount');
        $returnTotal = (clone $query)->where('type', 'return')->sum('amount');

        $filteredCost = $inboundTotal + $opexTotal;
        $filteredRevenue = $outboundTotal - $returnTotal;
        $filteredProfit = $filteredRevenue -  $filteredCost;

        $totalProducts = $company->products()->count();
        $totalStock = $company->stocks()->sum('quantity');
        $totalItemsSold = $company->outboundItems()->sum('quantity');

        $monthlySales = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlySales[] = $company->outboundItems()
                ->whereYear('outbound_items.created_at', now()->year)
                ->whereMonth('outbound_items.created_at', $m)
                ->sum('quantity');
        }

        return view('dashboard', compact(
            'company',
            'totalCost',
            'totalRevenue',
            'totalProfit',
            'profitMargin',
            'filteredCost',
            'filteredRevenue',
            'filteredProfit',
            'totalProducts',
            'totalStock',
            'totalItemsSold',
            'monthlySales'
        ));
    }
}
