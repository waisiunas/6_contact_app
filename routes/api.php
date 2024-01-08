<?php

use App\Http\Controllers\api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('web')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CategoryController::class)->middleware('web')->name('api.')->group(function () {
    Route::get('categories', 'index')->name('categories');
    Route::prefix('category')->group(function () {
        Route::post('create', 'store')->name('category.create');
        Route::get('{id}/show', 'show')->name('category.show');
        Route::patch('{id}/edit', 'update')->name('category.edit');
        Route::delete('{id}/destroy', 'destroy')->name('category.destroy');
    });
});
