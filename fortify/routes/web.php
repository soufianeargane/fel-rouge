<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LogoutController;
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
});



// user route
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('user', [UserController::class, 'index'])->name('user');
    // resources route on store
    Route::resource('store', App\Http\Controllers\StoreController::class);
});
