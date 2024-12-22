<?php

namespace App\Http\Controllers;

use App\Models\CargoService;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Management;
use Illuminate\Support\Facades\Log;
use \App\Models\User;
use \App\Models\TruckDriver;
use \App\Models\Customer;
use App\Models\Expenses;
use \App\Models\Income;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminHome(): View
    {

        $hr = User::where('type', 'hr')->count();
        $accountant = User::where('type', 'accountant')->count();
        $servicemanager = User::where('type', 'servicemanager')->count();
        $driver = TruckDriver::count();
        $users = Customer::count();
        $suspendedemployee = User::where('status', 'suspended')->count();
        $suspendeduser =  Customer::where('status', 'suspended')->count();

        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonths(12)->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();

        $visitCounts = DB::table('website_visits')
            ->selectRaw('YEAR(visited_at) as year, MONTH(visited_at) as month, COUNT(*) as count')
            ->whereBetween('visited_at', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(visited_at), MONTH(visited_at)'))
            ->orderBy(DB::raw('YEAR(visited_at), MONTH(visited_at)'))
            ->get();

        $months = [];
        $data = [];

        for ($month = $startDate; $month->lte($endDate); $month->addMonth()) {

            $months[] = $month->format('M Y');
            $data[] = 0;
        }


        foreach ($visitCounts as $visit) {
            $visitMonth = Carbon::create($visit->year, $visit->month, 1);
            $index = array_search($visitMonth->format('M Y'), $months);
            if ($index !== false) {
                $data[$index] = $visit->count;
            }
        }



        return view('dashboard.admin', compact('hr', 'accountant', 'servicemanager', 'driver', 'data', 'months', 'users', 'suspendeduser', 'suspendedemployee'));
    }

    public function accountantHome(): View
    {
        $currentMonthTotal = Income::where('confirm', 1)->whereMonth('created_at', now()->month)
            ->sum('amount');

        $lastMonthTotal = Income::where('confirm', 1)->whereMonth('created_at', now()->subMonth()->month)
            ->sum('amount');

        if ($lastMonthTotal > 0) {
            $growthPercentage = (($currentMonthTotal - $lastMonthTotal) / $lastMonthTotal) * 100;
        } else {
            $growthPercentage = 0;
        }
        $growthPercentage = round($growthPercentage, 2);


        $ExpensescurrentMonthTotal = Expenses::whereMonth('created_at', now()->month)
            ->sum('amount');

        $ExpenseslastMonthTotal = Expenses::whereMonth('created_at', now()->subMonth()->month)
            ->sum('amount');

        if ($ExpenseslastMonthTotal > 0) {
            $ExpensesgrowthPercentage = (($ExpensescurrentMonthTotal - $ExpenseslastMonthTotal) / $ExpenseslastMonthTotal) * 100;
        } else {
            $ExpensesgrowthPercentage = 0;
        }
        $ExpensesgrowthPercentage = round($ExpensesgrowthPercentage, 2);


        $revenueCurrentMonth = $currentMonthTotal - $ExpensescurrentMonthTotal;
        $revenueLastMonth = $lastMonthTotal - $ExpenseslastMonthTotal;

        if ($revenueLastMonth > 0) {
            $revenueGrowthPercentage = (($revenueCurrentMonth - $revenueLastMonth) / $revenueLastMonth) * 100;
        } else {
            $revenueGrowthPercentage = 0;
        }
        $revenueGrowthPercentage = round($revenueGrowthPercentage, 2);

        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonths(12)->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();

        $salesData = Income::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_sales')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        $expensesData = Expenses::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_expenses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        $months = [];
        $salesDataArray = [];
        $expensesDataArray = [];
        $revenueArray = [];

        for ($month = $startDate; $month->lte($endDate); $month->addMonth()) {
            $months[] = $month->format('M Y');
            $salesDataArray[] = 0;
            $expensesDataArray[] = 0;
            $revenueArray[] = 0;
        }

        foreach ($salesData as $sale) {
            $saleMonth = Carbon::create($sale->year, $sale->month, 1);
            $index = array_search($saleMonth->format('M Y'), $months);
            if ($index !== false) {
                $salesDataArray[$index] = $sale->total_sales;
            }
        }

        foreach ($expensesData as $expense) {
            $expenseMonth = Carbon::create($expense->year, $expense->month, 1);
            $index = array_search($expenseMonth->format('M Y'), $months);
            if ($index !== false) {
                $expensesDataArray[$index] = $expense->total_expenses;
            }
        }

        for ($i = 0; $i < count($salesDataArray); $i++) {
            $revenueArray[$i] = $salesDataArray[$i] - $expensesDataArray[$i];
        }

        $salesDataArray = array_reverse($salesDataArray);
        $expensesDataArray = array_reverse($expensesDataArray);
        $revenueArray = array_reverse($revenueArray);
        $totalRevenue = array_sum($revenueArray);

        $unpaid = Orders::where('state', '!=', 'delivered')->sum('balance');


        return view('dashboard.accountant', compact(
            'growthPercentage',
            'currentMonthTotal',
            'lastMonthTotal',
            'ExpensesgrowthPercentage',
            'ExpenseslastMonthTotal',
            'ExpensescurrentMonthTotal',
            'revenueGrowthPercentage',
            'revenueCurrentMonth',
            'revenueLastMonth',
            'months',
            'salesDataArray',
            'expensesDataArray',
            'totalRevenue',
            'unpaid'
        ));
    }

    public function servicemanagerHome(): View
    {
        // $currentDate = Carbon::now();
        // $startDate = $currentDate->copy()->subMonths(12)->startOfMonth();
        // $endDate = $currentDate->copy()->endOfMonth();

        // $monthlyTotals = DB::table('sales')
        //     ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        //     ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
        //     ->get();

        // $months = [];
        // $data = [];

        // for ($i = 0; $i <= 12; $i++) {
        //     $month = $startDate->copy()->addMonths($i);
        //     $months[] = $month->format('M Y');
        //     $data[] = 0;
        // }

        // foreach ($monthlyTotals as $monthly) {
        //     $monthLabel = Carbon::create($monthly->year, $monthly->month, 1)->format('M Y');
        //     $index = array_search($monthLabel, $months);
        //     if ($index !== false) {
        //         $data[$index] = $monthly->total;
        //     }
        // }

        $totalOrders = Orders::where('state', '!=', 'Delivered')->count();

        $newOrders = Orders::where('state', 'pending')->count();
        $delivery = Orders::where('state', 'OutForDelivery')->count();
        $inwarehouse = Orders::where('location', Auth::user()->branch_id)->count();




        return view('dashboard.servicemanager',  compact('totalOrders', 'newOrders', 'inwarehouse', 'delivery'));
    }
}
