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
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Product;
use App\Stock;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff/create', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{user}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{user}/edit', [StaffController::class, 'update'])->name('staff.update');
        Route::patch('staff/{user}/toggle', [StaffController::class, 'toggle'])->name('staff.toggle');

        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}/edit', [ProductController::class, 'update'])->name('products.update');
        Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])->name('products.toggle');
    });
    Route::middleware(['general'])->group(function () {
        Route::get('/general', [DashboardController::class, 'index'])->name('general.dashboard');
    });

    Route::get('/incoming-plans', [IncomingPlanController::class, 'index'])->name('incomings.index');
    Route::get('/incoming-plans/create', [IncomingPlanController::class, 'create'])->name('incomings.create');
    Route::post('/incoming-plans/create', [IncomingPlanController::class, 'store'])->name('incomings.store');
    Route::get('/incoming-plans/{incomingPlan}/edit', [IncomingPlanController::class, 'edit'])->name('incomings.edit');
    Route::put('/incoming-plans/{incomingPlan}/edit', [IncomingPlanController::class, 'update'])->name('incomings.update');
    Route::patch('/incoming-plans/{incomingPlan}/confirm', [IncomingPlanController::class, 'confirm'])->name('incomings.confirm');

    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::patch('/stocks/{stock}/edit', [StockController::class, 'update'])->name('stocks.update');

    Route::get('/products/{product}', [ProductController::class, 'showAjax'])->name('product.show');
});