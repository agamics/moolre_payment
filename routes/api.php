<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\OtpController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments/initialize', [PaymentController::class, 'initialize']);
    Route::post('/payments/checkout', [PaymentController::class, 'checkout']);
    Route::post('/payments/verify-otp', [OtpController::class, 'verify_otp']);
});

Route::post('/user/create', [AuthController::class, 'register']);
