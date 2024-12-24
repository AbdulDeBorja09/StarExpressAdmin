<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TruckDriver;
use App\Models\Branches;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerVisits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuspensionMail;
use App\Mail\DeleteAccountMail;
use App\Models\Orders;
use App\Models\LoginLog;
use App\Models\Suspendeds;
use Illuminate\Contracts\Concurrency\Driver;
use Illuminate\Support\Facades\Auth;

class HrController extends Controller
{
    public function allEmployees(): View
    {

        $employees = User::with('branch')->get();

        return view('Humanresources.displayemployee', compact('employees'));
    }
    public function allDriver(): View
    {

        $employees = TruckDriver::with('branch')->get();
        return view('Humanresources.displaydrivers', compact('employees'));
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
    public function allcustomer(Request $request)
    {

        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $customer = Customer::orderby('created_at', 'desc')->paginate($perPage);
        foreach ($customer as $item) {
            $item->order_count = Orders::where('user_id', $item->id)
                ->count();
        }

        return view('Humanresources.allcustomer', compact('customer', 'perPage'));
    }
    public function customervisit(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $visits = CustomerVisits::orderby('visited_at', 'desc')->paginate($perPage);
        return view('Humanresources.websitevisits', compact('visits', 'perPage'));
    }
    public function showsuspendeduser(Request $request)
    {
        $label = 'Customer';
        $user = Auth::user();
        $role = $user->type;
        $userbranch = $user->branch_id;

        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $users = Suspendeds::where('user_type', 'user')->where('status', 0)->orderby('created_at', 'desc')->paginate($perPage);
        return view('Humanresources.suspendedusers', compact('users', 'perPage', 'label'));
    }
    public function showsuspenddriver(Request $request)
    {
        $label = 'Driver';
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $user = Auth::user();
        $role = $user->type;
        $userbranch = $user->branch_id;
        if ($role === 'admin') {
            $users = Suspendeds::where('user_type', 'driver')->where('status', 0)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedusers', compact('users', 'perPage', 'label'));
        } else {
            $users = Suspendeds::where('branch_id', $userbranch)->where('user_type', 'driver')->where('status', 0)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedusers', compact('users', 'perPage', 'label'));
        }
    }
    public function showsuspendemployee(Request $request)
    {
        $label = 'Employee';
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $user = Auth::user();
        $role = $user->type;
        $userbranch = $user->branch_id;
        if ($role === 'admin') {
            $users = Suspendeds::where('user_type', 'employee')->where('status', 0)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedusers', compact('users', 'perPage', 'label'));
        } else {
            $users = Suspendeds::where('branch_id', $userbranch)->where('user_type', 'employee')->where('status', 0)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedusers', compact('users', 'perPage', 'label'));
        }
    }
    public function susppensionuserhistory(Request $request)
    {
        $label = 'User';
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $users = Suspendeds::where('user_type', 'user')->where('status', 1)->orderby('created_at', 'desc')->paginate($perPage);
        return view('Humanresources.suspendedhistory', compact('users', 'perPage', 'label'));
    }
    public function susppensionemployeehistory(Request $request)
    {
        $label = 'Employee';
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $user = Auth::user();
        $role = $user->type;
        $userbranch = $user->branch_id;

        if ($role === 'admin') {
            $users = Suspendeds::where('user_type', 'employee')->where('status', 1)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedhistory', compact('users', 'perPage', 'label'));
        } else {
            $users = Suspendeds::where('branch_id', $userbranch)->where('user_type', 'employee')->where('status', 1)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedhistory', compact('users', 'perPage', 'label'));
        }
    }
    public function susppensiondriverhistory(Request $request)
    {
        $label = 'Driver';
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $user = Auth::user();
        $role = $user->type;
        $userbranch = $user->branch_id;

        if ($role === 'admin') {
            $users = Suspendeds::where('user_type', 'driver')->where('status', 1)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedhistory', compact('users', 'perPage', 'label'));
        } else {
            $users = Suspendeds::where('branch_id', $userbranch)->where('user_type', 'driver')->where('status', 1)->orderby('created_at', 'desc')->paginate($perPage);
            return view('Humanresources.suspendedhistory', compact('users', 'perPage', 'label'));
        }
    }
    public function suspend(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer',
                'email' => 'required|email',
                'reason' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'type' => 'required|in:driver,employee,user',
            ]);

            switch ($request->type) {
                case 'driver':
                    TruckDriver::where('id', $request->id)->update(['status' => 'suspended']);
                    break;

                case 'employee':
                    User::where('id', $request->id)->update(['status' => 'suspended']);
                    break;

                case 'user':
                    Customer::where('id', $request->id)->update(['status' => 'suspended']);
                    break;

                default:
                    return back()->withErrors(['error' => 'Invalid user type.']);
            }
            $details = [
                'name' => $request->name,
                'reason' => $request->reason,
            ];

            $isSuspended = Suspendeds::where('user_id', $request->id)
                ->where('user_type', $request->type)
                ->exists();

            Suspendeds::create([
                'branch_id' => Auth::user()->branch_id,
                'user_id' => $request->id,
                'email' => $request->email,
                'user_type' => $request->type,
                'reason' => $request->reason,
            ]);
            Mail::to($request->email)->send(new SuspensionMail($details));

            return back()->with('success', 'User suspended successfully and email sent.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function liftusersuspend(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
            'type' => 'required|in:driver,employee,user',
        ]);

        Suspendeds::where('id',  $request->id)->update([
            'status' => 1,
        ]);
        switch ($request->type) {
            case 'driver':
                TruckDriver::where('id', $request->user_id)->update(['status' => 'active']);
                break;

            case 'employee':
                User::where('id', $request->user_id)->update(['status' => 'active']);
                break;

            case 'user':
                Customer::where('id', $request->user_id)->update(['status' => 'active']);
                break;

            default:
                return back()->withErrors(['error' => 'Invalid user type.']);
        }


        return back()->with('success', 'User lifted suspended successfully and email sent.');
    }



    public function deleteuseraccount(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user_id' => 'required',
        ]);

        $user = Customer::where('id',  $request->user_id)->first();
        $reason = Suspendeds::where('id',  $request->id)->first();

        $details = [
            'name' => $user->name,
            'reason' => $reason->reason
        ];
        Mail::to($user->email)->send(new DeleteAccountMail($details));
        Suspendeds::where('id',  $request->id)->update([
            'status' => 1,
        ]);
        Customer::where('id',  $request->user_id)->delete();
        return redirect()->route('showsuspendeduser');
    }
    public function editdriveraccount($id)
    {
        $branch = Branches::all();
        $item =  TruckDriver::where('id', $id)->first();
        return view('Humanresources.editdriver', compact('item', 'branch'));
    }

    public function editemployee($id)
    {
        $branch = Branches::all();
        $item = User::where('id', $id)->first();
        return view('Humanresources.editemployee', compact('item', 'branch'));
    }


    public function submitdriveredit(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'contact' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'type' => 'required|string',
            'email' => 'required|email|max:255',
        ]);
        try {
            Truckdriver::where('id', $request->id)->update([
                'name' => $request->fname . ' ' . $request->mname . ' ' . $request->lname,
                'gender' => $request->gender,
                'phone' => $request->contact,
                'branch_id' => $request->branch_id,
                'position' => $request->type,
                'email' => $request->email,
            ]);
            return redirect()->route('allDriver');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function submitemployeeedit(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'contact' => 'required|numeric',
            'branch_id' => 'required|exists:branches,id',
            'type' => 'required|string',
            'email' => 'required|email|max:255',
        ]);
        try {
            User::where('id', $request->id)->update([
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'gender' => $request->gender,
                'address' => $request->address,
                'contact' => $request->contact,
                'branch_id' => $request->branch_id,
                'type' => $request->type,
                'email' => $request->email,
            ]);
            return redirect()->route('allEmployees');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function loginlogs(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $logs = LoginLog::with(['user'])->latest()->paginate($perPage);

        return view('Humanresources.loginlogs', compact('perPage', 'currentPage', 'logs'));
    }
}
