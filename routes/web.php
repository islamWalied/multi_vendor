<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [\App\Http\Controllers\Front\HomeController::class,'index'])->name('home');
Route::get('/', [\App\Http\Controllers\Front\HomeController::class,'index'])->name('home');


Route::get('/products', [\App\Http\Controllers\Front\ProductController::class,'index'])
    ->name('product.index');

Route::get('/products/{product:slug}', [\App\Http\Controllers\Front\ProductController::class,'show'])
    ->name('product.show');

Route::resource('cart',\App\Http\Controllers\Front\CartController::class);
Route::get('checkout',[\App\Http\Controllers\Front\OrderController::class,'create'])->name('checkout');
Route::post('checkout',[\App\Http\Controllers\Front\OrderController::class,'store']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/admin/admin.php';
require __DIR__.'/auth.php';

