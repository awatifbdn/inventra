<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'order_id',
    'customer_name',
    'customer_phone',
    'customer_email',
    'customer_address',
    'items',
    'total_price',
    'status', 
];

protected $casts = [
    'items' => 'array',
];

}
