<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Order;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','price','image','amount','category'];
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'carts');
    }
    
    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_products');
    }
}

