<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('subscription_create');
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'plan_id' => [
                'required',
                'integer',
                'exists:plans,id'
            ],
            'start_at' => [
                'nullable',
                'date_format:d-m-Y H:i:s'
            ],
            'end_at' => [
                'nullable',
                'date_format:d-m-Y H:i:s'
            ],
            'canceled_at' => [
                'nullable',
                'date_format:d-m-Y H:i:s'
            ],
            'status' => [
                'required',
                'string',
                Rule::in(array_keys(Subscription::STATUS_SELECT)),
            ],
            'payment_frequency' => [
                'required',
                'string',
                Rule::in(array_keys(Subscription::PAYMENT_FREQUENCY_SELECT)),
            ],
        ];
    }
}
