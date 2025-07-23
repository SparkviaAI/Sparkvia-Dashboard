<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

final class UpdatePlanRequest extends StorePlanRequest
{
    public function authorize(): bool
    {
        return Gate::allows('plan_edit');
    }
}
