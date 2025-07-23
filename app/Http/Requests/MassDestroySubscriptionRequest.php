<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class MassDestroySubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('subscription_delete');
    }

    public function rules(): array
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:stripe_subscriptions,id',
        ];
    }
}
