<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboundItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'outbound_id',
        'stock_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function outbound()
    {
        return $this->belongsTo(Outbound::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
