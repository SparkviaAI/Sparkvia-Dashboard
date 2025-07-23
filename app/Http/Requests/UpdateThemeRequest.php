<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class UpdateThemeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('profile_password_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'theme_id' => [
                'integer',
                'required',
                'exists:pages,id'
            ]
        ];
    }
}
