<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionDetailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'sometimes|integer|exists:products,id',
            'qty' => 'sometimes|integer|min:1',
            'price' => 'sometimes|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'ID produk harus diisi',
            'product_id.integer' => 'ID produk harus berupa angka',
            'product_id.exists' => 'ID produk tidak valid',
            'qty.required' => 'Jumlah harus diisi',
            'qty.integer' => 'Jumlah harus berupa angka',
            'qty.min' => 'Jumlah tidak boleh kurang dari 1',
            'price.required' => 'Harga harus diisi',
            'price.integer' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh kurang dari 0',
        ];
    }
}

