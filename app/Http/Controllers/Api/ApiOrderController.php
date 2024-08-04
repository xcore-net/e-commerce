<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiPaymentController;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getOrders(): JsonResponse
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function getOrder($id): JsonResponse
    {
        $orders = Order::where('user_id', $id)->first();
        return response()->json($orders);
    }

    public function pay($id, Request $request): JsonResponse
    {
        $paymentController = new ApiPaymentController;
        $order = Order::find($id);
        $payment = $paymentController->pay($order, $request);
        $order->payment_id = $payment->id;
        $order->save();
        
        return $payment ? response()->json('payment made', 201) : response()->json($payment, 400);
    }
}
