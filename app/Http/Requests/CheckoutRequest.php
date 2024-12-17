<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'cart_data' => 'required|json',
            'original_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
            'promo_code' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Field nama pelanggan harus diisi',
            'customer_name.string' => 'Field nama pelanggan harus berupa string',
            'customer_name.max' => 'Field nama pelanggan terlalu panjang',

            'customer_phone.required' => 'Field nomor telepon pelanggan harus diisi',
            'customer_phone.string' => 'Field nomor telepon pelanggan harus berupa string',
            'customer_phone.max' => 'Field nomor telepon pelanggan terlalu panjang',

            'customer_address.required' => 'Field alamat pelanggan harus diisi',
            'customer_address.string' => 'Field alamat pelanggan harus berupa string',
            'customer_address.max' => 'Field alamat pelanggan terlalu panjang',

            'cart_data.required' => 'Field data keranjang harus diisi',
            'cart_data.json' => 'Field data keranjang harus berupa json',

            'original_price.required' => 'Field harga asli harus diisi',
            'original_price.numeric' => 'Field harga asli harus berupa angka',
            'original_price.min' => 'Field harga asli minimal 0',

            'discount.required' => 'Field diskon harus diisi',
            'discount.numeric' => 'Field diskon harus berupa angka',
            'discount.min' => 'Field diskon minimal 0',

            'final_price.required' => 'Field harga final harus diisi',
            'final_price.numeric' => 'Field harga final harus berupa angka',
            'final_price.min' => 'Field harga final minimal 0',
        ];
    }
}

