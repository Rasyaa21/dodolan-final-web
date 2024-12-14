<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromoCodeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'code' => 'required|string|min:4|unique:promo_codes,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|integer',
            'store_id' => 'required|exists:stores,id',
            'valid_until' => 'required|date',
            'amount' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode promo harus diisi',
            'code.min' => 'Kode promo minimal 4 karakter',
            'code.unique' => 'Kode promo sudah digunakan',
            'discount_type.required' => 'Jenis discount harus diisi',
            'discount_type.in' => 'Jenis discount harus berupa percentage atau fixed',
            'discount_amount.required' => 'Jumlah discount harus diisi',
            'discount_amount.integer' => 'Jumlah discount harus berupa angka',
            'store_id.required' => 'Toko harus diisi',
            'store_id.exists' => 'Toko tidak valid',
            'valid_until.required' => 'Berlaku hingga harus diisi',
            'valid_until.date' => 'Berlaku hingga harus berupa tanggal',
            'amount.required' => 'Jumlah harus diisi',
            'amount.integer' => 'Jumlah harus berupa angka'
        ];
    }
}

