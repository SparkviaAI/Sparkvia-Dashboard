<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChatBotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chat_bot_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'text' => ['nullable'],
            'site_url' => ['nullable'],
        ];
    }
}
