<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyLayerApiService
{
    protected string $baseUrl;
    protected string $accessKey;

    public function __construct()
    {
        $this->baseUrl = env('CURRENCY_LAYER_BASE_URL');
        $this->accessKey = env('CURRENCY_LAYER_ACCESS_KEY');
    }

    public function getCurrencies() : array
    {
        return $this->makeRequest(env('CURRENCY_LAYER_CURRENCIES_LIST_ENDPOINT'))['currencies'];
    }

    public function getExchangeRates(string $from, array $to) : array
    {
        $params = [
            'currencies' => implode(',', $to),
            'source' => $from,
            'format' => 1,
        ];

        return $this->makeRequest(env('CURRENCY_LAYER_EXCHANGE_RATES_ENDPOINT'), $params)['quotes'];
    }

    private function makeRequest(string $endpoint, array $params = []) : array
    {
        $params['access_key'] = $this->accessKey;
        $response = Http::get($this->baseUrl . $endpoint, $params);

        return $response->json();
    }
}
