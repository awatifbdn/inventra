<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
      protected $fillable = [
        'productName',
        'category',
        'description',
        'sizes',
        'min_price',
        'max_price',
        'image_url', // Store array of image URLs...
      ];

}
