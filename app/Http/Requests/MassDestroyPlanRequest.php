<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class MassDestroyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('plan_delete');
    }

    public function rules(): array
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:plans,id',
        ];
    }
}
