<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExchangeRate extends Model {

    protected $casts = [
        'quote' => 'double',
    ];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }
}

