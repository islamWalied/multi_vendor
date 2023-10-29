<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use \Illuminate\Support\Facades\Route;

Route::get("/dashboard", [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('dashboard/categories/trash',[CategoryController::class,'trash'])->name('categories.trash');
    Route::patch('dashboard/categories/{category}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('dashboard/categories/{category}/force-delete',[CategoryController::class,'forceDelete'])->name('categories.forceDelete');
    Route::resource('dashboard/categories',CategoryController::class);
    Route::resource('dashboard/products',CategoryController::class);
});
