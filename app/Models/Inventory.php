<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'productCode',
        'productName',
        'category',
        'color',
        'litre',
        'pail_quantity',
        'Additional_notes',
    ];

    public $timestamps = true; // Enable timestamps if needed
}
