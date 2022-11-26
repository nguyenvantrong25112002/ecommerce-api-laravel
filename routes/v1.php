<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Frontend\AddresUserController;

Route::prefix('address')->group(function () {
    Route::get('city-provinces', [AddressController::class, 'cityProvincesGet']);
    Route::post('districts', [AddressController::class, 'getDistrict']);
    Route::post('ward', [AddressController::class, 'getWard']);
});
Route::prefix('address-user')->group(function () {
    Route::get('list', [AddresUserController::class, 'index']);
    Route::post('add', [AddresUserController::class, 'store']);
    Route::delete('delete/{id}', [AddresUserController::class, 'delete']);
    Route::put('update-active-default', [AddresUserController::class, 'updateActiveDefault']);
});