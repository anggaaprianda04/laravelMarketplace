<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('dashboard');
});


// DASHBOARD
Route::prefix('dashboard')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('/', [DashboradController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('stores', StoreController::class);
        Route::resource('market', MarketController::class);
        Route::resource('products', ProductController::class);
        Route::resource('order', TransactionController::class);
    });
