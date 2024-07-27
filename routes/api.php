<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\ApiCartController;
use App\Http\Controllers\api\ApiProductController;
use App\Http\Controllers\api\ApiUserController;
use App\Http\Controllers\api\ApiOrderController;
use App\Http\Controllers\api\ApiPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('user/orders', [ApiUserController::class, 'getUserOrders']);
    Route::get('user/{id}/orders', [ApiUserController::class, 'getOrderByUSer']);

    //Product
    Route::get('/product', [ApiProductController::class, 'getProducts']);
    Route::post('/product/store', [ApiProductController::class, 'createProduct']);
    Route::get('/product/{id}', [ApiProductController::class, 'getProduct']);
    Route::put('/product/{id}', [ApiProductController::class, 'updateProduct']);
    Route::delete('/product/{id}', [ApiProductController::class, 'deleteProduct']);

    //Order
    Route::get('/orders', [ApiOrderController::class, 'getOrders']);
    Route::get('/order/{id}', [ApiOrderController::class, 'getOrder']);
    Route::post('/order/store', [ApiOrderController::class, 'createOrder']);
    Route::delete('/order/{id}', [ApiOrderController::class, 'deleteOrder']);
    Route::post('/order/{id}/pay', [ApiOrderController::class, 'pay']);

    // Cart
    Route::get('/cart', [ApiCartController::class, 'getCart']);
    Route::post('/cart/add', [ApiCartController::class, 'addProductToCart']);
    Route::post('/cart/checkout', [ApiCartController::class, 'checkout']);
    Route::put('/cart/{id}', [ApiCartController::class, 'updateCartProduct']);
    Route::delete('/cart/clear', [ApiCartController::class, 'clearCart']);
    Route::delete('/cart/{id}', [ApiCartController::class, 'removeProductFromCart']);

});
