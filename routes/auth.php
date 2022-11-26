<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->group(function () {
    Route::post('google', [AuthController::class, 'googleLogin']);
    Route::get('google/callback', [AuthController::class, 'googleCallback']);
});
Route::get('fake-login', [AuthController::class, 'fake_login']);