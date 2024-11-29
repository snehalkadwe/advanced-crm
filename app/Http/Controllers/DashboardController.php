<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Date range filtering
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Total customers
        $totalCustomers = Customer::count();

        // Total sales value
        $totalSalesValue = Sale::whereBetween('created_at', [$startDate, $endDate])->sum('amount');

        // Monthly sales trends (grouped by month)
        $monthlySalesTrends = Sale::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top 5 customers by sales value
        $topCustomers = Customer::select('customers.id', 'customers.name', DB::raw('SUM(sales.amount) as total_sales'))
            ->join('sales', 'customers.id', '=', 'sales.customer_id')
            ->whereBetween('sales.created_at', [$startDate, $endDate])
            ->groupBy('customers.id', 'customers.name')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalSalesValue',
            'monthlySalesTrends',
            'topCustomers',
            'startDate',
            'endDate'
        ));
    }
}
