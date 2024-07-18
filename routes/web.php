<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/user_details', [UserDetailsController::class, 'index'])->name('userDetails.index');
Route::get('/user_details/create', [UserDetailsController::class, 'create'])->name('userDetails.create');
Route::post('/user_details/store', [UserDetailsController::class, 'store'])->name('userDetails.store');
Route::get('/user_details/{id}', [UserDetailsController::class, 'edit'])->name('userDetails.edit');
Route::put('/user_details/{id}', [UserDetailsController::class, 'update'])->name('userDetails.update');
Route::delete('/user_details/{id}', [UserDetailsController::class, 'destroy'])->name('userDetails.destroy');


//Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart/{id}', [CartController::class, 'edit'])->name('cart.edit');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

require __DIR__.'/auth.php';
