<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table='payments';

    protected $fillable = [
        'method',
        'user_id',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
