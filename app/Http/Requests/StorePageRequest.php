<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('page_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'theme_id' => [
                'integer',
                'required',
                'exists:themes,id'
            ],
            'user_id' => [
                'integer',
                'required',
                'exists:users,id'
            ],
        ];
    }
}
