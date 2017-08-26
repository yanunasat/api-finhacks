<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fire extends Model
{
    protected $table = 'transaction';

    protected $fillable = ['user_id', 'wallet_id', 'amount', 'type_pay', 'status', 'created_at', 'updated_at'];

    protected $hidden = [
        'id', 'status',
    ];
}
