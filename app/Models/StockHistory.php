<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class StockHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_id',
        'entry_type',
        'quantity',
        'entry_date',
        'note',
    ];

    public function inventory()
{
    return $this->belongsTo(Inventory::class);
}

}
