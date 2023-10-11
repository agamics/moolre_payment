<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_id',
        'mobile',
        'otp',
        'status',
    ];

    protected $table = 'otps';
}
