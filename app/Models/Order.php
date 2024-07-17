<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;
protected $table='orders';
    protected $fillable = [
        'total',
        'user_id',
        
    ];
    public function product()
    {
        return $this->belongsToMany(Product::class,'order_products');
    }
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
