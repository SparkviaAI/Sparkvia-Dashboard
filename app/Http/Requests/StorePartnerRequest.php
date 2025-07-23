<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('partner_create');
    }

    public function rules(): array
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'logo' => [
                'required',
            ],
        ];
    }
}
