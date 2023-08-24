<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SurchargeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/currencies', [CurrencyController::class, 'index']);
Route::get('/exchange-rates', [ExchangeRateController::class, 'index']);
Route::get('/surcharges', [SurchargeController::class, 'index']);
Route::post('/place-order', [OrderController::class, 'placeOrder']);
