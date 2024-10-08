<?php

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
        Route::get('/buys', [AdminController::class, 'buys'])->name('admin.buys');
        Route::get('/supplies', [AdminController::class, 'supplies'])->name('admin.supplies');
        Route::get('/supplie/{id}', [AdminController::class, 'supplie'])->name('admin.supplie');
        Route::get('/dologout', [AdminController::class, 'doLogout']);
    });
    Route::get('/', [AdminController::class, 'login'])->name('login');
    Route::post('/dologin', [AdminController::class, 'doLogin']);
});
