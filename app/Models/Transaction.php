<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'type',
        'description',
        'amount',
        'created_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
