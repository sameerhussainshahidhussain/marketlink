<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterFarmerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'phone'         => ['required', 'string', 'max:25'],
            'password'      => ['required', 'confirmed', Password::min(8)],
            'business_name' => ['required', 'string', 'max:191'],
            'contact_person'=> ['nullable', 'string', 'max:191'],
            'address'       => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string', 'max:2000'],
        ];
    }
}
