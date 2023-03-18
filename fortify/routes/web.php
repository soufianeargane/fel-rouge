<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LogoutController;
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
//user route
Route::get('user', [UserController::class, 'index'])->name('user')->middleware(['auth']);


// admin route with admin and auth middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
});



// owner route
// Route::get('owner', [OwnerController::class, 'index'])->name('owner')->middleware(['auth']);
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('owner', [OwnerController::class, 'index'])->name('owner');
});