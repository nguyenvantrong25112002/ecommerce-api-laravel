<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/admin');
Route::group(['prefix' => 'auth', 'middleware' => "guest"], function () {
    Route::get('login', [AdminController::class, 'adminLogin'])->name('login');
    Route::get('google', [AdminController::class, 'redirectToGoogle'])->name('auth.redirect-google');
    Route::get('google/callback', [AdminController::class, 'adminGoogleCallback'])->name('google-auth.callback');
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
});
// Route::get('users/{id}', function ($id) {
    
// });
// Route::get('/{any?}', function () {
//     return view('app');
// });
// Route::get('/{vue_capture?}', function () {
//     return view('app');
// })->where('vue_capture', '[\/\w\.-]*');
// Route::view("/{any}", "app")->where("any", "*");

// Route::get('upload-file', function () {
    // Storage::disk('google')->put('google-drive.txt', 'Google Drive As Filesystem In Laravel (ManhDanBlogs)');
    // dd('Đã upload file lên google drive thành công!');

    // $files = Storage::disk('local')->allFiles();
    // $files = Storage::disk('public')->allFiles();
    // dd($files);
    // $key = array_rand($files);

    // $pro = Product::find(1);

    // // dd($pro);

    // dd(Storage::disk('google')->url($pro->image, now()->addMinutes(5)));
// });