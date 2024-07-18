<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //user details//
    Route::get('/index', [UserDetailsController::class, 'index'])->name('userDetails.index');
    Route::get('/create', [UserDetailsController::class, 'create'])->name('userDetails.create');
    Route::get('/edit', [UserDetailsController::class, 'edit'])->name('userDetails.edit');

    Route::post('/update', [UserDetailsController::class, 'update'])->name('userDetails.update');
    Route::post('/store', [UserDetailsController::class, 'store'])->name('userDetails.store');
    Route::delete('/delete', [UserDetailsController::class, 'destroy'])->name('userDetails.destroy');



//product//

Route::get('/index_product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create_product', [ProductController::class, 'create'])->name('product.create');
    Route::get('/edit_product/{product_id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/update_product/{product_id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/store_product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/delete_product/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //   cart

    Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
