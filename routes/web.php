<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StationsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShoppingCarController;
use App\Http\Controllers\RefillController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/projects/allgold/api/inventories/refillProducts', [InventoryController::class, 'getRefill']);
Route::resource('/projects/allgold/api/inventories', InventoryController::class);
Route::get('/projects/allgold/api/inventories/allProducts/{any}', [InventoryController::class, 'getInventoryByStationId']);

Route::resource('/projects/allgold/api/stations', StationsController::class);

Route::resource('/projects/allgold/api/sales', SaleController::class);

Route::resource('/projects/allgold/api/products', ProductsController::class);

Route::resource('/projects/allgold/api/shoppingcars', ShoppingCarController::class);

Route::resource('/projects/allgold/api/refills', RefillController::class);

Route::get('/{any}', [PageController::class, 'index'])->where('any', '.*');