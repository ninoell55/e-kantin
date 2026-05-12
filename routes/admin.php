<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SellerController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // URL: /admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/seller/index', [SellerController::class, 'index'])->name('seller.index');

    // kelola category
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    // Rute Kelola Penjual
    Route::get('/seller/create', [SellerController::class, 'create'])->name('seller.create');
    Route::post('/seller', [SellerController::class, 'store'])->name('seller.store');
    Route::get('/seller/{id}/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::put('/seller/{id}', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/{id}', [SellerController::class, 'destroy'])->name('seller.destroy');
    Route::patch('/seller/{id}/activate', [SellerController::class, 'activate'])->name('seller.activate');

    //





    //
});
