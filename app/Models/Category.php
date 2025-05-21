<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_name',
        'category_subheading',
        'category_description',
        'category_key_features',
    ];
    protected $primaryKey = 'category_id'; // Specify the primary key if it's not 'id'
    protected $table = 'categories'; // Specify the table name if it's not the plural of the model name
    public $timestamps = true; // Enable timestamps if your table has 'created_at' and 'updated_at' columns 
}
