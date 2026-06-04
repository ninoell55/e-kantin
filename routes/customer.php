<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\TrackingController;
use App\Http\Controllers\Customer\ShopController;

Route::middleware(['auth', 'role:customer'])
->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


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
    Route::get('/menu', [ShopController::class, 'index'])
    ->name('menu');

 Route::view('/cart', 'layouts.navigation.customer.cart')
    ->name('cart');

/*Route::view('/checkout', 'layouts.navigation.customer.checkout')
    ->name('checkout');
*/
    Route::get(
    '/checkout',
    [CheckoutController::class, 'index']
)->name('checkout');

Route::view('/tracking', 'layouts.navigation.customer.tracking')
    ->name('tracking');

    Route::get('/tracking/{order}',
    [TrackingController::class,'show'])
    ->name('tracking.show');

/* Route::get('/tracking',
    [TrackingController::class,'index'])
    ->name('tracking');
    */
Route::get(
    '/tracking',
    [TrackingController::class, 'index']
)->middleware('auth');

    //cart ATHALLAH
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update']);
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post(
    '/checkout',
    [CheckoutController::class, 'store']
)->middleware('auth')
->name('checkout.store');

Route::delete(
    '/customer/orders/{order}/cancel',
    [TrackingController::class, 'cancel']
)->middleware('auth')
->name('orders.cancel');
    });

    