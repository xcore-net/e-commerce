<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    
    public function getOrders():JsonResponse
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function getOrder($id):JsonResponse
    {
        $orders = Order::where('user_id',$id)->get();
        return response()->json($orders);
    }
}