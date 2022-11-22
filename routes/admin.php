<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PropertiesController;
use App\Http\Controllers\Backend\UserController;

// Route::prefix('product')->group(function () {
//     Route::post('', [ProductController::class, 'index']);
// });

// Route::prefix('category')->group(function () {
//     Route::get('all', [CategoryController::class, 'getAll']);
// });




Route::get('logout', [AdminController::class, 'logout'])->name('logout');
Route::get('', [DashboardController::class, 'index'])->name('dashboard');
// Route::prefix('auth')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('auth.login');
//     Route::post('/login', [AdminController::class, 'loginAdmin'])->name('auth.loginCheck');
// });

Route::get('upload-file', function () {
    Storage::disk('google')->put('google-drive.txt', 'Google Drive As Filesystem In Laravel (ManhDanBlogs)');
    dd('Đã upload file lên google drive thành công!');
});




Route::prefix('categorys')->as('category.')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/add', 'create')->name('add.form');
    Route::post('/add-save', 'store')->name('add.save');
    Route::get('/edit-form/{id}', 'edit')->name('edit.form');
    Route::put('/edit-save/{id}', 'update')->name('edit.save');
    Route::get('/delete/{id}', 'destroy')->name('delete');
    Route::get('/delete-all', 'destroyAll')->name('delete.all');
});

Route::prefix('product')->as('product.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/add', 'create')->name('add.form');
    Route::post('/add-save', 'store')->name('add.save');
    // Route::get('/delete/{id}', 'destroy')->name('delete');
    Route::get('/delete', 'destroy')->name('delete');
    Route::get('/edit-form/{id}', 'edit')->name('edit.form');
    Route::post('/edit-save/{id}', 'update')->name('edit.save');
    Route::prefix('detail/{id}')->as('detail.')->group(function () {
        Route::get('', 'show')->name('index');
        Route::get('/list-gallery', 'listGallery')->name('list.gallery');
        Route::post('/add-gallery', 'addGallery')->name('add.gallery');
        Route::delete('/remove-gallery', 'removeGallery')->name('remove.gallery');
        Route::post('/add-properties', 'addProperties')->name('add.properties');
        Route::post('/add-species', 'addSpecies')->name('add.species');
        Route::get('species', 'listSpeciesProduct')->name('list.species');
    });
});

Route::prefix('product-properties')->controller(PropertiesController::class)->group(function () {
    Route::get('/', 'index')->name('properties.list');
    Route::post('/add-save-properties', 'storeProperties')->name('properties.add.save');
    Route::post('/add-save-properties-species', 'storeSpecies')->name('species.add.save');
    Route::put('/edit-save-properties/{id}', 'updateProperties')->name('properties.edit.save');
    Route::delete('/delete-properties', 'destroyProperties')->name('properties.delete');
    Route::delete('/delete-properties-species', 'destroySpecies')->name('species.delete');
    Route::get('species', 'showSpecies')->name('species.show');
    Route::put('edit-save-species', 'updateSpecies')->name('species.update');
});
// -> controller(PostController::class)
Route::prefix('user')->as('user.')->group(function () {
    Route::get('', [UserController::class, 'getListUser'])->name('list');
});
Route::prefix('personnel')->as('personnel.')->controller(UserController::class)->group(function () {
    Route::get('',  'getListAdmin')->name('list');
    Route::get('add',  'addAdmin')->name('add');
    Route::post('add-role-admin',  'addSaveAdmin')->name('add.role.admin.save');
    Route::get('search',  'searchUser')->name('search');
    Route::post('', 'editRoleAdmin')->name('list.edit.role');
});
Route::get('test', function () {
    $files = Storage::disk('public-folder-images')->allFiles();
    // $files = File::allFiles(public_path());
    dd($files);
});



// 'role:admin|editer|writer|publisher'
// Route::middleware('CheckLoginAdmin')->group(function () {
// Route::group(['middleware' => ['CheckLoginAdmin', 'impersonate']], function () {

//     Route::get('/register', [
//         AdminController::class, 'registerAdmin'
//     ])->name('admin.auth.register');
//     Route::post('/register-save', [AdminController::class, 'create'])->name('admin.auth.registerSave');
//     Route::get('/logout', [AdminController::class, 'logoutAdmin'])->name('admin.auth.logoutAdmin');
//     Route::get('impersonate-role/{id_admin}/admin', [AdminController::class, 'impersonate_role'])->name('admin.auth.impersonate_role');

//     Route::prefix('dashboard')->group(function () {
//         Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');
//     });


//     Route::prefix('product')->group(function () {
//         Route::get('/', [ProductController::class, 'index'])->name('admin.product.list');
//         Route::get('/add', [ProductController::class, 'create'])->name('admin.product.addForm');
//         Route::post('/add-save', [ProductController::class, 'store'])->name('admin.product.addSave');
//         // Route::get('/delete/{id_product}', [ProductController::class, 'destroy'])->name('admin.product.delete');
//         Route::get('/delete', [ProductController::class, 'destroy'])->name('admin.product.delete');
//         Route::get('/edit-form/{id_product}', [ProductController::class, 'edit'])->name('admin.product.editForm');
//         Route::post('/edit-save/{id_product}', [ProductController::class, 'update'])->name('admin.product.editSave');

//         // ajax
//         Route::get('/update-status', [ProductController::class, 'updateStatusAjax'])->name('admin.product.updateStatusAjax');
//         Route::POST('/add-product-attributes', [ProductController::class, 'add_productAttributes'])->name('admin.product.add_productAttributes');
//         Route::post('/product-attributes', [ProductController::class, 'productAttributes'])->name('admin.product.productAttributes');
//         Route::get('/edit-product-attributes', [ProductController::class, 'edit_productAttributes'])->name('admin.product.edit_productAttributes');
//     });

//     Route::prefix('gallery')->group(function () {
//         Route::post('/delete-gallery', [GalleryController::class, 'destroy'])->name('admin.gallery.delete');
//     });

//     Route::prefix('banner')->group(function () {
//         Route::get('/', [BannerController::class, 'index'])->name('admin.banner.list');
//         Route::get('/add', [BannerController::class, 'create'])->name('admin.banner.addForm');
//         Route::post('/add-save', [BannerController::class, 'store'])->name('admin.banner.addSave');
//         Route::get('/edit-form/{id_banner}', [BannerController::class, 'edit'])->name('admin.banner.editForm');
//         Route::post('/edit-save/{id_banner}', [BannerController::class, 'update'])->name('admin.banner.editSave');
//         Route::get('/delete/{id_banner}', [BannerController::class, 'destroy'])->name('admin.banner.delete');
//     });


//     Route::prefix('product_attribute')->group(function () {
//         Route::get('/', [AttributeController::class, 'index'])->name('admin.attribute.list');
//         Route::get('/add', [AttributeController::class, 'create'])->name('admin.attribute.addForm');
//         Route::post('/add-save', [AttributeController::class, 'store'])->name('admin.attribute.addSave');
//         Route::get('/edit-form', [AttributeController::class, 'edit'])->name('admin.attribute.editForm');
//         Route::post('/edit-save', [AttributeController::class, 'update'])->name('admin.attribute.editSave');
//         Route::get(
//             '/delete',
//             [AttributeController::class, 'destroy']
//         )->name('admin.attribute.delete');
//     });
//     Route::prefix('attribute_value')->group(function () {
//         Route::get('/', [AttributeValueController::class, 'index'])->name('admin.attribute_value.list');
//         Route::get('/add', [AttributeValueController::class, 'create'])->name('admin.attribute_value.addForm');
//         Route::post('/add-save', [AttributeValueController::class, 'store'])->name('admin.attribute_value.addSave');
//         Route::get('/edit-form', [AttributeValueController::class, 'edit'])->name('admin.attribute_value.editForm');
//         Route::post('/edit-save', [AttributeValueController::class, 'update'])->name('admin.attribute_value.editSave');
//         Route::get('/delete', [AttributeValueController::class, 'destroy'])->name('admin.attribute_value.delete');
//     });
//     Route::prefix('order/bill')->group(function () {
//         Route::get('list', [OrderBillController::class, 'index'])
//             ->name('admin.order_bill.list');
//         Route::get('view-detail', [
//             OrderBillController::class, 'view_detail_bill'
//         ])
//             ->name('admin.order_bill.view_detail_bill');
//         Route::post('update-status-bill', [OrderBillController::class, 'update_status_bill'])
//             ->name('admin.order_bill.update_status_bill');
//         Route::get('delete-bill', [OrderBillController::class, 'destroy'])
//             ->name('admin.order_bill.destroy');
//     });


//     Route::prefix('manager')->name('admin.admin.')->group(function () {
//         Route::get(
//             'add/',
//             [AdminController::class, 'formAdd']
//         )->name('formAdd');
//         Route::get('list/', [AdminController::class, 'list_admin'])->name('list');
//         Route::post('/add-save', [AdminController::class, 'store'])->name('addSave');
//         Route::get('decentralize/{id_admin}', [AdminController::class, 'decentralize'])->name('decentralize');
//         Route::post('get-permission', [AdminController::class, 'get_permission'])->name('get_permission');
//         Route::post('get-role', [AdminController::class, 'get_role'])->name('get_role');
//         // impersonate
//     });
//     Route::prefix('roles')->group(function () {
//         Route::get('index', [DecentralizeController::class, 'index'])->name('admin.roles.index');
//         Route::post('admin-permission-add', [DecentralizeController::class, 'adminPermissionAdd'])->name('admin.permission.add');
//         Route::post('admin-role-add', [DecentralizeController::class, 'adminRoleAdd'])->name('admin.role.add');
//     });
//     Route::prefix('user')->group(function () {
//         Route::get('', [UserController::class, 'index'])->name('admin.user.list');
//     });
// });