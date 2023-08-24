<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Surcharge;

class SurchargeController extends Controller
{
    public function index()
    {
        if (!Currency::exists()) {
            return [];
        }

        $currencyCodes = ['JPY', 'GBP', 'EUR'];

        return Surcharge::whereIn('currency_id', function ($query) use ($currencyCodes) {
            $query->select('id')
                ->from('currencies')
                ->whereIn('code', $currencyCodes);
        })->get();
    }
}
