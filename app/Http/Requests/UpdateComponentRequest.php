<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UpdateComponentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('component_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_id' => [
                'required'
            ],
            'component_id.*' => [
                'required',
            ],
            "content"    => [
                'array'
            ],
            "content.*"  => [
                'required',
                'string'
            ],
            'image_component_id.*' => [
                'required',
            ],
            'images' => [
                'nullable',
            ]
        ];
    }
}
