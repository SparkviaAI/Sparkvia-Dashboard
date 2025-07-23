<?php

namespace App\Http\Requests;

use App\Rules\UniqueEmailInTenant;
use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new UniqueEmailInTenant()],
            'password' => ['required', 'string', 'min:8'],
            'krashless_plan_id' => ['required', 'integer'],
        ];
    }
}
