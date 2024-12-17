<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:4|unique:stores',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'store_name' => 'required|string',
            'city' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi',
            'username.string' => 'Username harus berupa string',
            'username.min' => 'Username minimal harus 4 karakter',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal harus 8 karakter',
            'password.regex' => 'Password harus terdiri dari setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka',
            'store_name.required' => 'Nama toko harus diisi',
            'store_name.string' => 'Nama toko harus berupa string',
            'city.required' => 'Kota harus diisi',
            'city.string' => 'Kota harus berupa string',
            'logo.required' => 'Logo harus diisi',
            'logo.image' => 'Logo harus berupa gambar',
            'logo.mimes' => 'Logo harus berupa file JPEG, PNG, JPG, GIF, atau SVG',
            'logo.max' => 'Logo maksimal berukuran 2MB',
        ];
    }
}

