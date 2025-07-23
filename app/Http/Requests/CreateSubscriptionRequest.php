<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Subscription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plan_id' => ['required', 'int', 'exists:plans,id'],
            'payment_frequency' => ['required', 'string', Rule::in([
                Subscription::ONETIME,
                Subscription::MONTHLY,
                Subscription::YEARLY,
            ])
            ],
        ];
    }
}
