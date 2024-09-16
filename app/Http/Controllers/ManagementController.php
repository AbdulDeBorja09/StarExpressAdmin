<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Management;

class ManagementController extends Controller
{

    public function submitaddEmployees(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'hired_date' => 'required|string|max:255',
            'confirm-password' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $parts = explode(',', $request->input('branch'));
        $country = strtolower(trim(preg_replace('/\s+/', '', $parts[0])));
        $branch = strtolower(trim(preg_replace('/\s+/', '', $parts[1])));
        $position = strtolower(trim(preg_replace('/\s+/', '', $parts[2])));
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
                        'type' => $position,
                        'employee_id' => $request->employee_id,
                        'name' => $fullname,
                        'gender' => $request->gender,
                        'address' => $request->address,
                        'contact' => $request->contact,
                        'status' => $request->status,
                        'country' => $country,
                        'branch' => $branch,
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
            'position' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $data['country'] = strtolower(str_replace(' ', '', $data['country']));
        $data['branch'] = strtolower(str_replace(' ', '', $data['branch']));
        $data['position'] = strtolower(str_replace(' ', '', $data['position']));

        $branches = Management::where('country', $request->country)->where('branch', $request->branch)->where('position', $request->position)->first();
        if ($branches) {
            return redirect()->back()->withErrors(['confirm-password' => 'Already Exists.']);
        } else {
            try {
                Management::create($data);
                return redirect()->route('admin.managment');
            } catch (\Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function submitaddcountry(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $data['country'] = strtolower(str_replace(' ', '', $data['country']));
        $branches = Management::where('country', $request->country)->first();
        if ($branches) {
            return redirect()->back()->withErrors(['confirm-password' => 'Country Already Exists.']);
        } else {
            try {
                Management::create($data);
                return redirect()->route('admin.managment');
            } catch (\Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
}
