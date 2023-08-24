<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'foreign_currency',
        'exchange_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'foreign_amount',
        'usd_amount',
        'discount_percentage',
        'discount_amount',
        'total_amount',
    ];

    protected $hidden = [
        'id',
        'currency_id'
    ];

    public function getSurchargePercentageAttribute($value)
    {
        return $value . '%';
    }

    public function getDiscountPercentageAttribute($value)
    {
        return $value . '%';
    }
}
