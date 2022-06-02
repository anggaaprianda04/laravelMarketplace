<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DataApiController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\StoreApiController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\UserController;
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

// USER
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('users', [UserController::class, 'users']);
Route::put('update/{id}',[UserController::class, 'update']);
// Route::get('user/{id}', [UserController::class, 'user']);
// Route::delete('delete/{id}', [UserController::class, 'delete']);

// MARKET
Route::get('markets',[StoreApiController::class, 'markets']);
Route::get('market/{id}', [StoreApiController::class, 'fetch']);
Route::post('createMarket', [StoreApiController::class, 'createMarket']);
Route::post('uploadPhotoMarket/{id}',[StoreApiController::class,'uploadPhotoMarket']);
Route::put('updateMarket/{id}', [StoreApiController::class, 'updateMarket']);
Route::get('limitsMarket',[StoreApiController::class,'limitsMarket']);

// PRODUCT
Route::get('products', [ProductController::class, 'products']);
Route::get('limits',[ProductController::class,'limits']);
Route::get('product/{id}', [ProductController::class,'product']);
Route::get('search/{name}',[ProductController::class,'search']);

// CATEGORY
Route::get('categories', [CategoryController::class, 'categories']);
Route::get('category/{id}', [CategoryController::class,'category']);

// DATA
Route::get('districts', [DataApiController::class, 'districtsBaktiya']);


Route::middleware('auth:sanctum')->group(function() {
    Route::get('user',[UserController::class, 'fetch']);
    Route::post('logout', [UserController::class, 'logout']);

});
