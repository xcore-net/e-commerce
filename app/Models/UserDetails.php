<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Billing;
use App\Models\User;


class UserDetails extends Model
{
    use HasFactory;
    protected $fillable = ['phone','billing_id','adress','user_id'];
    public function billing():BelongsTo
    {    
        return $this->belongsTo(Billing::class);
    }

    public function user():BelongsTo
    {    
        return $this->belongsTo(User::class);
    }
}
