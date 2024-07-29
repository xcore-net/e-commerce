<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Route;

// Store routes
Route::get('/', [StoreController::class, 'index'])->name('store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //User_details
    Route::get('/user_details', [UserDetailsController::class, 'index'])->name('userDetails.index');
    Route::get('/user_details/create', [UserDetailsController::class, 'create'])->name('userDetails.create');
    Route::post('/user_details/store', [UserDetailsController::class, 'store'])->name('userDetails.store');
    Route::get('/user_details/{id}', [UserDetailsController::class, 'edit'])->name('userDetails.edit');
    Route::put('/user_details/{id}', [UserDetailsController::class, 'update'])->name('userDetails.update');
    Route::delete('/user_details/{id}', [UserDetailsController::class, 'destroy'])->name('userDetails.destroy');

    //Product
    Route::middleware('permission:view-product')->group(function () {
        Route::get('/product', [ProductController::class, 'index'])->name('product.index');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show'); //Doesn't exist btw
    });

    Route::middleware('permission:create-product')->group(function () {
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    });

    Route::middleware('permission:update-product')->group(function () {
        Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    });

    Route::middleware('permission:delete-product')->group(function () {
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order/{id}/pay', [OrderController::class, 'pay'])->name('order.pay');

    Route::middleware('permission:view-order')->group(function () {
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    });

    Route::middleware('permission:view-all-order')->group(function () {
        Route::get('/orders', [OrderController::class, 'getAllOrders'])->name('order.all');
    });

    //payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
});

require __DIR__ . '/auth.php';
