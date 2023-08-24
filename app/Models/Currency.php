<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    public function exchangeRates() {
        return $this->hasMany(ExchangeRate::class);
    }

    public function surcharge() {
        return $this->hasOne(Surcharge::class);
    }
}

