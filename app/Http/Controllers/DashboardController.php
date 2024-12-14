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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function humanresourceHome(): View
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


        $user = Customer::where('status', 'suspended')->count();
        $employee = User::where('status', 'suspended')->count();
        $driver = TruckDriver::where('status', 'suspended')->count();

        $totalsuspended = [
            'customer' => $user,
            'employee' => $employee,
            'driver' => $driver,
        ];

        $totalemployee = [
            'hr' => $hr,
            'accountant' => $accountant,
            'servicemanager' => $servicemanager,
            'driver' => $driver,
        ];

        $totalsuspendeds = array_values($totalsuspended);
        $totalemployees = array_values($totalemployee);
        return view('dashboard.humanresource', compact('hr', 'accountant', 'servicemanager', 'driver', 'data', 'months', 'users', 'suspendeduser', 'suspendedemployee', 'totalsuspendeds', 'totalemployees'));
    }
}
