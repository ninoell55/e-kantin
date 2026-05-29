<?php

use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ShopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    // Route Dashboard Utama Penjual
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Manajemen Lapak (Shop)
    Route::get('/shop', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop', [ShopController::class, 'update'])->name('shop.update');
    Route::patch('/shop/toggle-status', [ShopController::class, 'toggleStatus'])->name('shop.toggle-status');

    Route::prefix('product')->name('product.')->group(function () {

        Route::get('/', function () {
            return view('vendor.product.index');
        })->name('index');

        Route::get('/create', function () {
            return view('vendor.product.create');
        })->name('create');

        Route::get('/edit', function () {
            return view('vendor.product.edit');
        })->name('edit');

        Route::get('/product/detail', function () {
            return view('vendor.product.show');
        })->name('show');
    });

    Route::get('/order', function () {
        return view('vendor.order.index');
    })->name('order.index'); 

    Route::get('/report', function () {
        return view('vendor.report.index');
    })->name('report.index'); 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
