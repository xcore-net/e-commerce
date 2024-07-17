<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Product extends Model
{
    use HasFactory;
    protected $table='products';

    protected $fillable = [
        'title',
        'desc',
        'price',
        'img',
        'amount',
        'category'
        
    ];

    public function user()
    {
        return $this->belongsToMany(User::class,'carts');
    }
    public function order()
    {
        return $this->belongsToMany(Order::class,'order_products');
    }

}
