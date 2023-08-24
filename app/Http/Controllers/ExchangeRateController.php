<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Services\ExchangeRatesService;

class ExchangeRateController extends Controller
{

    private ExchangeRatesService $exchangeRatesService;

    public function __construct(ExchangeRatesService $exchangeRatesService)
    {
        $this->exchangeRatesService = $exchangeRatesService;
    }

    public function index()
    {
        $currency = Currency::whereCode('USD')->firstOrFail();
        return $this->exchangeRatesService->getExchangeRates($currency);
    }
}
