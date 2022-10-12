<?php

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

Route::apiResource('/vehicle', VehicleController::class);
Route::get('catalog', [VehicleController::class, 'catalog'])->name('vehicle.catalog');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
