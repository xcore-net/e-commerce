<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiPaymentController extends Controller
{
    public function index(): JsonResponse
    {
        $payments = Payment::all();
        return response()->json($payments, 200);
    }

    public function pay(Order $order, Request $request)
    {
        $request->validate([
        'method' => ['required', 'in:visa,paypal'],
        ]);

        $user = Auth::user();

       $payment = Payment::create([
            'user_id' => $user->id,
            'method' => $request->method,
            'amount' => $order->total_price,
        ]);
        return  $payment;
    }
}