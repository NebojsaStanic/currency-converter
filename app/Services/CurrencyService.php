<?php

namespace App\Services;

use App\Models\Currency;
use Exception;

class CurrencyService {

    public function convertFromUSD($usdAmount, $currencyCode)
    {
        if ($currencyCode === 'USD') {
            return $usdAmount; // No conversion needed
        }

        return $usdAmount * $this->getExchangeRateFromDatabase($currencyCode);
    }

    public function getExchangeRateFromDatabase($currencyCode) {
        $currency = Currency::whereCode('USD')->first();

        if (!$currency) {
            throw new Exception("Currency with code $currencyCode not found.");
        }

        $exchangeRate = $currency->exchangeRates()->where('code', 'LIKE', '%'.$currencyCode.'%')->first();

        if (!$exchangeRate) {
            throw new Exception("Exchange rate for $currencyCode not found in the database.");
        }

        return $exchangeRate->quote;
    }

    public function calculateSurcharge($usdAmount, $currencyCode)
    {
        $surchargePercentage = $this->getSurchargePercentage($currencyCode);
        return $usdAmount * $surchargePercentage;
    }

    public function applyDiscount($usdAmount, $currencyCode)
    {
        $discountPercentage = ($currencyCode === 'EUR') ? 2 : 0;
        return $usdAmount * ($discountPercentage / 100);
    }

    public function getSurchargePercentage($currencyCode)
    {
        return Currency::whereCode($currencyCode)->firstOrFail()->surcharge->percentage;
    }
}


