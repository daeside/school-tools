<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SupplieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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
