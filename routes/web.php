<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [NotificationsController::class, 'notify']);
// Store routes
Route::get('/', [StoreController::class, 'index'])->name('store.index');
Route::get('/stores', [StoreController::class, 'getStores'])->name('store.stores');
Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/store/{id}', [StoreController::class, 'show'])->name('store.show');
Route::post('/store/{id}/addProduct', [StoreController::class, 'addProduct'])->name('store.addProduct');
Route::put('/store/{id}/product/{id}/stock', [StoreController::class, 'show'])->name('store.show');

Route::post('/cart/add', [StoreController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/checkout', [StoreController::class, 'checkout'])->name('cart.checkout');


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
    Route::middleware('role:productManager|User')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show'); //Doesn't exist btw
    });

    Route::middleware('role:productManager')->group(function () {
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    // Route::middleware('role:productManager')->group(function () {
    //     Route::get('/product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    //     Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    // });

    // Route::middleware('permission:productManager')->group(function () {
    //     Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    // });

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    // Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
  
    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/user/order/{id}', [OrderController::class, 'showUserOrder'])->name('order.showUserOrder');
    Route::post('/user/order/{id}/pay', [OrderController::class, 'pay'])->name('order.pay');

    Route::middleware('role:orderManager')->group(function () {
        Route::get('/orders', [OrderController::class, 'getAllOrders'])->name('orders.index');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    });

    Route::middleware('Role:orderManager')->group(function () {
        Route::get('/orders', [OrderController::class, 'getAllOrders'])->name('order.all');
    });

    //payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
});

require __DIR__ . '/auth.php';
