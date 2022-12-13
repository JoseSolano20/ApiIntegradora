<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OfficesController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->group(function(){
    Route::get('index', [ProductsController::class, 'index']);
    Route::post('store', [ProductsController::class, 'store']);
    Route::put('update/{id}', [ProductsController::class, 'update']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
    Route::delete('destroy/{id}',[ProductsController::class, 'destroy']);
});

Route::prefix('users')->group(function(){
    Route::get('index', [UsersController::class, 'index']);
});

Route::prefix('orders')->group(function(){
    Route::get('index', [OrdersController::class, 'index']);
    Route::post('store', [OrdersController::class, 'store']);
    Route::post('storeIn/{idP}/{idS}', [OrdersController::class, 'storeIn']);
    Route::put('update/{id}', [OrdersController::class, 'update']);
    Route::get('show/{id}', [OrdersController::class, 'show']);
    Route::delete('destroy/{id}',[OrdersController::class, 'destroy']);
});

Route::prefix('offices')->group(function(){
    Route::get('index', [OfficesController::class, 'index']);
    Route::post('store', [OfficesController::class, 'store']);
    Route::put('update/{id}', [OfficesController::class, 'update']);
    Route::get('show/{id}', [OfficesController::class, 'show']);
    Route::delete('destroy/{id}', [OfficesController::class, 'destroy']);
});


