<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:stores,username,' . $this->route('store'),
            'password' => 'nullable|string',
            'store_name' => 'required|string',
            'city' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'header_color' => 'nullable|string',
            'primary_color' => 'nullable|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username harus diisi',
            'username.string' => 'Username harus berupa string',
            'username.unique' => 'Username sudah digunakan',
            'password.string' => 'Password harus berupa string',
            'store_name.required' => 'Nama toko harus diisi',
            'store_name.string' => 'Nama toko harus berupa string',
            'city.required' => 'Kota harus diisi',
            'city.string' => 'Kota harus berupa string',
            'logo.image' => 'Logo harus berupa gambar',
            'logo.mimes' => 'Logo harus berupa file JPEG, PNG, JPG, GIF, atau SVG',
            'logo.max' => 'Logo maksimal berukuran 2MB',
            'header_color.string' => 'Warna header harus berupa string',
            'primary_color.string' => 'Warna primary harus berupa string'
        ];
    }
}

