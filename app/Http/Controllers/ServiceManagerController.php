<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Management;
use App\Models\CargoService;
use App\Models\CargoLocations;
use App\Models\CargoTruck;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;

class ServiceManagerController extends Controller
{
    public function cargoprices(): View
    {

        return view('servicemanager.cargoprices');
    }
    public function servicelocations(): View
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        if ($user->type === 'admin') {
            $locations = CargoLocations::select('country', 'branch', 'region', 'areas')
                ->orderBy('country', 'asc')
                ->orderBy('branch', 'asc')
                ->orderBy('region', 'asc')
                ->orderBy('areas', 'asc')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'country_branch' => $item->country . ', ' . $item->branch,
                        'region' => $item->region,
                        'areas' => $item->areas,
                    ];
                })
                ->groupBy('country_branch'); // Grouping still makes sense here

            $countries = Management::select('country', 'branch')
                ->get()
                ->groupBy('country')
                ->flatMap(function ($branches, $country) {
                    return $branches->groupBy('branch')->flatMap(function ($positions, $branch) use ($country) {
                        return $positions->filter(function ($item) {
                            return !empty($item->branch);
                        })->map(function ($item) use ($country, $branch) {
                            return $branch ? "{$country}, {$branch}" : "{$country}";
                        });
                    });
                });

            return view('servicemanager.locations', compact('locations', 'role', 'countries'));
        } else {
            $userCountry = $user->country;
            $userBranch = $user->branch;
            $locations = CargoLocations::where('country', $userCountry)
                ->where('branch', $userBranch)->orderBy('country', 'asc')
                ->orderBy('branch', 'asc')
                ->orderBy('region', 'asc')
                ->orderBy('areas', 'asc')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'country_branch' => $item->country . ', ' . $item->branch,
                        'region' => $item->region,
                        'areas' => $item->areas,
                    ];
                })
                ->groupBy('country_branch');

            return view('servicemanager.locations', compact('locations', 'role', 'userCountry', 'userBranch'));
        }
    }
    public function addnewlocations(Request $request)
    {
        $request->validate([
            'branch' => 'required|string',
            'region' => 'required|string',
            'area' => 'required|string',
        ]);
        $parts = explode(',', $request->input('branch'));
        $country = strtolower(trim(preg_replace('/\s+/', '', $parts[0])));
        $branch = strtolower(trim(preg_replace('/\s+/', '', $parts[1])));
        try {
            CargoLocations::create([
                'country' => $country,
                'branch' => $branch,
                'region' => $request->region,
                'areas' => $request->area,
            ]);
            return redirect()->route('servicelocations');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function addlocations(Request $request)
    {
        $request->validate([
            'country' => 'required|string',
            'branch' => 'required|string',
            'region' => 'required|string',
            'area' => 'required|string',
        ]);
        $area = str_replace(' ', '', $request->area);
        $exists = CargoLocations::where('country', $request->country)
            ->where('branch', $request->branch)
            ->where('region', $request->region)
            ->where('areas', $area)
            ->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['service' => 'Area Already Exists.']);
        } else {
            try {
                CargoLocations::create([
                    'country' => $request->country,
                    'branch' => $request->branch,
                    'region' => $request->region,
                    'areas' => $area,
                ]);
                return redirect()->route('servicelocations');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function deleteregion(Request $request)
    {
        $request->validate([
            'region' => 'required|string',
        ]);
        CargoLocations::where('region', $request->region)->delete();
        return redirect()->route('servicelocations');
    }
    public function deletearea(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        CargoLocations::where('id', $request->id)->delete();
        return redirect()->route('servicelocations');
    }

    public function updateArea(Request $request)
    {

        $request->validate([
            'id' => 'required|integer',
            'area' => 'required|string|max:255',
        ]);

        CargoLocations::where('id', $request->id)->update(['areas' => $request->area]);
        return redirect()->back()->with('success', 'Area updated successfully.');
    }

    public function trucklist(): View
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $userCountry = $user->country;
        $userBranch = $user->branch;
        $branch = $userCountry . ', ' . $userBranch;

        if ($user->type === 'admin') {
            $trucks = CargoTruck::orderBy('branch', 'asc')
                ->get()
                ->groupBy('branch');
            $countries = Management::select('country', 'branch')
                ->get()
                ->groupBy('country')
                ->flatMap(function ($branches, $country) {
                    return $branches->groupBy('branch')->flatMap(function ($positions, $branch) use ($country) {
                        return $positions->filter(function ($item) {
                            return !empty($item->branch);
                        })->map(function ($item) use ($country, $branch) {
                            return $branch ? "{$country}, {$branch}" : "{$country}";
                        });
                    });
                });
            return view('servicemanager.trucklist',  compact('trucks', 'role', 'countries'));
        } else {
            $trucks = CargoTruck::where('branch', $branch)->orderBy('branch', 'asc')
                ->get()
                ->groupBy('branch');
        }

        return view('servicemanager.trucklist', compact('trucks', 'role'));
    }
    public function addnewtruck(Request $request)
    {
        $request->validate([
            'branch' => 'required|max:255',
            'model' => 'required|max:255',
            'plate' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
            'expired' => 'required|max:255',
        ]);

        $plate = CargoTruck::where('plate', $request->plate)->first();
        if ($plate) {
            return redirect()->back()->with('error', 'Truck Already Exists.');
        } else {
            try {
                CargoTruck::create([
                    'branch' => $request->branch,
                    'model' => $request->model,
                    'plate' => $request->plate,
                    'status' => $request->status,
                    'condition' => $request->condition,
                    'expiration' => $request->expired,
                ]);
                return redirect()->route('trucklist');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        return redirect()->route('trucklist');
    }
    public function deletetruck(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        CargoTruck::where('id', $request->id)->delete();
        return redirect()->route('trucklist');
    }
    public function edittruck(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'model' => 'required|max:255',
            'plate' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
        ]);
        try {
            CargoTruck::where('id', $request->id)->update([
                'model' => $request->model,
                'plate' => $request->plate,
                'status' => $request->status,
                'condition' => $request->condition,
            ]);
            return redirect()->route('trucklist');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
