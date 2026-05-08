<?php

use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    // Route Dashboard Utama Penjual
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Manajemen Lapak (Shop)
    Route::get('/shop', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop', [ShopController::class, 'update'])->name('shop.update');
    Route::patch('/shop/toggle-status', [ShopController::class, 'toggleStatus'])->name('shop.toggle-status');

    Route::get('/product', function () {
        return view('vendor.product.index');
    })->name('product.index'); 

    Route::get('/order', function () {
        return view('vendor.order.index');
    })->name('order.index'); 

    Route::get('/report', function () {
        return view('vendor.report.index');
    })->name('report.index'); 
});
