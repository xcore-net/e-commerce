
<?php
use App\Http\Controllers\api\ApiProductController;
use App\Http\Controllers\api\ApiCartController;
use App\Http\Controllers\api\ApiOrderController;
use App\Http\Controllers\api\ApiUserDetailController;
use  \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;



Route::middleware([EnsureFrontendRequestsAreStateful::class])->group(function () {
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class,'logout']);

    Route::middleware('auth:sanctum')->group(function () {
//userdetail
Route::get('/userdetails/index', [ApiUserDetailController::class,'index']);
 Route::post('/userdetails/update', [ApiUserDetailController::class, 'update']);
 Route::post('/userdetails/store', [ApiUserDetailController::class, 'store']);
Route::delete('/userdetails/delete', [ApiUserDetailController::class, 'destroy']);

 

//product//

Route::get('/index_product', [ApiProductController::class, 'index']);
 Route::post('/update_product/{product_id}', [ApiProductController::class, 'update']);
Route::post('/store_product', [ApiProductController::class, 'store']);
 Route::delete('/delete_product/{product_id}', [ApiProductController::class, 'destroy']);
 Route::get('/product/show/{product_id}', [ApiProductController::class,'show']);

 //cart
 Route::get('/cart/index', [ApiCartController::class, 'index']);
 Route::delete('/cart/delete/{cart_id}', [ApiCartController::class, 'destroy']);
 Route::post('/cart/add/{product_id}', [ApiCartController::class,'add']);

 //order

 Route::get('/order/index',[ApiOrderController::class, 'index']);
Route::get('/order/add',[ApiOrderController::class, 'add']);

});
});