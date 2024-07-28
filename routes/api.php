<?php

use App\Http\Controllers\Api\ApiCartController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiUserDetailsController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;

    //details
    Route::get('/details/index/{user_id}',[ApiUserDetailsController::class, 'index']);
    Route::post('/details/create/{user_id}',[ApiUserDetailsController::class, 'store']);
    Route::post('/details/update/{user_id}',[ApiUserDetailsController::class, 'update']);
    Route::delete('/details/delete/{user_id}', [ApiUserDetailsController::class, 'destroy']);

    //product
    Route::get('/product/index',[ApiProductController::class, 'index']);
    Route::post('/product/create',[ApiProductController::class, 'store']);
    Route::post('/product/update/{product_id}',[ApiProductController::class, 'update']);
    Route::delete('/product/delete/{product_id}', [ApiProductController::class, 'destroy']);
    Route::get('/product/show/{product_id}',[ApiProductController::class, 'show']);

    //Cart
    Route::get('/cart/index/{user_id}',[ApiCartController::class, 'index']);
    Route::delete('/cart/delete/{cart_id}',[ApiCartController::class, 'destroy']);
    Route::post('/cart/add',[ApiCartController::class, 'add']);

    //order
    Route::get('/order/index',[ApiOrderController::class, 'index']);
    Route::get('/order/add/{user_id}',[ApiOrderController::class, 'add']);

