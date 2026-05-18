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

Route::view('/menu', 'layouts.navigation.customer.menu')
    ->name('menu');

Route::view('/cart', 'layouts.navigation.customer.cart')
    ->name('cart');

Route::view('/checkout', 'layouts.navigation.customer.checkout')
    ->name('checkout');

Route::view('/tracking', 'layouts.navigation.customer.tracking')
    ->name('tracking');

    });