<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPropertyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'price' => 'nullable|array|min:1|max:2',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'storeys' => 'nullable|integer|min:0',
            'garages' => 'nullable|integer|min:0',
        ];
    }
}
