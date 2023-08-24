<?php

namespace App\Services\Contracts;

interface ExchangeRateDatabaseServiceInterface
{
    public function insertExchangeRates($currency, $exchangeRates): void;
    public function updateExchangeRates($currency, $exchangeRates): void;
}

