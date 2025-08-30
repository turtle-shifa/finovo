<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    use HasFactory;
    protected $fillable = ['return_id', 'stock_id', 'quantity', 'unit_price', 'subtotal'];

    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    public function return() {
        return $this->belongsTo(ReturnModel::class, 'return_id');
    }
}