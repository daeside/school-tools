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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'login']);

Route::controller(SupplieController::class)->group(function () {
    Route::get('/supplies', 'getAll');
    Route::get('/supplie/{id}', 'get');
    Route::post('/supplie', 'create');
    Route::put('/supplie/{id}', 'update');
    Route::delete('/supplie/{id}', 'delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'getAll');
    Route::get('/user/{id}', 'get');
    Route::post('/user', 'create');
    Route::put('/user/{id}', 'update');
    Route::delete('/user/{id}', 'delete');
});
