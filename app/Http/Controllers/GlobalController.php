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

class GlobalController extends Controller
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


        return view('global.vieworders', compact('orders', 'perPage', 'currentPage'));
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
        // Validate the input
        $request->validate([
            'status' => 'required|string',
            'location' => 'nullable|string',
        ]);



        $status = implode(' ', [$request->status, $request->location ?? '',]);
        $id = $request->id;
        // Find the order
        $order = Orders::find($id);
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $value = "Processing Cargo";

        if ($order) {
            if ($request->status === $value) {
                $order->update([
                    'state' => "ReadyForDelivery",
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
        // Find the order
        $order = Orders::find($orderId);
        $user = Auth::user();

        if ($order) {
            // Get existing statuses
            $statuses = $order->status ? json_decode($order->status, true) : [];

            // Check if the index exists
            if (isset($statuses[$index])) {
                // Update the specific status
                $statuses[$index]['status'] = implode(' ', [$request->status, $request->location ?? '']);
                $statuses[$index]['logs'] = 'Edited By: ' . $user->lname . ', ' . $user->fname;
                $statuses[$index]['timestamp'] = now()->toDateTimeString(); // Optional: You could allow timestamp editing if needed

                // Save the updated statuses back to the order
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
