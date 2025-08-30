<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile',
        'address',
        'website',
        'logo',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function financial()
    {
        return $this->hasOne(CompanyFinancial::class);
    }

    public function outboundItems()
    {
        return $this->hasManyThrough(OutboundItem::class, Outbound::class);
    }
    public function outbounds()
    {
        return $this->hasMany(Outbound::class);
    }
}
