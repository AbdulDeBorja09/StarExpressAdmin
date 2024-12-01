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
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class OrdersController extends Controller
{
    public function allorders(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $branchid = $user->branch_id;
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $orders = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('global.allorders', compact('orders', 'perPage', 'currentPage'));
    }
    public function pendingorders(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $branchid = $user->branch_id;
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $orders = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])->where('state', "Processing")
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('global.allorders', compact('orders', 'perPage', 'currentPage'));
    }
    public function outfordelivery(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $branchid = $user->branch_id;
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $orders = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])->where('state', "OutForDelivery")
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('global.outfordelivery', compact('orders', 'perPage', 'currentPage'));
    }

    public function orderdetails($reference_number)
    {
        $details = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])->where('reference_number', $reference_number)->first();
        $statuses = json_decode($details->status, true);
        $items = json_decode($details->items, true);
        $list = json_decode($details->packing_list, true);
        return view('global.orderdetails', compact('details', 'statuses', 'items', 'list'));
    }

    public function updateStatus(Request $request)
    {

        $request->validate([
            'status' => 'required|string',
            'location' => 'nullable|string',
        ]);
        $status = implode(' ', [$request->status, $request->location ?? '',]);
        $id = $request->id;
        $order = Orders::find($id);
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $value = "Processing Cargo";

        if ($order) {
            if ($request->status === $value) {
                $order->update([
                    'state' => "ReadyForDelivery",
                ]);
            } else {
                $order->update([
                    'state' => "Processing",
                ]);
            }
            $newStatusWithTimestamp = [
                'status' => $status,
                'logs' => 'Set By: ' . $user->lname . ', ' . $user->fname,
                'timestamp' => now()->toDateTimeString()
            ];

            $existingStatuses = $order->status ? json_decode($order->status, true) : [];
            $existingStatuses[] = $newStatusWithTimestamp;
            $order->status = json_encode($existingStatuses);
            $order->save();
            return redirect()->back()->with('success', 'Order status updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Order not found.');
        }
    }

    public function editStatus(Request $request, $orderId, $index)
    {
        $order = Orders::find($orderId);
        $user = Auth::user();

        if ($order) {
            $statuses = $order->status ? json_decode($order->status, true) : [];
            if (isset($statuses[$index])) {
                $statuses[$index]['status'] = implode(' ', [$request->status, $request->location ?? '']);
                $statuses[$index]['logs'] = 'Edited By: ' . $user->lname . ', ' . $user->fname;
                $statuses[$index]['timestamp'] = now()->toDateTimeString();
                $order->status = json_encode($statuses);
                $order->save();
                return redirect()->back()->with('success', 'Order status updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Status not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Order not found.');
        }
    }
}