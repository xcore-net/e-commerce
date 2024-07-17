<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDetails extends Model
{
    use HasFactory;

    public function billing(): HasOne
    {
        return $this->hasOne(Billing::class);
    }
}
