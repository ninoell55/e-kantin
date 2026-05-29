<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\CostumerController;
use App\Http\Controllers\Admin\InvoiceController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // URL: /admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/costumer/index', [CostumerController::class, 'index'])->name('costumer.index');
    Route::get('/invoice/index', [InvoiceController::class, 'index'])->name('invoice.index');


    // kelola category
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    // Rute Kelola Penjual
    Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::patch('/vendor/{id}/activate', [VendorController::class, 'activate'])->name('vendor.activate');

    //costumer
    Route::get('/costumer/create', [CostumerController::class, 'create'])->name('costumer.create');
    Route::post('/costumer', [CostumerController::class, 'store'])->name('costumer.store');
    Route::get('/costumer/detail/{id}', [CostumerController::class, 'show'])->name('costumer.detail');
    Route::patch('/costumer/{id}/ban', [CostumerController::class, 'ban'])->name('costumer.ban');
    Route::patch('/costumer/{id}/activate', [CostumerController::class, 'activate'])->name('costumer.activate');


    //invoice
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.detail');
});
