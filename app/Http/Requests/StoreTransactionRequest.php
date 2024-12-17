<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:transactions,code',
            'store_id' => 'required|integer|exists:stores,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'final_price' => 'required|numeric|min:0',
            'receipt_number' => 'required|numeric|min:0',
            'input_price' => 'required|numeric|min:0',
            'shipping_fee' => 'required|numeric|min:0',
            'promo_code_id' => 'nullable|integer|exists:promo_codes,id',
            'payment_status' => 'required|in:pending,paid,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode transaksi harus diisi',
            'code.string' => 'Kode transaksi harus berupa string',
            'code.unique' => 'Kode transaksi sudah digunakan',
            'store_id.required' => 'Toko harus diisi',
            'store_id.integer' => 'Toko harus berupa angka',
            'store_id.exists' => 'Toko tidak valid',
            'customer_name.required' => 'Nama pelanggan harus diisi',
            'customer_name.string' => 'Nama pelanggan harus berupa string',
            'customer_name.max' => 'Nama pelanggan tidak boleh lebih dari 255 karakter',
            'customer_phone.required' => 'Nomor telepon pelanggan harus diisi',
            'customer_phone.string' => 'Nomor telepon pelanggan harus berupa string',
            'customer_phone.max' => 'Nomor telepon pelanggan tidak boleh lebih dari 20 karakter',
            'customer_address.required' => 'Alamat pelanggan harus diisi',
            'customer_address.string' => 'Alamat pelanggan harus berupa string',
            'customer_address.max' => 'Alamat pelanggan tidak boleh lebih dari 500 karakter',
            'final_price.required' => 'Total harga harus diisi',
            'final_price.numeric' => 'Total harga harus berupa angka',
            'final_price.min' => 'Total harga tidak boleh kurang dari 0',
            'input_price.required' => 'Uang yang dibayarkan harus diisi',
            'input_price.numeric' => 'Uang yang dibayarkan harus berupa angka',
            'input_price.min' => 'Uang yang dibayarkan tidak boleh kurang dari 0',
            'shipping_fee.required' => 'Biaya pengiriman harus diisi',
            'shipping_fee.numeric' => 'Biaya pengiriman harus berupa angka',
            'shipping_fee.min' => 'Biaya pengiriman tidak boleh kurang dari 0',
            'promo_code_id.integer' => 'Kode promo harus berupa angka',
            'promo_code_id.exists' => 'Kode promo tidak valid',
            'payment_status.required' => 'Status pembayaran harus diisi',
            'payment_status.in' => 'Status pembayaran harus berupa pending, paid, atau cancelled',
        ];
    }
}

