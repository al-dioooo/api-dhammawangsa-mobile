<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function () {
    $token = csrf_token();

    return response()->json([
        'message' => 'Success',
        'data' => $token
    ]);
});

Route::apiResource('cart', CartController::class);

Route::apiResource('service', ServiceController::class);
Route::apiResource('service-type', ServiceTypeController::class);

Route::apiResource('transaction', TransactionController::class);
Route::post('checkout', [TransactionController::class, 'checkout']);
