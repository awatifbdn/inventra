<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_name',
        'color_code',
        'color_pallet',
        'price',
        'litre',
        'category_id',
    ];
    protected $primaryKey = 'color_id'; // Specify the primary key if it's not 'id'
    protected $table = 'colors'; // Specify the table name if it's not the plural of the model name
    public $timestamps = true; // Enable timestamps if your table has 'created_at' and 'updated_at' columns
}