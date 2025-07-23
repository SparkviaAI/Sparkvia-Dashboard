<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('chat_create');
    }

    public function rules(): array
    {
        return [
            'role' => 'string|required',
            'content' => 'string|required',
        ];
    }
}
