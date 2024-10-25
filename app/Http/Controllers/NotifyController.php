<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ProductManagerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function notify()
    {
        $user = Auth::user();
        $user->notify(new ProductManagerNotification(' low of stock.'));
    }
}
