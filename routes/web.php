<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ServiceManagerController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TruckController;
use app\Models\CargoService;

Route::get('/', [LoginController::class, 'showLoginForm']);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();
        if ($user->type === 'accountant') {
            return redirect()->route('accountant.home');
        } elseif ($user->type === 'admin') {
            return redirect()->route('admin.home');
        } elseif ($user->type === 'servicemanager') {
            return redirect()->route('servicemanager.home');
        } else {
            Auth::logout();
        }
    });
});


// Admin
Route::middleware(['auth', 'set.timezone', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/Branches', [ManagementController::class, 'Branches'])->name('admin.Branches');
    Route::get('/Services', [ManagementController::class, 'services'])->name('admin.Services');

    Route::post('/Branch/Add', [ManagementController::class, 'submitaddBranch'])->name('submitaddBranch');
    Route::post('/Branches/edit', [ManagementController::class, 'editbranch'])->name('editbranch');
    Route::post('/Branches/delete', [ManagementController::class, 'deletebranch'])->name('deletebranch');

    Route::post('/Services', [ManagementController::class, 'submitaddservices'])->name('submitaddservices');
    Route::post('/Services/delete', [ManagementController::class, 'deleteservice'])->name('deleteservice');
    Route::post('/Services/edit', [ManagementController::class, 'editservices'])->name('editservices');
});

Route::middleware(['auth', 'set.timezone', 'user-access:accountant|admin'])->group(function () {
    Route::get('/Accountant', [AdminController::class, 'accountantHome'])->name('accountant.home');
});


// Serive Manager
Route::middleware(['auth', 'set.timezone', 'user-access:servicemanager|admin'])->group(function () {
    Route::get('/Servicemanager', [AdminController::class, 'servicemanagerHome'])->name('servicemanager.home');
    Route::get('/Cargo_Boxes', [ServiceManagerController::class, 'cargoboxes'])->name('cargoboxes');
    Route::get('/Cargo_Prices', [ServiceManagerController::class, 'cargoprices'])->name('cargoprices');
    Route::get('/Cargo_locations', [ServiceManagerController::class, 'servicelocations'])->name('servicelocations');
    Route::get('/Cargo_truck_list', [TruckController::class, 'trucklist'])->name('trucklist');
    Route::get('/branches/{serviceId}', [ServiceManagerController::class, 'getBranches']);
    Route::get('/areas/{locationID}', [ServiceManagerController::class, 'getAreas']);
    Route::get('/Deliveries', [ServiceManagerController::class, 'alldeliveries'])->name('alldeliveries');
    Route::get('/Delivery/Packages/{id}', [ServiceManagerController::class, 'DeliveryDetails'])->name('DeliveryDetails');

    Route::post('/Cargo_locations/add_area', [ServiceManagerController::class, 'addlocations'])->name('addlocations');
    Route::post('/Cargo_locations/add_region', [ServiceManagerController::class, 'addregion'])->name('addregion');
    Route::post('/Cargo_locations/delete_region', [ServiceManagerController::class, 'deleteregion'])->name('deleteregion');
    Route::post('/Cargo_locations/delete_area', [ServiceManagerController::class, 'deletearea'])->name('deletearea');
    Route::post('/Cargo_locations/update_area', [ServiceManagerController::class, 'updateArea'])->name('updateArea');

    Route::post('/Cargo_Truck/delete', [TruckController::class, 'deletetruck'])->name('deletetruck');
    Route::post('/Cargo_Truck/addnew', [TruckController::class, 'addnewtruck'])->name('addnewtruck');
    Route::post('/Cargo_Truck/edit', [TruckController::class, 'edittruck'])->name('edittruck');

    Route::post('/Cargo_Box/add', [ServiceManagerController::class, 'addcargobox'])->name('addcargobox');
    Route::post('/Cargo_Box/edit', [ServiceManagerController::class, 'editcargobox'])->name('editcargobox');
    Route::post('/Cargo_Box/delete', [ServiceManagerController::class, 'deletebox'])->name('deletebox');

    Route::post('/Cargo_Price/add', [ServiceManagerController::class, 'addcargoprice'])->name('addcargoprice');
    Route::post('/Cargo_Price/delete', [ServiceManagerController::class, 'deleteprice'])->name('deleteprice');
    Route::post('/Cargo_Price/edit', [ServiceManagerController::class, 'editcargoprice'])->name('editcargoprice');

    Route::post('/Details/statusedit', [OrdersController::class, 'updateStatus'])->name('updateStatus');
    Route::put('/statuses/{index}', [OrdersController::class, 'editstatus'])->name('statuses.update');
    Route::put('/orders/{order}/statuses/{index}/edit', [OrdersController::class, 'editStatus'])->name('statuses.edit');

    Route::post('/submit-orders', [ServiceManagerController::class, 'submitdelivery'])->name('submitdelivery');
    Route::post('/create-delivery', [ServiceManagerController::class, 'createdelivery'])->name('createdelivery');
});



// Human Resoureces
Route::middleware(['auth', 'set.timezone', 'user-access:hr|admin'])->group(function () {
    Route::get('/Employees', [HrController::class, 'allEmployees'])->name('allEmployees');
    Route::get('/Employees/add', [HrController::class, 'addEmployees'])->name('addEmployees');
    Route::get('/Driver/add', [HrController::class, 'truckdriveradd'])->name('truckdriveradd');

    Route::post('/Driver/add', [HrController::class, 'submitadddriver'])->name('submitadddriver');
    Route::post('/Employees/add', [HrController::class, 'submitaddEmployees'])->name('submitaddEmployees');
    Route::post('/Employees/delete', [HrController::class, 'deleteemployee'])->name('deleteemployee');
});




// Global Access
Route::middleware(['auth', 'set.timezone', 'user-access:servicemanager|admin|accountant'])->group(function () {
    Route::get('/details/{reference_number}', [OrdersController::class, 'orderdetails']);
    Route::get('/AllOrders', [OrdersController::class, 'allorders'])->name('allorders');
    Route::get('/PendingOrders', [OrdersController::class, 'pendingorders'])->name('pendingorders');
    Route::get('/OutForDelivery', [OrdersController::class, 'outfordelivery'])->name('outfordelivery');







    Route::get('/Chat', [ChatController::class, 'chatpage'])->name('chatpage');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages']);
    Route::post('/chat/send', [ChatController::class, 'sendMessage']);
});
