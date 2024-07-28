<?php

use App\Http\Controllers\Api\ApiUserDetailsController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;

    Route::get('/details/index/{user_id}',[ApiUserDetailsController::class, 'index']);
    Route::post('/details/create/{user_id}',[ApiUserDetailsController::class, 'store']);
    Route::post('/details/update/{user_id}',[ApiUserDetailsController::class, 'update']);
    Route::delete('/details/delete/{user_id}', [ApiUserDetailsController::class, 'destroy']);

    Route::get('/product/index',[ApiProductController::class, 'index']);
    Route::post('/product/create',[ApiProductController::class, 'store']);
    Route::post('/product/update/{product_id}',[ApiProductController::class, 'update']);
    Route::delete('/product/delete/{product_id}', [ApiProductController::class, 'destroy']);
    Route::get('/product/show/{product_id}',[ApiProductController::class, 'show']);