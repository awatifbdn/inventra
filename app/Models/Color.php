<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

   protected $fillable = [
    "color_name",
    "color_code", // e.g., HEX: #FFFFFF
    "color_pallet", // Optional: e.g., it's an image to display the color
    "price", // e.g., 99.99
    "litre", // e.g., 5.00 litres
    "product_id" // Foreign Key to products table
    ];
    protected $primaryKey = 'color_id'; // Specify the primary key if it's not 'id'
    protected $table = 'colors'; // Specify the table name if it's not the plural of the model name
    public $timestamps = true; // Enable timestamps if your table has 'created_at' and 'updated_at' columns

    public function product()
        {
            return $this->belongsTo(Product::class);
        }
   public function litres()
    {
        return $this->hasMany(ColorLitre::class, 'color_id');
    }


}
