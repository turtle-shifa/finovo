<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
