<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branches;
use App\Models\CargoService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{



    public function Branches(): View
    {
        $countries = Branches::orderBy('country', 'asc')
            ->orderBy('branch', 'asc')
            ->get()
            ->groupBy('country');
        return view('admin.displayBranches', compact('countries'));
    }
    public function editbranch(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'country' => 'required|string|max:255',
            'branch' => 'required|string|max:255',

        ]);
        try {
            Branches::where('id', $request->id)->update([
                'country' => $request->country,
                'branch' => $request->branch,

            ]);
            return redirect()->route('admin.Branches');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deletebranch(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        Branches::where('id',  $request->id)->delete();
        return redirect()->route('admin.Branches');
    }


    public function submitaddBranch(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
        ]);


        $country = strtolower(str_replace(' ', '',  $request->country));
        $branch = strtolower(str_replace(' ', '',  $request->branch));

        $branches = Branches::where('country', $request->country)->where('branch', $request->branch)->first();
        if ($branches) {
            return redirect()->back()->withErrors(['exist' => 'Country Already Exists.']);
        } else {
            try {
                Branches::create([
                    'country' => $country,
                    'branch' =>  $branch,
                ]);
                return redirect()->route('admin.Branches');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function services(): View
    {
        $countries = Branches::all();
        $services = CargoService::with(['originBranch', 'destinationBranch'])->get();
        return view('admin.services', compact('services', 'countries'));
    }

    public function submitaddservices(Request $request)
    {
        $request->validate([
            'origin' => 'required|max:255',
            'destination' => 'required|max:255',
            'currency' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
        $services = CargoService::where('origin', $request->origin)->where('destination', $request->destination)->first();
        if ($request->origin === $request->destination) {
            return redirect()->back()->withErrors(['error' => 'Destination cannot be same.']);
        } else {
            if (!$services) {
                try {
                    CargoService::create([
                        'origin' => $request->origin,
                        'destination' => $request->destination,
                        'currency' => $request->currency,
                        'status' => $request->status,
                    ]);
                    return redirect()->route('admin.Services');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            } else {
                return redirect()->back()->withErrors(['service' => 'Service Already Exists.']);
            }
        }
    }
    public function editservices(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'currency' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
        if ($request->origin === $request->destination) {
            return redirect()->back()->withErrors(['destination' => 'Destination cannot be same.']);
        } else {
            try {
                CargoService::where('id', $request->id)->update([
                    'origin' => $request->origin,
                    'destination' => $request->destination,
                    'currency' => $request->currency,
                    'status' => $request->status,
                ]);
                return redirect()->route('admin.Services');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function deleteservice(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        CargoService::where('id',  $request->id)->delete();
        return redirect()->route('admin.Services');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
