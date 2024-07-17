<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Relations\HasOne;
class Billing extends Model
{
    use HasFactory;
    protected $table='billings';
    protected $fillable = [
        'number',
        'type',
        
    ];
    public function userdetails()
    {
        return $this->hasOne(UserDetail::class);
    }
}
