<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'sku',
        'mrp',
        'purchase_price',
        'selling_price',
        'stock_level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
{
    return $this->belongsTo(Company::class);
}

}
