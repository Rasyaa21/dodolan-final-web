<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'primary_color.required' => 'Warna primer dibutuhkan',
            'primary_color.string' => 'Warna primer harus berupa string',
            'primary_color.max' => 'Warna primer harus kurang dari 7 karakter',
            'header_color.required' => 'Warna header dibutuhkan',
            'header_color.string' => 'Warna header harus berupa string',
            'header_color.max' => 'Warna header harus kurang dari 7 karakter',
        ];
    }

    public function rules(): array
    {
        return [
            'primary_color' => ['required', 'string', 'max:7'],
            'header_color' => ['required', 'string', 'max:7'],
        ];
    }
}

