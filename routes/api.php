<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SupplieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth.api')->group(function () {
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

Route::post('/auth', [AuthController::class, 'auth']);
