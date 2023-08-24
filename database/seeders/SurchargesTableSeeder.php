<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Surcharge;

class SurchargesTableSeeder extends Seeder
{
    public function run()
    {
        $surcharges = [
            'JPY' => 7.5,
            'GBP' => 5,
            'EUR' => 5,
        ];

        foreach ($surcharges as $code => $percentage) {
            $currency = Currency::where('code', $code)->first();
            Surcharge::create([
                'currency_id' => $currency->id,
                'percentage'  => $percentage,
            ]);
        }
    }
}

