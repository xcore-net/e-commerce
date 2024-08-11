<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product;
use App\Models\StoreProduct;
class Store extends Model
{
    use HasFactory;
    protected $table='store';
    protected $fillable = [
      
        'name',
        'location',
        
    ];
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'store_products')->withPivot('quantity','limit','status','price');
    }


}
