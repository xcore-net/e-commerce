<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    use HasFactory;

    public function billing(): BelongsTo
    {
        return $this->belongsTo(Billing::class);
    }

    protected $fillable = [
        'phone',
        'address',
        'user_id',
        'billing_id',
    ];
}
