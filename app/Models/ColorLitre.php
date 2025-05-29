<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Color;


class ColorLitre extends Model
{
    use HasFactory; 

    protected $fillable = ['color_id', 'litre', 'price'];

    public function color() {
    return $this->belongsTo(Color::class, 'color_id');
}

}
