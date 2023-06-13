<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {    
    Route::post('/register', [AuthController::class, 'register']);  
    Route::post('/login', [AuthController::class, 'login']);
});


Route::group([
    'middleware' => 'api'    
], function ($router) {
    Route::post('/product', [ProductsController::class, 'store']);
    Route::get('/product/{id}', [ProductsController::class, 'show']);
    Route::put('/product/{id}', [ProductsController::class, 'update']);
    Route::delete('/product/{id}', [ProductsController::class, 'destroy']); 
});
