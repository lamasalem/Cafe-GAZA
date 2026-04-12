<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiningTableController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\InternetServiceController;
use App\Http\Controllers\MenuItemController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('/temp', 'cms.temp');
    Route::resource('dining-tables', DiningTableController::class);
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('internet-services', InternetServiceController::class);
    Route::post('/dining-tables/update/{id}', [DiningTableController::class, 'update'])->name('dining-tables.update');
    Route::post('/internet-services/update/{id}', [InternetServiceController::class, 'update'])->name('internet-services.update');
    Route::post('/menu-categories/update/{id}', [MenuCategoryController::class, 'update'])->name('menu-categories.update');
    Route::resource('menu-items', MenuItemController::class);
    Route::post('/menu-items/update/{id}', [MenuItemController::class, 'update'])->name('menu-items.update');



    });