<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('cart', CartController::class);

Route::get('/token', function () {
    $token = csrf_token();

    return response()->json([
        'message' => 'Success',
        'data' => $token
    ]);
});
