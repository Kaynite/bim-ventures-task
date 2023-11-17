<?php

use App\Http\Controllers\Api\Customer\AuthController;
use App\Http\Controllers\Api\Customer\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:customer')->group(function () {
    Route::get('transactions', TransactionController::class);
});

Route::post('login', [AuthController::class, 'login']);
