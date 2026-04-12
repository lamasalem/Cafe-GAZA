<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiningTableController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\InternetServiceController;
use App\Http\Controllers\UserController; // 1. استدعاء كنترولر المستخدمين

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('/temp', 'cms.temp');
    
    Route::resource('dining-tables', DiningTableController::class);
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('internet-services', InternetServiceController::class);
    
    // 2. إضافة resource الخاص بالمستخدمين
    Route::resource('users', UserController::class);
    
    // مسارات التعديل (Update) المخصصة للـ AJAX
    Route::post('/dining-tables/update/{id}', [DiningTableController::class, 'update'])->name('dining-tables.update');
    Route::post('/internet-services/update/{id}', [InternetServiceController::class, 'update'])->name('internet-services.update');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update_custom'); // 3. مسار تعديل المستخدمين
});