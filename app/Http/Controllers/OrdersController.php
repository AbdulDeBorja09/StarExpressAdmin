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
use App\Models\Income;
use App\Models\Logs;
use App\Models\Orders;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class OrdersController extends Controller
{
    private function logs($action, $table, $recordId, $oldData, $newData)
    {
        $changes = [];
        // foreach ($oldData as $key => $oldValue) {
        //     if (array_key_exists($key, $newData) && $newData[$key] != $oldValue) {
        //         $changes[$key] = [
        //             'old' => $oldValue,
        //             'new' => $newData[$key]
        //         ];
        //     }
        // }
        Logs::create([
            'branch_id' => Auth::user()->branch_id,
            'action' => $action,
            'table' => $table,
            'record_id' => $recordId,
            'old_data' => $oldData ? json_encode($oldData) : null,
            'new_data' => $newData ? json_encode($newData) : null,
            'user_id' => Auth::user()->id,
        ]);
    }
    private function fetchOrders(Request $request, ?string $state)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $query = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])
            ->orderBy('created_at', 'desc');

        if ($state) {
            $query->where('state', $state);
        }

        $orders = $query->paginate($perPage);
        $branches = Branches::all();

        return view('global.allorders', compact('orders', 'perPage', 'currentPage', 'branches'));
    }

    public function allorders(Request $request)
    {
        return $this->fetchOrders($request, null);
    }

    public function pendingorders(Request $request)
    {
        return $this->fetchOrders($request, "Processing");
    }

    public function outfordelivery(Request $request)
    {
        return $this->fetchOrders($request, "OutForDelivery");
    }
    public function readyfordelivery(Request $request)
    {
        return $this->fetchOrders($request, "ReadyForDelivery");
    }
    public function deliverdorders(Request $request)
    {
        return $this->fetchOrders($request, "Delivered");
    }

    public function neworders(Request $request)
    {
        return $this->fetchOrders($request, "pending");
    }

    public function orderdetails($reference_number)
    {
        $details = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])->where('reference_number', $reference_number)->first();
        $statuses = json_decode($details->status, true);
        $items = json_decode($details->items, true);
        $list = json_decode($details->packing_list, true);

        $branches = Branches::all();
        return view('global.orderdetails', compact('details', 'statuses', 'items', 'list', 'branches'));
    }

    public function updateStatus(Request $request)
    {

        $request->validate([
            'status' => 'required|string',
        ]);
        $status = implode(' ', [$request->status ?? '',]);
        $id = $request->id;
        $order = Orders::find($id);
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $value = "Preparing For Delivery";

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
    public function MultipleupdateStatus(Request $request)
    {

        $request->validate([
            'status' => 'required|string',
            'ids' => 'required',

        ]);


        $status = implode(' ', [$request->status ?? '']);
        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        $value = "Preparing For Delivery";

        $ids = json_decode($request->ids, true);
        foreach ($ids as $orderId) {
            $order = Orders::find($orderId);

            try {
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
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Order statuses updated successfully!');
    }

    public function editStatus(Request $request, $orderId, $index)
    {
        $order = Orders::find($orderId);
        $user = Auth::user();

        if ($order) {
            $statuses = $order->status ? json_decode($order->status, true) : [];
            if (isset($statuses[$index])) {
                $statuses[$index]['status'] = implode(' ', [$request->status ?? '']);
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


    public function approveorder(Request $request)
    {
        Orders::where('id', $request->id)->update([
            'approved' => 1
        ]);
        $newData = NULL;
        $oldData = Orders::find($request->id)->toArray();
        $this->logs('New', 'Approve Order', $request->id, $oldData, $newData);
        return redirect()->back()->with('success', 'Order Approved.');
    }
    public function deleteorder(Request $request)
    {
        $oldData = Orders::find($request->id)->toArray();
        Orders::where('id', $request->id)->delete();
        $newData = NULL;
        $this->logs('Delete', 'Order Delete', $request->id, $oldData, $newData);
        return redirect()->route('allorders')->with('success', 'Order Deleted.');
    }

    public function markaspaid(Request $request)
    {
        try {
            $info = Orders::find($request->id);
            $oldData = Orders::find($request->id)->toArray();
            if (!$info) {
                return redirect()->back()->with('error', 'Order not found.');
            }
            $orderUpdated = $info->update(['balance' => 0.00]);

            if (!$orderUpdated) {
                return redirect()->back()->with('error', 'Failed to mark the order as paid.');
            }
            Income::create([
                'branch_id' => Auth::user()->branch_id,
                'service_id' => $info->service_id,
                'category' => 'Cargo Income',
                'reference' => $request->reference,
                'method' => $request->method,
                'plan' => 'Balance Payment',
                'amount' => $request->amount,
                'submitted_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
                'received_by' => Auth::user()->lname . ', ' . Auth::user()->fname,
            ]);
            $newData = Orders::find($request->id)->toArray();
            $this->logs('Edit', 'Mark Order Paid', $request->id, $oldData, $newData);
            return redirect()->back()->with('success', 'Order marked as paid.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
