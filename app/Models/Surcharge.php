<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surcharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage'
    ];

    protected $casts = [
        'percentage' => 'double',
    ];

    protected $appends = [
        'currency_code',
    ];

    public function getPercentageAttribute($percentage)
    {
        return $percentage / 100;
    }

    public function getCurrencyCodeAttribute()
    {
        return $this->currency->code;
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}
