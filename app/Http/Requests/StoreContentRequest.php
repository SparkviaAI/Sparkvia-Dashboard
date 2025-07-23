<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_create');
    }

    public function rules()
    {
        return [
            'prompt_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
