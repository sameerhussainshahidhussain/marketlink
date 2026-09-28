<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePickupSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isFarmer() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'market_id'   => ['required', 'exists:markets,id'],
            'pickup_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time'  => ['required'],
            'end_time'    => ['required', 'after:start_time'],
            'max_orders'  => ['required', 'integer', 'min:1', 'max:500'],
            'cutoff_time' => ['required', 'date'],
        ];
    }
}
