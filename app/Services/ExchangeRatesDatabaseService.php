<?php

namespace App\Services;

use App\Services\Contracts\ExchangeRateDatabaseServiceInterface;
use App\Models\Currency;
use App\Models\ExchangeRate;

class ExchangeRatesDatabaseService implements ExchangeRateDatabaseServiceInterface
{
    public function insertExchangeRates($currency, $exchangeRates): void
    {
        $exchangeRatesData = $this->prepareData($currency, $exchangeRates, true);
        ExchangeRate::insert($exchangeRatesData);
    }

    public function updateExchangeRates($currency, $exchangeRates): void
    {
        $exchangeRatesData = $this->prepareData($currency, $exchangeRates);
        ExchangeRate::query()->update($exchangeRatesData);
    }

    private function prepareData(Currency $currency, array $exchangeRates, $isInsert = false): array
    {
        $exchangeRatesData = [];
        $now = now();

        foreach ($exchangeRates as $code => $exchangeRate) {
            $exchangeRateData = [
                'currency_id'   => $currency->id,
                'code'          => $code,
                'quote'         => $exchangeRate,
                'updated_at'    => $now,
            ];

            if ($isInsert) {
                $exchangeRateData['created_at'] = $now;
            }

            $exchangeRatesData[] = $exchangeRateData;
        }

        return $exchangeRatesData;
    }
}

