<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RedirectController;

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

Route::get('/', function () {
    return view('landing');
});

// profile


// logout
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
// update profile
Route::get('profile/edit', function () {
    return view('profile.edit');
})->middleware(['auth']);
// update password
Route::get('profile/password', function () {
    return view('profile.password');
})->middleware(['auth']);

Route::get('redirect', [RedirectController::class, 'redirect'])->middleware(['auth']);



// admin route with admin and auth middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('demandes', [AdminController::class, 'demandes'])->name('demandes');
    Route::get('/demandes/{id}/action/{act}', [AdminController::class, 'action']);

    // categories route
    Route::get('admin/categories', [CategoryController::class, 'view'])->name('admin.categories');
    Route::post('admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('admin/categories/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    // Route::get('admin/categories/getAll', [CategoryController::class, 'getAll'])->name('admin.categories.getAll');
});



// owner route
// Route::get('owner', [OwnerController::class, 'index'])->name('owner')->middleware(['auth']);
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('owner', [OwnerController::class, 'index'])->name('owner');
    // products route
    Route::get('owner/products', [ProductController::class, 'index'])->name('owner.products');
    Route::post('owner/products/store', [ProductController::class, 'store'])->name('owner.products.store');
    Route::delete('owner/products/delete/{id}', [ProductController::class, 'delete'])->name('owner.products.delete');
    Route::get('owner/products/{id}', [ProductController::class, 'show'])->name('owner.products.show');
    Route::post('owner/products/update/', [ProductController::class, 'update'])->name('owner.products.update');

    // orders route
    Route::get('owner/orders', [OrderController::class, 'index'])->name('owner.orders');
    Route::post('owner/orders/action', [OrderController::class, 'action'])->name('owner.orders.action');
    Route::get('/owner/orders-details/{id}', [OrderController::class, 'show']);

    // to download pdf
    Route::get('/download-pdf', [OrderController::class, 'downloadPdf']);
});



// user route
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user');
    // resources route on store
    Route::resource('store', App\Http\Controllers\StoreController::class);
    Route::post('store/orders', [OrderController::class, 'store'])->name('order.store');
});
