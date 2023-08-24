<?php

namespace App\Services;

use App\Services\Contracts\ExchangeRateApiServiceInterface;

class ExchangeRatesApiService implements ExchangeRateApiServiceInterface
{
    private CurrencyLayerApiService $currencyLayerApiService;

    public function __construct(CurrencyLayerApiService $currencyLayerApiService)
    {
        $this->currencyLayerApiService = $currencyLayerApiService;
    }

    public function getExchangeRates($baseCurrency, $targetCurrencies): array
    {
        return $this->currencyLayerApiService->getExchangeRates($baseCurrency, $targetCurrencies);
    }
}
