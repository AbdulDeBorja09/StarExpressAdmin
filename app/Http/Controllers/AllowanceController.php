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
use App\Models\DeliveryAllowance;
use App\Models\Expenses;
use App\Models\TruckDriver;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class AllowanceController extends Controller
{
    public function createallowance(Request $request)
    {
        $request->validate([
            'amount' =>  'required',
        ]);

        $check =  DeliveryAllowance::where('delivery_id', $request->delivery_id)->first();
        if ($check) {
            return redirect()->back()->withErrors(['error' => 'Request has already made.']);
        }
        try {
            DeliveryAllowance::create([
                'branch_id' =>  Auth::user()->branch_id,
                'driver_id' =>   $request->driver_id,
                'delivery_id' =>   $request->delivery_id,
                'allowance' => $request->amount,
                'requested_by'  => $request->request_name,
            ]);
            return redirect()->back()->with('success', 'Area updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function editallowance(Request $request) {}

    public function allowancerequest(Request  $request)
    {


        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $allowance  = DeliveryAllowance::with(['branch', 'driver', 'delivery'])->whereIn('status', ['pending', 'approved'])
            ->orderBy('created_at', 'desc')->paginate($perPage);

        return view('accountant.allowances', compact('perPage', 'currentPage', 'allowance'));
    }

    public function allowancedetails($id)
    {
        $delivery = Delivery::with(['manager', 'driver', 'truck'])->where('id', $id)->first();
        $deliveryIds = [];
        if ($delivery && $delivery->items) {
            $items = json_decode($delivery->items, true);
            if (!empty($items)) {
                $deliveryIds = array_merge($deliveryIds, $items);
            }
        }

        $deliveryIds = array_unique($deliveryIds);
        $orderDetails = Orders::whereIn('id', $deliveryIds)->get();
        $allowance = DeliveryAllowance::with(['manager'])->where('delivery_id', $id)->first();

        return view('accountant.allowancedetails', compact('delivery', 'orderDetails', 'allowance'));
    }


    public function allowanceapprove(Request $request)
    {
        $fullname = Auth::user()->lname . ', ' . Auth::user()->fname;
        DeliveryAllowance::where('id', $request->id)->update([
            'status' =>  'approved',
            'approved_by' =>  $fullname,
        ]);
        return redirect()->back()->with('success', 'Allowance updated successfully.');
    }
    public function allowancereject(Request $request)
    {
        $fullname = Auth::user()->lname . ', ' . Auth::user()->fname;
        DeliveryAllowance::where('id', $request->id)->update([
            'status' =>  'rejected',
            'approved_by' => $fullname,
        ]);
        return redirect()->back()->with('success', 'Allowance updated successfully.');
    }

    public function allowanceacomplete(Request $request)
    {
        $fullname = Auth::user()->lname . ', ' . Auth::user()->fname;
        $delivery =  DeliveryAllowance::where('id', $request->id)->update([
            'status' =>  'completed',
            'received_by' =>  $request->received,
            'given_by' => $fullname,
        ]);
        if ($delivery) {
            $info = DeliveryAllowance::with('delivery')->where('id', $request->id)->first();
            Expenses::create([
                'branch_id' => Auth::user()->branch_id,
                'category' => 'Delivery Allowance',
                'reference' => $info->delivery->trip_id,
                'approved_by' => Auth::user()->id,
                'submitted_by' => Auth::user()->id,
                'amount' => $info->allowance,
            ]);
        }
        return redirect()->back()->with('success', 'Allowance updated successfully.');
    }
}
