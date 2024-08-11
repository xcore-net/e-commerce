<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\lowOfStock;
class Event1Controller extends Controller
{
    public function sendMessage(Request $request)
{
    $message = $request->input('message');
    event(new lowOfStock($message));
    return response()->json(['status' => 'Message sent!']);
}
}
