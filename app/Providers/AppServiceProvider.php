<?php

namespace App\Providers;

use App\Services\Contracts\ExchangeRateApiServiceInterface;
use App\Services\Contracts\ExchangeRateDatabaseServiceInterface;
use App\Services\ExchangeRatesApiService;
use App\Services\ExchangeRatesDatabaseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExchangeRateApiServiceInterface::class, ExchangeRatesApiService::class);
        $this->app->bind(ExchangeRateDatabaseServiceInterface::class, ExchangeRatesDatabaseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
