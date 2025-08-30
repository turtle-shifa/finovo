<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    use HasFactory;
    protected $table = 'returns';

    protected $fillable = ['outbound_id', 'company_id', 'customer_name', 'total_amount'];

    public function items() {
        return $this->hasMany(ReturnItem::class, 'return_id');
    }

    public function outbound() {
        return $this->belongsTo(Outbound::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}