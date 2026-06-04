<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    // Halaman Utama Dashboard Customer
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/shop/{shop}', [ShopController::class, 'show'])->name('shop.show');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CartController::class, 'destroy'])->name('destroy');
    });

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
});
