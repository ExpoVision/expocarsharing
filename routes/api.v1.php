<?php

use App\Versions\V1\Http\Controllers\Api\UserPayController;
use App\Versions\V1\Http\Controllers\Api\Auth\AuthController;
use App\Versions\V1\Http\Controllers\Api\Auth\RegisterController;
use App\Versions\V1\Http\Controllers\Api\FaqController;
use App\Versions\V1\Http\Controllers\Api\FeedbackController;
use App\Versions\V1\Http\Controllers\Api\FilterController;
use App\Versions\V1\Http\Controllers\Api\OfferController;
use App\Versions\V1\Http\Controllers\Api\OrderController;
use App\Versions\V1\Http\Controllers\Api\ReviewController;
use App\Versions\V1\Http\Controllers\Api\StatisticsController;
use App\Versions\V1\Http\Controllers\Api\UserController;
use App\Versions\V1\Http\Controllers\Api\UserProfileController;
use App\Versions\V1\Http\Controllers\Api\VehicleClassController;
use App\Versions\V1\Http\Controllers\Api\VehicleController;
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

Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/admin/register', [RegisterController::class, 'adminRegister'])->name('auth.admin.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::apiResource('offer', OfferController::class)->only(['show', 'index']);
Route::apiResource('vehicle', VehicleController::class)->only(['show', 'index']);
Route::apiResource('vehicle-class', VehicleClassController::class)->only(['show', 'index']);
Route::apiResource('faq', FaqController::class)->only(['show', 'index']);
Route::apiResource('review', ReviewController::class)->only(['store', 'show', 'index']);

Route::get('feedback/archival', [FeedbackController::class, 'archival'])->name('feedback.archival');
Route::apiResource('feedback', FeedbackController::class)->only(['show', 'index']);
Route::get('service/statistics', StatisticsController::class)->name('service.statistics');

Route::middleware(['auth:sanctum', 'auth.admin'])->group(function () {
    Route::apiResource('user', UserController::class)->only(['index', 'update', 'show', 'destroy']);

    Route::apiResource('vehicle', VehicleController::class)->only(['edit', 'create', 'update', 'store', 'destroy']);
    Route::apiResource('feedback', FeedbackController::class)->only(['edit', 'create', 'update', 'store', 'destroy']);
    Route::apiResource('offer', OfferController::class)->only(['edit', 'create', 'update', 'store', 'destroy']);

    Route::post('order/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::get('order/archival', [OrderController::class, 'archival'])->name('order.archival');
    Route::get('reserved',   [OrderController::class, 'reserved'])->name('order.reserved');
    Route::get('rented',     [OrderController::class, 'rented'])->name('order.rented');
    Route::get('confirming', [OrderController::class, 'confirming'])->name('order.confirming');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('fetchProfile', [UserController::class, 'fetchProfile'])->name('user.fetchProfile');
    Route::post('user-password/{user}', [UserController::class, 'updatePassword'])->name('user.password-update');

    Route::get('user-pay/{user}', [UserPayController::class, 'show'])->name('user-pay.show');
    Route::get('user-profile/{user}', [UserProfileController::class, 'show'])->name('user-profile.show');
    Route::post('user-pay', [UserPayController::class, 'store'])->name('user-pay.store');
    Route::post('user-profile', [UserProfileController::class, 'store'])->name('user-profile.store');

    Route::resource('order', OrderController::class)->only(['index', 'show']);

    Route::group(['prefix' => 'order-process'], function () {
        Route::post('reserv/{offer}', [OrderController::class, 'reserv'])->name('order.reserv');
        Route::post('confirmRent/{order}', [OrderController::class, 'confirmRent'])->name('order.confirmRent');
        Route::post('confirmPayment/{order}', [OrderController::class, 'confirmPayment'])->name('order.confirmPayment');
        Route::post('rent/{order}', [OrderController::class, 'rent'])->name('order.rent');
        Route::post('finish/{order}', [OrderController::class, 'finish'])->name('order.finish');
        Route::post('cancel/{order}', [OrderController::class, 'cancel'])->name('order.cancel');
    });
});

Route::get('filter-values', [FilterController::class, 'getFilterValues'])->name('filter.values');
