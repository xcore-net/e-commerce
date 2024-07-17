<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\UserDetails;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = ['type','number'];
    public function user_datail():HasOne
    {
        return $this->hasOne(UserDetails::class);
    }
}
