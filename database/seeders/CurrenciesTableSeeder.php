<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Services\CurrencyLayerApiService;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(CurrencyLayerApiService $currencyLayerApiService): void
    {
        $currencies = $currencyLayerApiService->getCurrencies();
        $currenciesData = $this->prepareCurrenciesData($currencies);
        $this->insertCurrencies($currenciesData);
    }

    private function prepareCurrenciesData(array $currencies): array
    {
        $currenciesData = [];
        foreach ($currencies as $code => $name) {
            $currenciesData[] = [
                'code' => $code,
                'name' => $name
            ];
        }
        return $currenciesData;
    }

    private function insertCurrencies(array $currenciesData): void
    {
        Currency::insert($currenciesData);
    }
}
