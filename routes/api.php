<?php

use App\Http\Controllers\api\ApiProductController;
use App\Http\Controllers\api\ApiUserController;
use App\Http\Controllers\api\ApiOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//User
Route::get('user/{id}/orders', [ApiUserController::class, 'getUserOrders']);

//Product
Route::get('/product', [ApiProductController::class, 'getProducts']);
Route::post('/product/store', [ApiProductController::class, 'createProduct']);
Route::get('/product/{id}', [ApiProductController::class, 'getProduct']);
Route::put('/product/{id}', [ApiProductController::class, 'updateProduct']);
Route::delete('/product/{id}', [ApiProductController::class, 'deleteProduct']);

//Order
Route::get('/order', [ApiOrderController::class, 'getOrders']);
Route::post('/order/store', [ApiOrderController::class, 'createOrder']);
Route::get('/order/{id}', [ApiOrderController::class, 'getOrder']);
Route::put('/order/{id}', [ApiOrderController::class, 'updateOrder']);
Route::delete('/order/{id}', [ApiOrderController::class, 'deleteOrder']);

//Order
Route::get('/order', [ApiOrderController::class, 'getOrders']);
Route::post('/order/store', [ApiOrderController::class, 'createOrder']);
Route::get('/order/{id}', [ApiOrderController::class, 'getOrder']);
Route::put('/order/{id}', [ApiOrderController::class, 'updateOrder']);
Route::delete('/order/{id}', [ApiOrderController::class, 'deleteOrder']);

Route::get('/user', function (Request $request) {
    return $request->user();
});