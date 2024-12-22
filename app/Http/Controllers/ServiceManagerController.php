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
use App\Models\Income;
use App\Models\Expenses;
use App\Models\DeliveryAllowance;
use App\Models\Voucher;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Vue;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
                    $query->where('id', $branchId);
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

            $locations = CargoLocations::with('branch')->where('branch_id', $user->branch_id)->orderBy('branch_id', 'asc')
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


    public function createdelivery(Request $request)
    {
        $request->validate([
            'date' => 'required|string',
            'status' => 'required|string',
            'note' => 'required|string',
        ]);


        try {
            Delivery::create([
                'trip_id' => 'ID-' . uniqid(),
                'manager_id' => Auth::id(),
                'date' => $request->date,
                'status' => $request->status,
                'note' => $request->note,
            ]);

            return redirect()->route('alldeliveries');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function alldeliveries(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);

        $delivery = Delivery::with(['manager', 'driver', 'truck'])->whereIn('status', ['ready', 'pending', 'deployed'])->paginate($perPage);
        return view('servicemanager.deliveries', compact('perPage', 'currentPage', 'delivery'));
    }

    public function submitdelivery(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'truck' => 'nullable|string',
            'driver' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'required|string',
            'order_ids' => 'nullable|array',
            'order_ids.*' => 'exists:orders,id',
        ]);

        $validated['order_ids'] = $validated['order_ids'] ?? [];

        $user = Auth::user();

        try {
            $delivery = Delivery::find($request->id);

            $allowance = DeliveryAllowance::where('delivery_id', $request->id)->first();
            if ($allowance) {
                $allowance->update([
                    'driver_id' => $request->driver,
                ]);
            }

            if ($delivery) {
                $oldids = json_decode($delivery->items, true);
                $newids = $validated['order_ids'];
                if (is_null($oldids)) {
                    $oldids = [];
                }

                if (!empty($oldids)) {
                    $removedIds = array_diff($oldids, $newids);
                    foreach ($removedIds as $id) {
                        $order = Orders::find($id);
                        if ($order) {
                            $order->state = 'ReadyForDelivery';
                            $order->save();
                        }
                    }
                }
                $submittedOrder = $delivery->update([
                    'driver_id' => $request->driver,
                    'truck_id' => $request->truck,
                    'items' => json_encode($newids),
                    'note' => $request->note,
                    'status' => $request->status,
                ]);

                if ($submittedOrder) {
                    foreach ($newids as $orderId) {
                        $order = Orders::find($orderId);
                        if ($order) {
                            $order->state = "AssignedToTruck";
                            $order->save();
                        }
                    }
                }
            } else {
                return response()->json(['message' => 'Delivery not found!'], 404);
            }

            return response()->json([
                'message' => 'Delivery submitted successfully!',
                'data' => $submittedOrder,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }






    private function generateTripNumber()
    {
        $randomString = bin2hex(random_bytes(10));

        return 'ID-' . substr($randomString, 0, 10);
    }


    public function DeliveryDetails($id)
    {
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
        $deliveryIds = array_unique($deliveryIds);
        $orderDetails = Orders::whereIn('id', $deliveryIds)->get();
        $driver = TruckDriver::get();
        $truck = CargoTruck::get();
        $allowance = DeliveryAllowance::where('delivery_id', $id)->first();


        return view('servicemanager.deliverydetails', compact('orders', 'delivery', 'driver', 'truck', 'orderDetails', 'allowance'));
    }
    public function vouchers(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $currentPage = $request->input('page', 1);
        $voucher = Voucher::paginate($perPage);
        return view('servicemanager.vouchers', compact('voucher', 'perPage', 'currentPage'));
    }

    public function deploydelivery(Request $request)
    {
        $delivery = Delivery::find($request->id);
        if (is_null($delivery->items) || is_null($delivery->driver_id) || is_null($delivery->truck_id)) {
            return redirect()->back()->withErrors(['error' => 'Delivery has missing information. Please complete all fields before deploying.']);
        }
        if ($delivery) {
            try {
                Delivery::where('id', $request->id)->update([
                    'status' => 'deployed'
                ]);
                CargoTruck::where('id', $delivery->truck_id)->update([
                    'status' => 'In Use'
                ]);

                $orderIds = json_decode($delivery->items, true);
                $newStatusWithTimestamp = [
                    'status' => "Out for delivery",
                    'logs' => 'Set By: ' . Auth::user()->lname . ', ' . Auth::user()->fname,
                    'timestamp' => now()->toDateTimeString(),
                ];

                foreach ($orderIds as $id) {
                    $order = Orders::find($id);
                    if ($order) {
                        $existingStatuses = $order->status ? json_decode($order->status, true) : [];
                        $existingStatuses[] = $newStatusWithTimestamp;
                        $order->status = json_encode($existingStatuses);
                        $order->state = 'OutForDelivery';
                        $order->save();
                    }
                }


                return redirect()->route('alldeliveries');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function newreport()
    {
        return view('servicemanager.addreport');
    }
}
