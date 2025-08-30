<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'category_id',
        'product_id',
        'variant',
        'batch_number',
        'quantity',
        'purchase_price',
        'selling_price',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function returnItems()
{
    return $this->hasMany(ReturnItem::class, 'stock_id');
}
}
