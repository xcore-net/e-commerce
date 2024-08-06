<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'price',
        'amount',
        'cateogory',
        'img',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id');
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('amount', 'price');
    }
    // public function stores(): BelongsToMany
    // {
    //     return $this->belongsToMany(Order::class, 'store_products')
    //         ->withPivot('quantity','limit','status', 'price');
    // }
}
