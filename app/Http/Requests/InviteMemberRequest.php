<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Pennant\Feature;

class InviteMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Feature::active('workspaces') && auth()->user()->canAddNewMember();
    }

    public function rules(): array
    {
        return [
            'team_id' => ['required', 'exists:teams,id'],
            'user_id' => ['required', 'exists:users,id'],
            'email' => ['required', 'email'],
            'subdomain' => ['required', 'exists:tenants,name']
        ];
    }
}
