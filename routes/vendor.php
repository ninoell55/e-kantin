<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\DashboardController;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
