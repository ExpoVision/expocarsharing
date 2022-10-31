<?php

use App\Versions\V1\Http\Controllers\Api\Admin\RentController;
use App\Versions\V1\Http\Controllers\Api\FilterController;
use App\Versions\V1\Http\Controllers\Api\OfferController;
use App\Versions\V1\Http\Controllers\Api\OrderController;
use App\Versions\V1\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('order', OrderController::class)->only(['show']);
Route::group(['prefix' => 'order-process'], function () {
    Route::get('reserved',   [RentController::class, 'reserved'])->name('order.reserved');
    Route::get('rented',     [RentController::class, 'rented'])->name('order.rented');
    Route::get('confirming', [RentController::class, 'confirming'])->name('order.confirming');
});

Route::get('filter-values', [FilterController::class, 'getFilterValues'])->name('filter.values');

Route::apiResource('/vehicle', VehicleController::class);

Route::apiResource('offer', OfferController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
