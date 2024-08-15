<?php

namespace App\Http\Controllers;

use App\Events\LowStock;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function notify()
    {
        $user = Auth::user();
        $user->notify(new AlertNotification('stock is low.'));
    }
}
