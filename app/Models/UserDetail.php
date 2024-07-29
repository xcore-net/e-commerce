<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billing;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserDetail extends Model
{
    use HasFactory;
    protected $table='userdetails';

    protected $fillable = [
      
        'phone',
        'address',
        'user_id',
        'billing_id'
    ];
    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
