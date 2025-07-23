<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('plan_create');
    }

    public function rules(): array
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'price_monthly' => [
                'nullable',
                'numeric'
            ],
            'price_yearly' => [
                'nullable',
                'numeric'
            ],
            'one_time_price' => [
                'nullable', 'numeric'
            ],
            'pp_monthly_plan' => [
                'nullable', 'string'
            ],
            'pp_yearly_plan' => [
                'nullable', 'string'
            ],
            'pp_onetime_plan' => [
                'nullable', 'string'
            ],
            'stripe_monthly_plan' => [
                'nullable', 'string'
            ],
            'stripe_yearly_plan' => [
                'nullable', 'string'
            ],
            'stripe_onetime_plan' => [
                'nullable', 'string'
            ],
            'type' => [
                'required',
            ],
            'word_limit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'image_limit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'seats_limit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'features' => [
                'required',
                'array'
            ]
        ];
    }
}
