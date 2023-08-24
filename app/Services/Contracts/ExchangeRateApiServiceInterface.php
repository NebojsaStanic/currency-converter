<?php

namespace App\Services\Contracts;

interface ExchangeRateApiServiceInterface
{
    public function getExchangeRates($baseCurrency, $targetCurrencies): array;
}

