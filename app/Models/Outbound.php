<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'customer_name',
        'customer_address',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'delivery_fee',
        'total_amount',
        'invoice_number',
    ];

    public function items()
    {
        return $this->hasMany(OutboundItem::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function returns()
    {
        return $this->hasMany(ReturnModel::class, 'outbound_id');
    }
}
