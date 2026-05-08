<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // URL: /admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // URL: /admin/kategori/tambah
    
    // Perhatikan: Jangan tulis 'admin' lagi jika sudah ada di prefix group
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    // URL: /admin/kategori (untuk proses simpan)
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    //index
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
});
