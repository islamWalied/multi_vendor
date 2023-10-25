<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use \Illuminate\Support\Facades\Route;

Route::get("/dashboard", [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('dashboard/categories',CategoryController::class);
    Route::resource('dashboard/products',CategoryController::class);
});
