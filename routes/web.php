<?php

use App\Http\Controllers\SupplieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/supplies', [AdminController::class, 'supplies'])->name('admin.index');
        Route::get('/dologout', [AdminController::class, 'doLogout']);
    });
    Route::get('/', [AdminController::class, 'login'])->name('custom.login');
    Route::post('/dologin', [AdminController::class, 'doLogin']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('supplie')->group(function () {
        Route::get('/', [SupplieController::class, 'getAll']);
        Route::get('/{id}', [SupplieController::class, 'get']);
        Route::post('/', [SupplieController::class, 'create']);
        Route::put('/{id}', [SupplieController::class, 'update']);
        Route::delete('/{id}', [SupplieController::class, 'delete']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'getAll']);
        Route::get('/{id}', [UserController::class, 'get']);
        Route::post('/', [UserController::class, 'create']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'delete']);
    });
});
