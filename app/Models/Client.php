<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sur_name',
        'other_names',
        'mobile',
        'call_back_url',
        'webhook_url',
        'public_key',
        'test_key',
    ];

    protected $table = 'clients';
}
