<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorLitre extends Model
{
    protected $fillable = ['color_id', 'litre', 'price'];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
