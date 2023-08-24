<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return Currency::whereIn('code', ['JPY', 'GBP', 'EUR'])->get();
    }
}
