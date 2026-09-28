<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'market_name'    => ['required', 'string', 'max:191'],
            'description'    => ['nullable', 'string', 'max:3000'],
            'address'        => ['required', 'string', 'max:255'],
            'city'           => ['required', 'string', 'max:100'],
            'operating_days' => ['required', 'string', 'max:191'],
            'opening_time'   => ['required'],
            'closing_time'   => ['required'],
            'latitude'       => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'      => ['nullable', 'numeric', 'between:-180,180'],
            'map_provider'   => ['nullable', 'in:google,openstreetmap'],
            'status'         => ['required', 'in:active,inactive'],
        ];
    }
}
