<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:App\Models\Subscription,email',
            'if_price_is_above' => 'required|numeric|gt:0',
        ];
    }
}
