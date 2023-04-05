<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserAuthController;
use Illuminate\Http\Request;
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

Route::post('login', [UserAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Auth
    Route::get('logout', [UserAuthController::class, 'logout']);
    Route::post('change-password', [UserAuthController::class, 'changePassword']);
    Route::get('profile', [UserAuthController::class, 'profile']);
    Route::get('get-category-list', [ProductController::class, 'getCategoryList']);
    Route::get('get-product-list', [ProductController::class, 'getProductList']);

});
