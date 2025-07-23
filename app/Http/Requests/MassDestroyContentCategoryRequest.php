<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class MassDestroyContentCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('content_category_delete');
    }

    public function rules(): array
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:content_categories,id',
        ];
    }
}
