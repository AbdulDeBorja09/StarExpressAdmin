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
use App\Models\TruckDriver;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class ServiceManagerController extends Controller
{
    public function getBranches($serviceId)
    {
        $branches = CargoBoxes::where('service_id', $serviceId)->get();

        return response()->json($branches);
    }
    public function getAreas($serviceId)
    {
        $cargoBox = CargoService::find($serviceId);
        $areas = CargoLocations::where('branch_id', $cargoBox->destination)->get();
        return response()->json($areas);
    }

    public function cargoboxes(): View
    {

        $user = Auth::user();
        $role = $user->type;
        $branchId = $user->branch_id;
        if ($role === 'admin') {
            $service = CargoService::with(['originBranch', 'destinationBranch'])->get();
            $cargoboxes = CargoBoxes::with(['branch', 'service.originBranch', 'service.destinationBranch'])
                ->orderBy('branch_id')
                ->orderBy('service_id')
                ->get()
                ->groupBy(['branch_id', 'service_id']);
            return view('servicemanager.cargoboxes', compact('cargoboxes', 'service'));
        } else {

            $service = CargoService::with(['originBranch', 'destinationBranch'])
                ->whereHas('originBranch', function ($query) use ($branchId) {
                    $query->where('id', $branchId); // Adjust the condition based on your needs
                })
                ->get();
            $cargoboxes = CargoBoxes::with(['branch', 'service.originBranch', 'service.destinationBranch'])
                ->where('branch_id', $user->branch_id)
                ->orderBy('branch_id')
                ->orderBy('service_id')
                ->get()
                ->groupBy(['branch_id', 'service_id']);
            return view('servicemanager.cargoboxes', compact('cargoboxes', 'service', 'role'));
        }
    }


    public function addcargobox(Request $request)
    {
        $request->validate([
            'service' =>  'required|max:255',
            'name' =>  'required|max:255',
            'height' =>  'required|max:255',
            'width' =>  'required|max:255',
            'length' =>  'required|max:255',
            'note' =>  'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        list($originBranchId, $destinationBranchId, $item) = explode('|', $request->input('service'));
        // $id = CargoService::where('id', $request->service_id)->first();
        $imagePath = null;
        $size = $request->input('height') . ", " . $request->input('width') . ", " . $request->input('length');

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imgname = 'Box_' . time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('Boxes', $imgname, 'public');
        }

        $exist = CargoBoxes::where('name',  $request->name)->where('service_id', $item)->first();
        if ($exist) {
            return redirect()->back()->withErrors(['box' => 'Cargo Box Already Exists']);
        } else {
            try {
                CargoBoxes::create([
                    'branch_id' => $originBranchId,
                    'service_id' => $item,
                    'name' => $request->name,
                    'note' => $request->note,
                    'size' => $size,
                    'image' => $imagePath,
                ]);
                return redirect()->route('cargoboxes');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function editcargobox(Request $request)
    {
        $request->validate([
            'id' =>  'required|max:255',
            'name' =>  'required|max:255',
            'height' =>  'required|max:255',
            'width' =>  'required|max:255',
            'length' =>  'required|max:255',
            'note' =>  'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $id = $request->id;
        $cargoBox = CargoBoxes::find($id);
        $imagePath = null;
        $size = $request->input('height') . ", " . $request->input('width') . ", " . $request->input('length');

        if ($request->hasFile('image')) {
            $imgname = 'Box_' . time() . '_' . $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('Boxes', $imgname, 'public');

            if ($id && $cargoBox->image) {
                Storage::disk('public')->delete($cargoBox->image);
            }
        } else {
            $imagePath = $cargoBox->image;
        }

        if (!$cargoBox) {
            return redirect()->back()->withErrors(['box' => 'Cargo Box Not Found']);
        } else {
            try {
                CargoBoxes::where('id', $id)->update([
                    'name' => $request->name,
                    'note' => $request->note,
                    'size' => $size,
                    'image' => $imagePath,
                ]);
                return redirect()->route('cargoboxes');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function deletebox(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $cargoboxes = CargoBoxes::find($request->id);
        if ($cargoboxes->image) {
            Storage::disk('public')->delete($cargoboxes->image);
        }
        $cargoboxes->delete();
        return redirect()->route('cargoboxes');
    }
    public function cargoprices(): View
    {
        $user = Auth::user();
        $role = $user->type;
        $branchId = $user->branch_id;
        if ($role === 'admin') {
            $service = CargoService::with(['originBranch', 'destinationBranch'])->get();
            $cargoboxes = CargoBoxes::with([
                'branch',
                'service.originBranch',
                'service.destinationBranch',
                'prices'
            ])->orderBy('branch_id')->orderBy('service_id')->get()->groupBy(['branch_id', 'service_id']);
            foreach ($cargoboxes as &$serviceGroup) {
                foreach ($serviceGroup as &$boxes) {
                    foreach ($boxes as $box) {
                        $box->groupedPrices = $box->prices->groupBy('type');
                    }
                }
            }
            return view('servicemanager.cargoprices', compact('cargoboxes', 'service'));
        } else {
            $service = CargoService::with(['originBranch', 'destinationBranch'])->where('origin', $branchId)->get();
            $cargoboxes = CargoBoxes::with([
                'branch',
                'service.originBranch',
                'service.destinationBranch',
                'prices'
            ])->where('branch_id', $branchId)->orderBy('branch_id')->orderBy('service_id')->get()->groupBy(['branch_id', 'service_id']);
            foreach ($cargoboxes as &$serviceGroup) {
                foreach ($serviceGroup as &$boxes) {
                    foreach ($boxes as $box) {
                        $box->groupedPrices = $box->prices->groupBy('type');
                    }
                }
            }
            return view('servicemanager.cargoprices', compact('cargoboxes', 'service'));
        }

        return view('servicemanager.cargoprices');
    }
    public function addcargoprice(Request $request)
    {
        $request->validate([
            'box' =>  'required',
            'type' => 'required',
            'area' => 'required',
            'rate' => 'required|numeric',
        ]);

        $price = CargoPrices::where('box_id', $request->box)->where('type', $request->type)->where('area',  $request->area)->first();
        if ($price) {
            return redirect()->back()->withErrors(['exists' => 'Price for that area already exists.']);
        } else {
            try {
                CargoPrices::create([
                    'box_id' => $request->box,
                    'type' =>  $request->type,
                    'area' => $request->area,
                    'rate' =>  $request->rate,
                ]);
                return redirect()->route('cargoprices');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function editcargoprice(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'area' => 'required',
            'rate' => 'required|numeric',
        ]);
        try {
            CargoPrices::where('id', $request->id)->update([
                'area' => $request->area,
                'rate' =>  $request->rate,

            ]);
            return redirect()->route('cargoprices');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteprice(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $CargoPrices = CargoPrices::find($request->id);
        $CargoPrices->delete();
        return redirect()->route('cargoprices');
    }


    public function servicelocations(): View
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $userbranch = $user->branch_id;
        if ($user->type === 'admin') {
            $locations = CargoLocations::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $branchs = Branches::orderBy('country', 'asc')->orderBy('branch', 'asc')->get();
            return view('servicemanager.locations', compact('locations', 'role', 'branchs'));
        } else {
            $trucks = CargoTruck::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $locations = CargoLocations::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');

            $branchs = Branches::where('id', $userbranch)->get();
            return view('servicemanager.locations', compact('locations', 'role', 'branchs'));
        }
    }
    public function addnewlocations(Request $request)
    {
        $request->validate([
            'branch' => 'required|string',
            'region' => 'required|string',
            'area' => 'required|string',
        ]);
        $parts = explode(',', $request->input('branch'));
        $country = strtolower(trim(preg_replace('/\s+/', '', $parts[0])));
        $branch = strtolower(trim(preg_replace('/\s+/', '', $parts[1])));
        try {
            CargoLocations::create([
                'country' => $country,
                'branch' => $branch,
                'region' => $request->region,
                'areas' => $request->area,
            ]);
            return redirect()->route('servicelocations');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function addlocations(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|string',
            'region' => 'required|string',
            'area' => 'required|string',
        ]);
        $area = str_replace(' ', '', $request->area);
        $region = strtoupper($request->region);
        $exists = CargoLocations::where('branch_id', $request->branch_id)
            ->where('region', $request->region)
            ->where('areas', $area)
            ->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['service' => 'Area Already Exists.']);
        } else {
            try {
                CargoLocations::create([
                    'branch_id' => $request->branch_id,
                    'region' =>  $region,
                    'areas' => $area,
                ]);
                return redirect()->route('servicelocations');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }



    public function deleteregion(Request $request)
    {
        $request->validate([
            'region' => 'required|string',
            'branch_id' => 'required',
        ]);
        CargoLocations::where('region', $request->region)->where('branch_id', $request->branch_id)->delete();
        return redirect()->route('servicelocations');
    }
    public function deletearea(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        CargoLocations::where('id', $request->id)->delete();
        return redirect()->route('servicelocations');
    }

    public function updateArea(Request $request)
    {

        $request->validate([
            'id' => 'required|integer',
            'area' => 'required|string|max:255',
        ]);

        CargoLocations::where('id', $request->id)->update(['areas' => $request->area]);
        return redirect()->back()->with('success', 'Area updated successfully.');
    }

    public function trucklist(): View
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $role = $user->type;
        $branchid = $user->branch_id;

        if ($user->type === 'admin') {
            $trucks = CargoTruck::with('branch')->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');
            $countries = Branches::orderBy('country', 'asc')
                ->orderBy('branch', 'asc')
                ->get();

            return view('servicemanager.trucklist',  compact('trucks', 'role', 'countries'));
        } else {
            $branchs = Branches::where('id', $branchid)->first();
            $trucks = CargoTruck::with('branch')->where('branch_id', $branchid)->orderBy('branch_id', 'asc')
                ->get()
                ->groupBy('branch_id');
        }
        return view('servicemanager.trucklist', compact('trucks', 'role', 'branchid', 'branchs'));
    }

    public function addnewtruck(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|max:255',
            'model' => 'required|max:255',
            'plate' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
        ]);

        $plate = CargoTruck::where('plate', $request->plate)->first();
        if ($plate) {
            return redirect()->back()->with('error', 'Truck Already Exists.');
        } else {
            try {
                CargoTruck::create([
                    'branch_id' => $request->branch_id,
                    'model' => $request->model,
                    'plate' => $request->plate,
                    'status' => $request->status,
                    'condition' => $request->condition,
                ]);
                return redirect()->route('trucklist');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        return redirect()->route('trucklist');
    }
    public function deletetruck(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        CargoTruck::where('id', $request->id)->delete();
        return redirect()->route('trucklist');
    }
    public function edittruck(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'model' => 'required|max:255',
            'plate' => 'required|max:255',
            'status' => 'required|max:255',
            'condition' => 'required|max:255',
        ]);
        try {
            CargoTruck::where('id', $request->id)->update([
                'model' => $request->model,
                'plate' => $request->plate,
                'status' => $request->status,
                'condition' => $request->condition,
            ]);
            return redirect()->route('trucklist');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function alldeliveries(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $delivery = Delivery::with(['manager', 'driver'])->paginate($perPage);
        return view('servicemanager.deliveries', compact('perPage', 'currentPage', 'delivery'));
    }

    public function submitdelivery(Request $request)
    {
        Log::info('Raw Request Data:', [$request->getContent()]);
        Log::info('Submitted Data:', $request->all());
        $validated = $request->validate([
            'id' => 'required',
            'truck' => 'nullable|string',
            'driver' => 'nullable|string',
            'note' => 'nullable|string',
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        $user = Auth::user();

        try {
            $delivery = Delivery::find($request->id);

            if ($delivery) {
                // Decode existing order_ids; initialize to an empty array if null
                $existingOrderIds = json_decode($delivery->items, true) ?? [];

                // Check if $validated['order_ids'] is an array; if not, convert it to an array
                $newOrderIds = is_array($validated['order_ids']) ? $validated['order_ids'] : [$validated['order_ids']];

                // Merge existing order_ids with new order_ids, using array_unique to avoid duplicates
                $mergedOrderIds = array_unique(array_merge($existingOrderIds, $newOrderIds));

                // Update the delivery record
                $submittedOrder = $delivery->update([
                    'driver_id' => $request->driver,
                    'truck_id' => $request->truck,
                    'items' => json_encode($mergedOrderIds),
                    'note' => $request->note,
                    'status' => 'pending'
                ]);
                // if ($submittedOrder) {
                //     foreach ($validated['order_ids'] as $orderId) {
                //         $order = Orders::find($orderId);
                //         if ($order) {
                //             $newStatusWithTimestamp = [
                //                 'status' => "Out for delivery",
                //                 'logs' => 'Set By: ' . $user->lname . ', ' . $user->fname,
                //                 'timestamp' => now()->toDateTimeString(),
                //             ];

                //             $existingStatuses = $order->status ? json_decode($order->status, true) : [];
                //             $existingStatuses[] = $newStatusWithTimestamp;

                //             $order->status = json_encode($existingStatuses);
                //             $order->state = "OutForDelivery";
                //             $order->save();
                //         }
                //     }
                // }
            } else {
                return response()->json(['message' => 'error error error!']);
            }
            // 
            return response()->json([
                'message' => 'Delivery submitted successfully!',
                'data' => $submittedOrder
            ]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function generateTripNumber()
    {
        $randomString = bin2hex(random_bytes(10));

        return 'ID-' . substr($randomString, 0, 10);
    }


    public function DeliveryDetails($id)
    {
        // Retrieve orders that are ready for delivery
        $orders = Orders::with(['cargoService.originBranch', 'cargoService.destinationBranch'])
            ->where('state', 'ReadyForDelivery')
            ->orderBy('created_at', 'desc')->get();


        $delivery = Delivery::with(['manager', 'driver'])->where('id', $id)->first();

        $deliveryIds = [];
        if ($delivery && $delivery->items) {
            $items = json_decode($delivery->items, true); 
            if (!empty($items)) {
                $deliveryIds = array_merge($deliveryIds, $items); 
            }
        }

        // Remove duplicates if necessary
        $deliveryIds = array_unique($deliveryIds);

        // Retrieve detailed orders using the delivery IDs
        $orderDetails = Orders::whereIn('id', $deliveryIds)->get();

        // Get all drivers and trucks
        $driver = TruckDriver::get();
        $truck = CargoTruck::get();

        // Pass everything to the view
        return view('servicemanager.deliverydetails', compact('orders', 'delivery', 'driver', 'truck', 'orderDetails'));
    }
}
