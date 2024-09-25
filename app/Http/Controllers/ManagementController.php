<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branches;
use App\Models\CargoService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ManagementController extends Controller
{
    public function allEmployees(): View
    {

        $employees = User::with('branch')->get();

        return view('admin.displayemployee', compact('employees'));
    }
    public function addEmployees(): View
    {
        $branch = Branches::orderBy('country', 'asc')->orderBy('branch', 'asc')->get();
        return view('admin.addemployee', compact('branch'));
    }

    public function submitaddEmployees(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|integer|max:255',
            'type' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'hired_date' => 'required|string|max:255',
            'confirm-password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $fullname = $request->input('fname') . " " . $request->input('mname') . " " . $request->input('lname');
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        if ($request->input('password') === $request->input('confirm-password')) {
            if (User::where('email', $request->input('email'))->exists()) {
                return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
            } else {
                try {
                    User::create([
                        'branch_id' => $request->branch_id,
                        'type' => $request->type,
                        'employee_id' => $request->employee_id,
                        'name' => $fullname,
                        'gender' => $request->gender,
                        'address' => $request->address,
                        'contact' => $request->contact,
                        'status' => $request->status,
                        'email' => $request->input('email'),
                        'password' => bcrypt($request->input('password')),
                        'avatar' => $imagePath,
                        'hired' => $request->hired_date,
                    ]);
                    return redirect()->route('admin.allEmployees');
                } catch (\Exception $e) {

                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }
        } else {
            return redirect()->back()->withErrors(['confirm-password' => 'Passwords do not match.']);
        }
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
            return redirect()->back()->withErrors(['error' => 'Country Already Exists.']);
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

    public function submitaddservices(Request $request)
    {
        $request->validate([
            'origin' => 'required|max:255',
            'destination' => 'required|max:255',
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
        ]);

        try {
            CargoService::where('id', $request->id)->update([
                'origin' => $request->origin,
                'destination' => $request->destination,
            ]);
            return redirect()->route('admin.Services');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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

    public function Branches(): View
    {
        $countries = Branches::select('country', 'branch')
            ->orderBy('country', 'asc')
            ->orderBy('branch', 'asc')
            ->get()
            ->groupBy('country');
        return view('admin.displayBranches', compact('countries'));
    }
    public function services(): View
    {
        $countries = Branches::all();
        $services = CargoService::with(['originBranch', 'destinationBranch'])->get();
        return view('admin.services', compact('services', 'countries'));
    }
}
