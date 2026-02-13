<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\IncomingPlanController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
    Route::middleware(['general'])->group(function () {
        Route::get('/general', [DashboardController::class, 'index'])->name('general.dashboard');
    });

    // 在庫管理（共通）
    Route::resource('stocks', StockController::class);

    // 入荷予定（共通）
    Route::resource('incoming', IncomingPlanController::class);

    // 管理者専用
    Route::middleware(['admin'])->group(function () {

        Route::resource('products', ProductController::class);

        Route::resource('staffs', UserController::class);

        Route::get('/incoming', [IncomingPlanController::class, 'index'])
            ->name('Incoming.index');
    });
});