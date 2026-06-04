<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::view('/menu', 'layouts.customer.menu')
            ->name('menu');

        Route::view('/cart', 'layouts.customer.cart')
            ->name('cart');

        Route::view('/checkout', 'layouts.customer.checkout')
            ->name('checkout');

        Route::view('/tracking', 'layouts.customer.tracking')
            ->name('tracking');
    });