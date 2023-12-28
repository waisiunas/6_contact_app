<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/', 'login_view')->name('login');
        Route::post('/', 'login');
        Route::get('register', 'register_view')->name('register');
        Route::post('register', 'register');
    });
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(ProfileController::class)->middleware(Authenticate::class)->group(function () {
    Route::get('profile/show', 'show')->name('profile.show');
    Route::patch('profile/details', 'details')->name('profile.details');
    Route::patch('profile/password', 'password')->name('profile.password');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(Authenticate::class);
