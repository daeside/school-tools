<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SupplieController;
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
    Route::get('/supplie', 'getAll');
    Route::get('/supplie/{id}', 'get');
    Route::post('/supplie', 'create');
    Route::put('/supplie/{id}', 'update');
    Route::delete('/supplie/{id}', 'delete');
});
