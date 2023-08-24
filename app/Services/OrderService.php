<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Order;

class OrderService {

    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function createOrder($usdAmount, $selectedCurrencyCode)
    {
        $foreignAmount = $this->currencyService->convertFromUSD($usdAmount, $selectedCurrencyCode);
        $surchargeAmount = $this->currencyService->calculateSurcharge($usdAmount, $selectedCurrencyCode);
        $discountAmount = $this->currencyService->applyDiscount($usdAmount, $selectedCurrencyCode);
        $totalAmount = $foreignAmount + $surchargeAmount - $discountAmount;

        $currency = Currency::whereCode($selectedCurrencyCode)->first();

        $orderData = [
            'currency_id'          => $currency->id,
            'foreign_currency'     => $selectedCurrencyCode,
            'exchange_rate'        => $this->currencyService->getExchangeRateFromDatabase($selectedCurrencyCode),
            'surcharge_percentage' => $this->currencyService->getSurchargePercentage($selectedCurrencyCode) * 100,
            'surcharge_amount'     => $surchargeAmount,
            'foreign_amount'       => $foreignAmount,
            'usd_amount'           => $usdAmount,
            'discount_percentage'  => ($selectedCurrencyCode === 'EUR') ? 2 : 0,
            'discount_amount'      => $discountAmount,
            'total_amount'         => $totalAmount,
            'date_created'         => now(),
        ];

        return Order::create($orderData);
    }

}

