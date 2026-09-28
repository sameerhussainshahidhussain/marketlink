<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:191'],
            'phone'         => ['nullable', 'string', 'max:25'],
            'address'       => ['nullable', 'string', 'max:255'],
            'business_name' => ['nullable', 'string', 'max:191'],
            'description'   => ['nullable', 'string', 'max:2000'],
            'location_name' => ['nullable', 'string', 'max:191'],
            'latitude'      => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'     => ['nullable', 'numeric', 'between:-180,180'],
            'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ];
    }
}
