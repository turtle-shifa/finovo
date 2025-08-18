<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_id',
        'category_id',
        'image',
        'is_active',
        'variants',
    ];

    protected $casts = [
        'variants' => 'array', // JSON to array converting
        'is_active' => 'boolean', //0 or 1 convert to true or false
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
