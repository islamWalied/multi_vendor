<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use \Illuminate\Support\Facades\Route;


Route::middleware(['auth','auth.type:admin,super-admin'])->group(function () {
    Route::get("/dashboard", [DashboardController::class,'index'])->name('dashboard');
    // categories routes
    Route::get('dashboard/categories/trash',[CategoryController::class,'trash'])->name('categories.trash');
    Route::patch('dashboard/categories/{category}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('dashboard/categories/{category}/force-delete',[CategoryController::class,'forceDelete'])->name('categories.forceDelete');
    Route::resource('dashboard/categories',CategoryController::class);

    // products routes
    Route::resource('dashboard/products',ProductController::class);

    //profile routes
    Route::get('dashboard/profile',[ProfileController::class,'edit'])->name('dashboard.profile.edit');
    Route::patch('dashboard/profile/update',[ProfileController::class,'update'])->name('dashboard.profile.update');
});
