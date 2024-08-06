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

    Route::middleware('role:user')->group(function () {
        Route::get('user/orders', [ApiUserController::class, 'getUserOrders']);
        Route::get('user/{id}/orders', [ApiUserController::class, 'getOrdersByUser']);
    });

    //Product
    Route::middleware('role:productManager|user')->group(function () {
        Route::get('/product', [ApiProductController::class, 'getProducts']);
        Route::get('/product/{id}', [ApiProductController::class, 'getProduct']);
    });

    Route::middleware('role:productManager')->group(function () {
        Route::post('/product', [ApiProductController::class, 'createProduct']);
        Route::put('/product/{id}', [ApiProductController::class, 'updateProduct']);
        Route::delete('/product/{id}', [ApiProductController::class, 'deleteProduct']);
    });

    //Order
    Route::middleware('role:orderManager')->group(function () {
        Route::get('/orders', [ApiOrderController::class, 'getOrders']);
    });

    Route::middleware('role:user')->group(function(){
    Route::get('/order/{id}', [ApiOrderController::class, 'getOrder']);
    Route::post('/order/store', [ApiOrderController::class, 'createOrder']);
    Route::delete('/order/{id}', [ApiOrderController::class, 'deleteOrder']);
    Route::post('/order/{id}/pay', [ApiOrderController::class, 'pay']);
    });

    //Cart
    Route::middleware('role:user')->group(function () {
        Route::get('/cart', [ApiCartController::class, 'getCart']);
        Route::post('/cart/add', [ApiCartController::class, 'addProductToCart']);
        Route::post('/cart/checkout', [ApiCartController::class, 'checkout']);
        Route::put('/cart/{id}', [ApiCartController::class, 'updateCartProduct']);
        Route::delete('/cart/clear', [ApiCartController::class, 'clearCart']);
        Route::delete('/cart/{id}', [ApiCartController::class, 'removeProductFromCart']);
    });

    //Payments
    Route::middleware('role:user')->group(function () {
        Route::get('/user/payments', [ApiPaymentController::class, 'getUserPayments']);
    });

    Route::middleware('role:paymentManager')->group(function () {
        Route::get('/payments', [ApiPaymentController::class, 'getPayments']);
    });
});