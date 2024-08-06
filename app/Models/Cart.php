<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'product_id',
    ];

    public function product(): BelongsTO
    {
        return $this->belongsTo(Product::class);
    }
}
