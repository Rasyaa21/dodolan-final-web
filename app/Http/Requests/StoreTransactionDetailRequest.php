<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionDetailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'transaction_id' => 'required|integer|exists:transactions,id',
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_id.required' => 'ID transaksi harus diisi',
            'transaction_id.integer' => 'ID transaksi harus berupa angka',
            'transaction_id.exists' => 'ID transaksi tidak valid',
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

