<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
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

Route::middleware(Authenticate::class)->group(function () {
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('show', 'show')->name('show');
        Route::patch('details', 'details')->name('details');
        Route::patch('password', 'password')->name('password');
        Route::patch('picture', 'picture')->name('picture');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'index')->name('categories');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('contacts', 'index')->name('contacts');
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('create', 'create')->name('create');
            Route::post('create', 'store');
            Route::get('{contact}/show', 'show')->name('show');
            Route::get('{contact}/edit', 'edit')->name('edit');
            Route::delete('{contact}/destroy', 'destroy')->name('destroy');
        });
    });
});
