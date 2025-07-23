<?php

namespace App\Http\Requests;

use App\Models\Prompt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePromptRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prompt_edit');
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
            'questions' => [
                'array',
            ],
            'engine_id' => [
                'integer',
                'nullable',
                'exists:engines,id'
            ],
            'max_tokens' => [
                'nullable',
                'integer',
            ],
            'chat_bot_id' => [
                'integer',
                'nullable',
                'exists:chat_bots,id'
            ]
        ];
    }
}
