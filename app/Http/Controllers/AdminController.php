<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Management;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function adminHome(): View
    {
        return view('admin.home');
    }
    public function allEmployees(): View
    {
        return view('admin.Employee.displayemployee');
    }
    public function addEmployees(): View
    {
        $countriesBranches = Management::select('country', 'branch', 'position')
            ->get()
            ->groupBy('country')
            ->flatMap(function ($branches, $country) {
                return $branches->groupBy('branch')->flatMap(function ($positions, $branch) use ($country) {
                    return $positions->filter(function ($item) {
                        return !empty($item->branch) && !empty($item->position);
                    })->map(function ($item) use ($country, $branch) {
                        return $branch ? "{$country}, {$branch}, {$item->position}" : "{$country}, {$item->position}";
                    });
                });
            });

        return view('admin.Employee.addemployee', [
            'countriesBranches' => $countriesBranches
        ]);
    }




    public function management(): View
    {
        $countries = Management::select('country', 'branch', 'position')
            ->orderBy('country', 'asc')
            ->orderBy('branch', 'asc')
            ->orderBy('position', 'asc')
            ->get()
            ->groupBy('country');


        return view('admin.Employee.displaymanagement', compact('countries'));
    }
}
