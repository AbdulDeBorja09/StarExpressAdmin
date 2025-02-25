<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branches;
use App\Models\CargoBoxes;
use App\Models\CargoService;
use App\Models\CargoLocations;
use App\Models\CargoPrices;
use App\Models\CargoTruck;
use App\Models\Orders;
use App\Models\Delivery;
use App\Models\TruckDriver;
use App\Models\TruckReports;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class TruckController extends Controller
{
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

    public function ViewTruckReport(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $reports = TruckReports::with(['driver'])->paginate($perPage);
        return view('servicemanager.truckreport', compact('reports', 'perPage', 'currentPage'));
    }
}
