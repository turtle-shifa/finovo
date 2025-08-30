<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFinancial extends Model
{
    protected $fillable = ['company_id', 'total_cost', 'total_revenue', 'total_profit'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}