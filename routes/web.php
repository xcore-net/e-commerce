<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController; // Add this line

use App\Http\Controllers\StoreProductController;
use App\Http\Controllers\UserDetailController;

use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $products=Product::all();
    return view('welcome',['products'=>$products]);
});



Route::get('/notify', [NotifyController::class, 'notify']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::middleware('role:admin|productManager')->group(function () {
        
        Route::get('/store', [StoreController::class, 'index'])->name('store.index');


        //product
        Route::get('/index_product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create_product', [ProductController::class, 'create'])->name('product.create');
    Route::get('/edit_product/{product_id}', [ProductController::class, 'edit'])->name('product.edit');

    Route::post('/update_product/{product_id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/store_product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/delete_product/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/show/{product_id}', [ProductController::class,'show'])->name('product.show');
    });
        
    


    Route::middleware('role:admin')->group(function () {
        
    //user details//
    Route::get('/userdetails/index', [UserDetailController::class,'index'])->name('userDetails.index');
    Route::get('/userdetails/create', [UserDetailController::class, 'create'])->name('userDetails.create');
    Route::get('/userdetails/edit', [UserDetailController::class, 'edit'])->name('userDetails.edit');

    Route::put('/userdetails/update', [UserDetailController::class, 'update'])->name('userDetails.update');
    Route::post('/userdetails/store', [UserDetailController::class, 'store'])->name('userDetails.store');
    Route::delete('/userdetails/delete', [UserDetailController::class, 'destroy'])->name('userDetails.destroy');

//storeproduct
Route::get('/storeproduct/index', [StoreProductController::class,'index'])->name('storeproduct.index');
Route::get('/storeproduct/create', [StoreProductController::class,'create'])->name('storeproduct.create');
Route::post('/storeproduct/store', [StoreProductController::class,'store'])->name('storeproduct.store');
Route::delete('/storeproduct/delete/{product_id}', [StoreProductController::class,'destroy'])->name('storeproduct.destroy');
Route::post('/storeproduct/update/{product_id}', [StoreProductController::class,'update'])->name('storeproduct.update');
Route::get('/storeproduct/edit/{product_id}', [StoreProductController::class,'edit'])->name('storeproduct.edit');
Route::get('/storeproduct/show/{product_id}', [ProductController::class,'show'])->name('storeproduct.show');

    
    //   cart

    Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/delete/{cart_id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/add/{product_id}', [CartController::class,'add'])->name('cart.add');

   
   
});

Route::middleware('role:admin|orderManager')->group(function () {
    //order
    Route::get('/order/index',[OrderController::class, 'index'])->name('order.index');
    Route::post('/order/add',[OrderController::class, 'add'])->name('order.add');
        });
    


});
require __DIR__.'/auth.php';
