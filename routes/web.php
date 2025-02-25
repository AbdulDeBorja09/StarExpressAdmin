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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\WarehouseController;
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
        } elseif ($user->type === 'hr') {
            return redirect()->route('humanresourcehome.home');
        } else {
            Auth::logout();
        }
    });
});


// Admin
Route::middleware(['auth', 'set.timezone', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'accountantHome'])->name('admin.home');
    Route::get('/Branches', [ManagementController::class, 'Branches'])->name('admin.Branches');
    Route::get('/Services', [ManagementController::class, 'services'])->name('admin.Services');
    Route::get('/Logs/All', [LogsController::class, 'alllogs'])->name('admin.alllogs');
    Route::get('/Logs/Edit', [LogsController::class, 'editlogs'])->name('admin.editlogs');
    Route::get('/Logs/Delete', [LogsController::class, 'deletelogs'])->name('admin.deletelogs');
    Route::get('/Management/Settings', [ManagementController::class, 'settings'])->name('settings');

    Route::post('/Branch/Add', [ManagementController::class, 'submitaddBranch'])->name('submitaddBranch');
    Route::post('/Branches/edit', [ManagementController::class, 'editbranch'])->name('editbranch');
    Route::post('/Branches/delete', [ManagementController::class, 'deletebranch'])->name('deletebranch');

    Route::post('/Services', [ManagementController::class, 'submitaddservices'])->name('submitaddservices');
    Route::post('/Services/delete', [ManagementController::class, 'deleteservice'])->name('deleteservice');
    Route::post('/Services/edit', [ManagementController::class, 'editservices'])->name('editservices');
});


// Accountant
Route::middleware(['auth', 'set.timezone', 'user-access:accountant|admin'])->group(function () {
    Route::get('/Accountant', [AdminController::class, 'accountantHome'])->name('accountant.home');
    Route::get('/Reports/Allowance/{id}', [AllowanceController::class, 'allowancedetails'])->name('allowancedetails');

    Route::get('/Reports/Pending', [ExpensesController::class, 'submittedreports'])->name('submittedreports');

    Route::get('/Allowance/All', [ExpensesController::class, 'allallowance'])->name('allallowance');

    Route::get('/Income/All', [ExpensesController::class, 'allincome'])->name('allincome');
    Route::get('/Income/Cargo', [ExpensesController::class, 'cargoincome'])->name('cargoincome');
    Route::get('/Income/Report', [ExpensesController::class, 'reportincome'])->name('reportincome');

    Route::get('/Expenses/All', [ExpensesController::class, 'allexpenses'])->name('allexpenses');
    Route::get('/Expenses/Allowance', [ExpensesController::class, 'deliveryexpenses'])->name('deliveryexpenses');
    Route::get('/Expenses/Report', [ExpensesController::class, 'reportexpenses'])->name('reportexpenses');

    Route::post('/Orders/Approve', [OrdersController::class, 'approveorder'])->name('approveorder');
    Route::post('/Orders/Delete', [OrdersController::class, 'deleteorder'])->name('deleteorder');
    Route::post('/Orders/Paid', [OrdersController::class, 'markaspaid'])->name('markaspaid');

    Route::post('/Reports/Allowance/Approve', [AllowanceController::class, 'allowanceapprove'])->name('allowanceapprove');
    Route::post('/Reports/Allowance/Reject', [AllowanceController::class, 'allowancereject'])->name('allowancereject');
    Route::post('/Reports/Allowance/Complete', [AllowanceController::class, 'allowanceacomplete'])->name('allowanceacomplete');

    Route::post('/Reports/Approve', [ExpensesController::class, 'approvereport'])->name('approvereport');
    Route::post('/Reports/Rejmect', [ExpensesController::class, 'rejectreport'])->name('rejectreport');

    Route::post('/Reports/New/Submit', [ExpensesController::class, 'createnewreport'])->name('createnewreport');
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
    Route::get('/Delivery/history', [ServiceManagerController::class, 'deliveryhistory'])->name('deliveryhistory');
    Route::get('/Delivery/Packages/{id}', [ServiceManagerController::class, 'DeliveryDetails'])->name('DeliveryDetails');
    Route::get('/Vouchers', [ServiceManagerController::class, 'vouchers'])->name('vouchers');
    Route::get('/Report/Pending', [ExpensesController::class, 'submittedreports'])->name('allreports');
    Route::get('/Warehouse', [WarehouseController::class, 'warehouse'])->name('warehouse');


    Route::post('/Warehouse/Setlimit', [WarehouseController::class, 'savelimit'])->name('savelimit');
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
    Route::post('/Details/Batchstatusedit', [OrdersController::class, 'MultipleupdateStatus'])->name('MultipleupdateStatus');
    Route::put('/statuses/{index}', [OrdersController::class, 'editstatus'])->name('statuses.update');
    Route::put('/orders/{order}/statuses/{index}/edit', [OrdersController::class, 'editStatus'])->name('statuses.edit');

    Route::post('/submit-orders', [ServiceManagerController::class, 'submitdelivery'])->name('submitdelivery');
    Route::post('/Delivery/Create', [ServiceManagerController::class, 'createdelivery'])->name('createdelivery');
    Route::post('/Delivery/Deploy', [ServiceManagerController::class, 'deploydelivery'])->name('deploydelivery');
    Route::post('/Delivery/Delete', [ServiceManagerController::class, 'deletedelivery'])->name('deletedelivery');



    Route::post('/Allowance/Create', [AllowanceController::class, 'createallowance'])->name('createallowance');
    Route::post('/Allowance/Edit', [AllowanceController::class, 'editallowance'])->name('editallowance');

    Route::post('/Reports/Request/New', [ExpensesController::class, 'requestreport'])->name('requestreport');

    Route::post('/Voucher/New', [ServiceManagerController::class, 'newvoucher'])->name('newvoucher');
    Route::post('/Voucher/Edit', [ServiceManagerController::class, 'editvoucher'])->name('editvoucher');
    Route::post('/Voucher/Delete', [ServiceManagerController::class, 'deletevoucher'])->name('deletevoucher');
});



// Human Resoureces
Route::middleware(['auth', 'set.timezone', 'user-access:hr|admin'])->group(function () {
    Route::get('/HumanResource', [DashboardController::class, 'humanresourceHome'])->name('humanresourcehome.home');
    Route::get('/Employees', [HrController::class, 'allEmployees'])->name('allEmployees');
    Route::get('/Employees/add', [HrController::class, 'addEmployees'])->name('addEmployees');
    Route::get('/Employees/Edit/{id}', [HrController::class, 'editemployee'])->name('editemployee');
    Route::get('/Driver/Edit/{id}', [HrController::class, 'editdriveraccount'])->name('editdriveraccount');
    Route::get('/Drivers', [HrController::class, 'allDriver'])->name('allDriver');
    Route::get('/Driver/add', [HrController::class, 'truckdriveradd'])->name('truckdriveradd');
    Route::get('/Customer/All', [HrController::class, 'allcustomer'])->name('allcustomer');
    Route::get('/Customer/Visits', [HrController::class, 'customervisit'])->name('customervisit');
    Route::get('/Suspended/Users', [HrController::class, 'showsuspendeduser'])->name('showsuspendeduser');
    Route::get('/Suspended/Driver', [HrController::class, 'showsuspenddriver'])->name('showsuspenddriver');
    Route::get('/Suspended/Employee', [HrController::class, 'showsuspendemployee'])->name('showsuspendemployee');
    Route::get('/Suspended/History/User', [HrController::class, 'susppensionuserhistory'])->name('susppensionuserhistory');
    Route::get('/Suspended/History/Employee', [HrController::class, 'susppensionemployeehistory'])->name('susppensionemployeehistory');
    Route::get('/Suspended/History/Driver', [HrController::class, 'susppensiondriverhistory'])->name('susppensiondriverhistory');
    Route::get('/Logins/Logs', [HrController::class, 'loginlogs'])->name('loginlogs');

    Route::post('/Suspend', [HrController::class, 'suspend'])->name('suspend');
    Route::post('/Suspended/User/Delete', [HrController::class, 'deleteuseraccount'])->name('deleteuseraccount');
    Route::post('/Suspended/User/Lift', [HrController::class, 'liftusersuspend'])->name('liftusersuspend');

    Route::post('/Driver/add', [HrController::class, 'submitadddriver'])->name('submitadddriver');
    Route::post('/Driver/Edit', [HrController::class, 'submitdriveredit'])->name('submitdriveredit');

    Route::post('/Employees/Add', [HrController::class, 'submitaddEmployees'])->name('submitaddEmployees');
    Route::post('/Employees/Delete', [HrController::class, 'deleteemployee'])->name('deleteemployee');
    Route::post('/Employees/Edit', [HrController::class, 'submitemployeeedit'])->name('submitemployeeedit');
});


// All user
Route::middleware(['auth', 'set.timezone', 'user-access:servicemanager|admin|accountant'])->group(function () {
    Route::get('/details/{reference_number}', [OrdersController::class, 'orderdetails']);
    Route::get('/Reports/New', [ExpensesController::class, 'newreport'])->name('newreport');
    Route::get('/Orders/All', [OrdersController::class, 'allorders'])->name('allorders');
    Route::get('/Orders/PendingOrders', [OrdersController::class, 'pendingorders'])->name('pendingorders');
    Route::get('/Orders/OutForDelivery', [OrdersController::class, 'outfordelivery'])->name('outfordelivery');
    Route::get('/Orders/ReadyForDelivery', [OrdersController::class, 'readyfordelivery'])->name('readyfordelivery');
    Route::get('/Orders/Delivered', [OrdersController::class, 'deliverdorders'])->name('deliverdorders');
    Route::get('/Orders/NewOrders', [OrdersController::class, 'neworders'])->name('neworders');
    Route::get('/Reports/Allowance', [AllowanceController::class, 'allowancerequest'])->name('allowancerequest');
    Route::get('/Allowance/History', [AllowanceController::class, 'allowancehistory'])->name('allowancehistory');
    Route::get('/Report/Details/{type}/{id}', [ExpensesController::class, 'viewreportdetails'])->name('viewreportdetails');
    Route::get('/Report/History', [ExpensesController::class, 'reporthistory'])->name('reporthistory');
    // Route::get('/Report/New', [ServiceManagerController::class, 'newreport'])->name('newreport');
});



Route::get('/chat', [ChatController::class, 'chatpage']);
Route::post('/Chat/Send', [ChatController::class, 'sendmsg'])->name('send.message');
Route::post('/Maintenance/Toggle', [MaintenanceController::class, 'toggle'])->name('ToggleMaintenance');


Route::middleware('auth')->get('/notifications', [NotificationController::class, 'getNotifications']);
Route::middleware('auth')->put('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead']);
Route::get('/Cargo/Trucks/Reports', [TruckController::class, 'ViewTruckReport'])->name('ViewTruckReport');
