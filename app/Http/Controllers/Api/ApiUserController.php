<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function getOrdersByUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $orders = $user->orders()->with('products')->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json($orders, 200);
    } 
    public function getUserOrders()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $orders = $user->orders->with('products')->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json($orders, 200);
    }
}