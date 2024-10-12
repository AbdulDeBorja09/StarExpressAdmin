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
    public function orderdetails($reference_number)
    {


        $details = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])->where('reference_number', $reference_number)->first();
        $statuses = json_decode($details->status, true);

        $items = json_decode($details->items, true);
        return view('global.orderdetails', compact('details', 'statuses', 'items'));
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

        if ($order) {
            // Append the new status to the existing statuses, separating with a comma
            $newStatusWithTimestamp = [
                'status' => $status,
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
}
