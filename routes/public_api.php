<?php

use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::prefix('product')->group(function () {
    Route::get('new-home', [ProductController::class, 'getProductNewHome']);
    Route::get('sale-home', [ProductController::class, 'getProductSaleHome']);
    Route::get('{slug}', [ProductController::class, 'detailProduct']);
    Route::get('relate-to/{slug}', [ProductController::class, 'productRelateTo']);
});

Route::prefix('banner')->group(function () {
    Route::get('home', [BannerController::class, 'getBannerHome']);
});

Route::prefix('category')->group(function () {
    Route::get('parent', [CategoryController::class, 'getParent']);
    Route::get('{slug}/products', [CategoryController::class, 'getCategoryProduct']);
});


Route::post('upload-file', function (Request $request) {
    // \Storage::disk('google')->put('google-drive.txt', 'Google Drive As Filesystem In Laravel (ManhDanBlogs)');
    // dd('Đã upload file lên google drive thành công!');

    // $files = Storage::disk('local')->allFiles('public/img/products');
    // $key = array_rand($files);

    // // Display the random array element
    // echo $files[$key];


    dd($request->all());
});