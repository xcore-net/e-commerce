<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailsController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    $products = Product::all();
    return view('welcome',['products'=>$products]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    $products = Product::all();
    return view('welcome',['products'=>$products]);
})->name('welcome');

Route::middleware('auth')->group(function () {
    
    

    // user details &billing
    Route::get('/details/index',[UserDetailsController::class, 'index'])->name('details.index');
    Route::get('/details/create',[UserDetailsController::class, 'create'])->name('details.create');
    Route::get('/details/edit',[UserDetailsController::class, 'edit'])->name('details.edit');
    Route::post('/details/create',[UserDetailsController::class, 'store'])->name('details.store');
    Route::post('/details/update',[UserDetailsController::class, 'update'])->name('details.update');
    Route::delete('/details/delete/{user_details}/{billing}', [UserDetailsController::class, 'destroy'])->name('details.destroy');

    //product
    Route::get('/product/index',[ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{product_id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/create',[ProductController::class, 'store'])->name('product.store');
    Route::post('/product/update/{product_id}',[ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/show/{product_id}',[ProductController::class, 'show'])->name('product.show');
    

    //Cart
    Route::get('/cart/index',[CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/delete/{cart_id}', [cartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/add',[CartController::class, 'add'])->name('cart.add');

    //Order
    Route::post('/order/add',[OrderController::class, 'add'])->name('order.add');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
