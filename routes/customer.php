<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Menu
        Route::view('/menu', 'customer.menu')
            ->name('menu');

        // Cart
        Route::view('/cart', 'customer.cart')
            ->name('cart');

        // Checkout
        Route::view('/checkout', 'customer.checkout')
            ->name('checkout');

        // Tracking
        Route::view('/tracking', 'customer.tracking')
            ->name('tracking');

    });