<?php

use App\Versions\V1\Http\Controllers\Api\Auth\AuthController;
use App\Versions\V1\Http\Controllers\Api\Auth\RegisterController;
use App\Versions\V1\Http\Controllers\Api\FilterController;
use App\Versions\V1\Http\Controllers\Api\OfferController;
use App\Versions\V1\Http\Controllers\Api\OrderController;
use App\Versions\V1\Http\Controllers\Api\VehicleClassController;
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

const USERS_ROUTES = ['show', 'index'];
const ADMIN_ROUTES = ['edit', 'create', 'update', 'store'];

Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/admin/register', [RegisterController::class, 'adminRegister'])->name('auth.admin.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::apiResource('/vehicle', VehicleController::class)->only(USERS_ROUTES);
Route::apiResource('vehicle-class', VehicleClassController::class)->only(USERS_ROUTES);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('order', OrderController::class)->only(['show']);
    Route::group(['prefix' => 'order-process'], function () {
        Route::post('reserv/{offer}', [OrderController::class, 'reserv'])->name('order.reserv');
        Route::post('confirmRent/{order}', [OrderController::class, 'confirmRent'])->name('order.confirmRent');
        Route::post('confirmPayment/{order}', [OrderController::class, 'confirmPayment'])->name('order.confirmPayment');
        Route::post('rent/{order}', [OrderController::class, 'rent'])->name('order.rent');
        Route::post('finish/{order}', [OrderController::class, 'finish'])->name('order.finish');

        Route::get('reserved',   [OrderController::class, 'reserved'])->name('order.reserved');
        Route::get('rented',     [OrderController::class, 'rented'])->name('order.rented');
        Route::get('confirming', [OrderController::class, 'confirming'])->name('order.confirming');
    });

    Route::get('filter-values', [FilterController::class, 'getFilterValues'])->name('filter.values');

    Route::apiResource('/vehicle', VehicleController::class)->only(ADMIN_ROUTES);

    Route::apiResource('offer', OfferController::class);
});
