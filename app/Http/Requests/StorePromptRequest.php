<?php

namespace App\Http\Requests;

use App\Models\Prompt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePromptRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prompt_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'prompt' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'max_tokens' => [
                'nullable',
                'integer',
            ],
            'questions' => [
                'array',
            ],
            'engine_id' => [
                'integer',
                'nullable',
                'exists:engines,id'
            ],
            'chat_bot_id' => [
                'integer',
                'nullable',
                'exists:chat_bots,id'
            ]
        ];
    }
}
