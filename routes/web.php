<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShoppingCarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::resource('api/inventories', InventoryController::class);
Route::get('api/inventories/allProducts/{any}', [InventoryController::class, 'getInventoryByStationId']);

Route::resource('api/stations', StationsController::class);
Route::resource('api/sales', SaleController::class);
Route::resource('api/products', ProductsController::class);
Route::resource('api/shoppingcars', ShoppingCarController::class);

Route::get('/{any}', [PageController::class, 'index'])->where('any', '.*');