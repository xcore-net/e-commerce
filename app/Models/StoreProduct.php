<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Cart;

class StoreProduct extends Model
{
    use HasFactory;

    protected $table='store_products';

    protected $fillable = [
      
        'quantity',
        'limit',
        'price',
        'status',
        'product_id',
        'store_id'
    ];
    public function carts():BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }


}
