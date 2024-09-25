<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branches;
use App\Models\CargoService;
use App\Models\CargoLocations;
use App\Models\CargoPrices;
use App\Models\CargoTruck;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;

class ServiceManagerController extends Controller
{
    public function getBranches($serviceId)
    {
        $branches = CargoLocations::where('branch_id', $serviceId)->get();
        return response()->json($branches);
    }

    public function cargoprices(): View
    {

        $prices = CargoPrices::select('service_id')->orderBy('service_id', 'asc')
            ->get();



        $service = CargoService::with(['originBranch', 'destinationBranch'])->get();

        return view('servicemanager.cargoprices', compact('prices', 'service'));
    }
    public function addcargoprice(Request $request)
    {
        $request->validate([
            'service_id' =>  'required|max:255',
            'region' =>  'required|max:255',
            'name' =>  'required|max:255',
            'height' =>  'required|max:255',
            'width' =>  'required|max:255',
            'length' =>  'required|max:255',
            'type' =>  'required|max:255',
            'rate' =>  'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        list($originBranchId, $destinationBranchId, $item) = explode('|', $request->input('service_id'));
        // $id = CargoService::where('id', $request->service_id)->first();
        $imagePath = null;
        $size = $request->input('height') . " " . $request->input('width') . " " . $request->input('length');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        try {
            CargoPrices::create([
                'branch_id' => $originBranchId,
                'service_id' => $item,
                'area' => $request->region,
                'name' => $request->name,
                'size' => $size,
                'type' => $request->type,
                'rate' => $request->rate,
                'image' => $imagePath,
            ]);
            return redirect()->route('cargoprices');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function servicelocations(): View
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $userbranch = $user->branch_id;
        if ($user->type === 'admin') {
            $locations = CargoLocations::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $branchs = Branches::orderBy('country', 'asc')->orderBy('branch', 'asc')->get();
            return view('servicemanager.locations', compact('locations', 'role', 'branchs'));
        } else {
            $trucks = CargoTruck::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $locations = CargoLocations::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $branchs = Branches::where('id', $userbranch)->first();
            return view('servicemanager.locations', compact('locations', 'role', 'branchs'));
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
            'branch_id' => 'required|string',
            'region' => 'required|string',
            'area' => 'required|string',
        ]);
        $area = str_replace(' ', '', $request->area);
        $exists = CargoLocations::where('branch_id', $request->branch_id)
            ->where('region', $request->region)
            ->where('areas', $area)
            ->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['service' => 'Area Already Exists.']);
        } else {
            try {
                CargoLocations::create([
                    'branch_id' => $request->branch_id,
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
            'branch_id' => 'required',
        ]);
        CargoLocations::where('region', $request->region)->where('branch_id', $request->branch_id)->delete();
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
        $branchid = $user->branch_id;

        if ($user->type === 'admin') {
            $trucks = CargoTruck::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');
            $countries = Branches::orderBy('country', 'asc')
                ->orderBy('branch', 'asc')
                ->get();

            return view('servicemanager.trucklist',  compact('trucks', 'role', 'countries'));
        } else {
            $branchs = Branches::where('id', $branchid)->first();
            $trucks = CargoTruck::with('branch')->where('branch_id', $branchid)->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');
        }
        return view('servicemanager.trucklist', compact('trucks', 'role', 'branchid', 'branchs'));
    }

    public function addnewtruck(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|max:255',
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
                    'branch_id' => $request->branch_id,
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
