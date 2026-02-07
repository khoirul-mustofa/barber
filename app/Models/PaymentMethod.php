<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'account_number',
        'account_name',
        'icon',
        'image',
        'is_active',
    ];

    protected $casts = [
        'code' => \App\Enums\PaymentMethods::class,
        'is_active' => 'boolean',
    ];
}
