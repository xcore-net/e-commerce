<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'carts','product_id','user_id');
    }
    protected $fillable = [
        'title',
        'desc',
        'price',
        'amount',
        'cateogory',
        'img',
    ];
}
