<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ReportController;
use App\Http\Controllers\Vendor\ShopBillController;
use App\Http\Controllers\Vendor\ShopController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    // Route Dashboard Utama Penjual
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Manajemen Lapak (Shop)
    Route::get('/shop/settings', [ShopController::class, 'index'])->name('shop.index');
    Route::put('/shop/settings', [ShopController::class, 'update'])->name('shop.update');
    Route::patch('/shop/toggle-status', [ShopController::class, 'toggleStatus'])->name('shop.toggle-status');

    Route::get('/bills', [ShopBillController::class, 'index'])->name('bills.index');
    Route::post('/bills/{id}/pay', [ShopBillController::class, 'pay'])->name('bills.pay');

    // CRUD Management Produk Kantin
    Route::get('/products', [ProductController::class, 'index'])->name('product.index'); // Halaman Semua Produk
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show'); // Detail Produk Mini
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy'); // Hapus Produk
    Route::patch('/products/{product}/toggle', [DashboardController::class, 'toggleStatus'])->name('product.toggle-status');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::put('/orders/{order}/verify-payment', [OrderController::class, 'verifyPayment'])->name('order.verifyPayment');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/export-pdf', [ReportController::class, 'exportPdf'])->name('report.exportPdf');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
