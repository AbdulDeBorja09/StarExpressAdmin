<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruckDriver;
use App\Models\Branches;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class HrController extends Controller
{
    public function allEmployees(): View
    {

        $employees = User::with('branch')->get();

        return view('Humanresources.displayemployee', compact('employees'));
    }
    public function addEmployees(): View
    {
        $branch = Branches::orderBy('country', 'asc')->orderBy('branch', 'asc')->get();
        return view('Humanresources.addemployee', compact('branch'));
    }


    private function generateUniqueEmployeeId($branchId)
    {
        $branch = Branches::find($branchId);

        if (!$branch) {
            return null;
        }

        $countryLetter = strtoupper(substr($branch->country, 0, 1));
        $branchLetter = strtoupper(substr($branch->branch, 0, 1));

        do {
            $randomNumber = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $employeeId = $countryLetter . $branchLetter . '-' . $randomNumber;
        } while (User::where('employee_id', $employeeId)->exists());

        return $employeeId;
    }


    public function submitaddEmployees(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|integer|max:255',
            'type' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'confirm-password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imgname = 'Avatar_' . time() . '_' . $request->file('image')->getClientOriginalName();
        }
        if ($request->input('password') === $request->input('confirm-password')) {
            if (User::where('email', $request->input('email'))->exists()) {
                return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
            } else {
                try {
                    if ($request->input('password') === $request->input('confirm-password')) {
                        if (User::where('email', $request->input('email'))->exists()) {
                            return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
                        } else {
                            try {
                                $employeeId = $this->generateUniqueEmployeeId($request->branch_id);
                                $hiredDate = date('F j, Y');
                                User::create([
                                    'branch_id' => $request->branch_id,
                                    'type' => $request->type,
                                    'employee_id' => $employeeId,
                                    'fname' => $request->input('fname'),
                                    'mname' => $request->input('mname'),
                                    'lname' => $request->input('lname'),
                                    'gender' => $request->gender,
                                    'address' => $request->address,
                                    'contact' => $request->contact,
                                    'status' => $request->status,
                                    'email' => $request->input('email'),
                                    'password' => bcrypt($request->input('password')),
                                    'avatar' => $imagePath,
                                    'hired' => $hiredDate,
                                ]);
                                return redirect()->route('allEmployees');
                            } catch (\Exception $e) {

                                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                            }
                        }
                    } else {
                        return redirect()->back()->withErrors(['confirm-password' => 'Passwords do not match.']);
                    }
                } catch (\Exception $e) {

                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }
        } else {
            return redirect()->back()->withErrors(['confirm-password' => 'Passwords do not match.']);
        }
    }
    public function deleteemployee(Request $request)
    {
        $request->validate([
            'deleteid' => 'required',
        ]);
        $user = User::find($request->deleteid);
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->route('allEmployees');
    }
    public function truckdriveradd(): View
    {
        $branch = Branches::orderBy('country', 'asc')->orderBy('branch', 'asc')->get();
        return view('Humanresources.addDriver', compact('branch'));
    }

    public function submitadddriver(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|integer|max:255',
            'type' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'confirm-password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $name = $request->fname . ' ' . $request->mname . ' ' . $request->lname;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imgname = 'Avatar_' . time() . '_' . $request->file('image')->getClientOriginalName();
        }
        if ($request->input('password') === $request->input('confirm-password')) {
            if (TruckDriver::where('email', $request->input('email'))->exists()) {
                return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
            } else {
                try {
                    if ($request->input('password') === $request->input('confirm-password')) {
                        if (TruckDriver::where('email', $request->input('email'))->exists()) {
                            return redirect()->back()->withErrors(['email' => 'The email address is already in use.']);
                        } else {
                            try {
                                TruckDriver::create([
                                    'branch_id' => $request->branch_id,
                                    'position' => $request->type,
                                    'name' => $name,
                                    'gender' => $request->gender,
                                    'phone' => $request->contact,
                                    'email' => $request->input('email'),
                                    'password' => $request->password,

                                ]);
                                return redirect()->route('truckdriveradd');
                            } catch (\Exception $e) {

                                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                            }
                        }
                    } else {
                        return redirect()->back()->withErrors(['confirm-password' => 'Passwords do not match.']);
                    }
                } catch (\Exception $e) {

                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }
            }
        } else {
            return redirect()->back()->withErrors(['confirm-password' => 'Passwords do not match.']);
        }
    }
}
