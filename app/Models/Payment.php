<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_id',
        'domain',
        'status',
        'reference',
        'amount',
        'message',
        'gateway_response',
        'paid_at',
        'created_at',
        'channel',
        'currency',
        'ip_address',
        'fees',
        'prev_url'
    ];

    protected $table = 'payments';
}
