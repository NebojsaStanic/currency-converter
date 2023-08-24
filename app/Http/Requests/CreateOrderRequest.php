<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest {
    public function rules()
    {
        return [
            'foreign_amount' => 'required|numeric|min:0',
            'currency_code'  => 'required|string|max:5',
        ];
    }
}

