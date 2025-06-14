<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColorLitre;


class Color extends Model
{
    use HasFactory;

   protected $fillable = [
    "color_name",
    "color_code", // e.g., HEX: #FFFFFF
    "color_pallet", // Optional: e.g., it's an image to display the color
    "product_id" // Foreign Key to products table
    ];


    public function product()
        {
            return $this->belongsTo(Product::class);
        }
   public function litres()
    {
        return $this->hasMany(ColorLitre::class, 'color_id');
    }

}
