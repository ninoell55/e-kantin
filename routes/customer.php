<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ShopController;

Route::middleware(['auth', 'role:customer'])
->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])
->prefix('customer2')
->name('customer2.')
->group(function(){

//halaman checkout
Route::get('/checkout',[CheckoutController::class, 'index'])
->name('checkout.index');

//simpan checkout
Route::post('/checkout',[CheckoutController::class,'store'])
->name('checkout.store');

    //halaman cart
    Route::get('/cart',[CartController::class,'index'])
    ->name('cart.index');

    //menampilkan halaman produk
    Route::get('/products',[ProductController::class,'index'])
    ->name('products.index');

    //tambah produk ke cart
    Route::post('/cart/add/{product}', [CartController::class,'add'])
    ->name('cart.add');

    //update quantity cart
    Route::patch('/cart/update/{product}', [CartController::class, 'update'])
    ->name('cart.update');

    //hapus item dari cart
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');

    //kosongkan cart
    Route::delete('/cart/clear', [CartController::class,'clear'])
    ->name('cart.clear');

    //kurangi quantity
    Route::post('/cart/decrease/{product}',[CartController::class,'decrease'])
    ->name('cart.decrease');
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

Route::view('/checkout', 'layouts.navigation.customer.checkout')
    ->name('checkout');

Route::view('/tracking', 'layouts.navigation.customer.tracking')
    ->name('tracking');

    });