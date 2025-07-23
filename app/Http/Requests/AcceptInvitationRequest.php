<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\UniqueEmailInTenant;
use App\Rules\ValidUnhandledToken;
use Illuminate\Foundation\Http\FormRequest;

class AcceptInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'    => ['required', 'string', 'max:255', new ValidUnhandledToken()],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', new UniqueEmailInTenant()],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
