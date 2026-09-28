<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isFarmer() || auth()->user()->isAdmin());
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:191'],
            'category_id'    => ['required', 'exists:categories,id'],
            'price'          => ['required', 'numeric', 'min:0'],
            'unit'           => ['required', 'string', 'max:50'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'description'    => ['nullable', 'string', 'max:3000'],
            'image'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'status'         => ['required', 'in:active,inactive'],
        ];
    }
}
