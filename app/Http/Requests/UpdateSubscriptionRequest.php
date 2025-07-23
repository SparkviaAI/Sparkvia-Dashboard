<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class UpdateSubscriptionRequest extends StoreSubscriptionRequest
{
    public function authorize(): bool
    {
        return Gate::allows('subscription_edit');
    }
}
