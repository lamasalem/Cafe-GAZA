<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiningTableController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\InternetServiceController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InternetSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('/temp', 'cms.temp');

    Route::resource('dining-tables', DiningTableController::class);
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('internet-services', InternetServiceController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::resource('users', UserController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('order-details', OrderDetailController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('internet-sessions', InternetSessionController::class);



    Route::post('/dining-tables/update/{id}', [DiningTableController::class, 'update'])->name('dining-tables.update');
    Route::post('/internet-services/update/{id}', [InternetServiceController::class, 'update'])->name('internet-services.update');
    Route::post('/menu-categories/update/{id}', [MenuCategoryController::class, 'update'])->name('menu-categories.update');
    Route::post('/menu-items/update/{id}', [MenuItemController::class, 'update'])->name('menu-items.update');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update_custom');
    Route::post('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::post('/order-details/update/{id}', [OrderDetailController::class, 'update'])->name('order-details.update');
    Route::post('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::post('/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::post('/internet-sessions-update/{id}', [InternetSessionController::class, 'update'])->name('internet-sessions.update-post');
});