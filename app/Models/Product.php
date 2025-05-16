<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
      protected $fillable = [
          'productName',
          'subheading',
          'category',
          'key_features',
          'color',
          'color_code',
          'stock_quantity',
          'litre',
          'price',
          'description',
          'image_url',
      ];

}
