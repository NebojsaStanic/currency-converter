<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Services\Contracts\ExchangeRateApiServiceInterface;
use App\Services\Contracts\ExchangeRateDatabaseServiceInterface;
use Carbon\Carbon;

class ExchangeRatesService
{
    private ExchangeRateApiServiceInterface $exchangeRateApiService;
    private ExchangeRateDatabaseServiceInterface $exchangeRateDatabaseService;

    public function __construct(
        ExchangeRateApiServiceInterface $exchangeRateApiService,
        ExchangeRateDatabaseServiceInterface $exchangeRateDatabaseService
    ) {
        $this->exchangeRateApiService = $exchangeRateApiService;
        $this->exchangeRateDatabaseService = $exchangeRateDatabaseService;
    }

    public function getExchangeRates(Currency $currency)
    {
        if (ExchangeRate::exists()) {
            if (!$this->isTodayDate()) {
                $this->exchangeRateDatabaseService->updateExchangeRates($currency, $this->getExchangeRatesFromApi());
            }

            return $currency->exchangeRates;
        }

        $this->exchangeRateDatabaseService->insertExchangeRates($currency, $this->getExchangeRatesFromApi());
        return $currency->exchangeRates;
    }

    private function getExchangeRatesFromApi(): array
    {
        return $this->exchangeRateApiService->getExchangeRates('USD', ['JPY', 'GBP', 'EUR']);
    }

    private function isTodayDate(): bool
    {
        return Carbon::parse(ExchangeRate::first()->ts_updated)->isToday();
    }
}
