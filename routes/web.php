<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ServiceManagerController;


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

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/Management', [ManagementController::class, 'management'])->name('admin.managment');
    Route::get('/Employees', [ManagementController::class, 'allEmployees'])->name('admin.allEmployees');
    Route::get('/Employees/add', [ManagementController::class, 'addEmployees'])->name('admin.addEmployees');
    Route::get('/Services', [ManagementController::class, 'services'])->name('admin.Services');

    Route::post('/Employees/add', [ManagementController::class, 'submitaddEmployees'])->name('submitaddEmployees');
    Route::post('/Management/branch', [ManagementController::class, 'submitaddBranch'])->name('submitaddbranch');
    Route::post('/Management/country', [ManagementController::class, 'submitaddcountry'])->name('submitaddcountry');
    Route::post('/Services', [ManagementController::class, 'submitaddservices'])->name('submitaddservices');
});

Route::middleware(['auth', 'user-access:accountant|admin'])->group(function () {
    Route::get('/Accountant', [AdminController::class, 'accountantHome'])->name('accountant.home');
});

Route::middleware(['auth', 'user-access:servicemanager|admin'])->group(function () {
    Route::get('/Servicemanager', [AdminController::class, 'servicemanagerHome'])->name('servicemanager.home');
    Route::get('/Cargo_price', [ServiceManagerController::class, 'cargoprices'])->name('cargoprices');
    Route::get('/Cargo_locations', [ServiceManagerController::class, 'servicelocations'])->name('servicelocations');
    Route::get('/Cargo_truck_list', [ServiceManagerController::class, 'trucklist'])->name('trucklist');

    Route::post('/Cargo_locations/add_new_location', [ServiceManagerController::class, 'addnewlocations'])->name('addnewlocations');
    Route::post('/Cargo_locations/add_area', [ServiceManagerController::class, 'addlocations'])->name('addlocations');
    Route::post('/Cargo_locations/add_region', [ServiceManagerController::class, 'addregion'])->name('addregion');
    Route::post('/Cargo_locations/delete_region', [ServiceManagerController::class, 'deleteregion'])->name('deleteregion');
    Route::post('/Cargo_locations/delete_area', [ServiceManagerController::class, 'deletearea'])->name('deletearea');
    Route::post('/Cargo_locations/update_area', [ServiceManagerController::class, 'updateArea'])->name('updateArea');


    Route::post('/Cargo_Truck/delete', [ServiceManagerController::class, 'deletetruck'])->name('deletetruck');
    Route::post('/Cargo_Truck/addnew', [ServiceManagerController::class, 'addnewtruck'])->name('addnewtruck');
    Route::post('/Cargo_Truck/edit', [ServiceManagerController::class, 'edittruck'])->name('edittruck');
});
