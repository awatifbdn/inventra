<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paint extends Model
{
    protected $fillable = ['name', 'code', 'paint_category_id'];

    public function category()
    {
        return $this->belongsTo(PaintCategory::class);
    }
}
