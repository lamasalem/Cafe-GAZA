<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiningTableController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\InternetServiceController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('/temp', 'cms.temp');
    Route::resource('dining-tables', DiningTableController::class);
    Route::resource('menu-categories', MenuCategoryController::class);
    Route::resource('internet-services', InternetServiceController::class);
});