<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoCodeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'nullable|string|min:4',
            'discount_type' => 'nullable|in:percentage,fixed',
            'discount_amount' => 'nullable|integer',
            'valid_until' => 'nullable|date',
            'amount' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'code.min' => 'Kode promo harus minimal 4 karakter',
            'discount_type.in' => 'Jenis discount harus berupa percentage atau fixed',
            'discount_amount.integer' => 'Jumlah discount harus berupa angka',
            'valid_until.date' => 'Berlaku hingga harus berupa tanggal',
            'amount.integer' => 'Jumlah harus berupa angka'
        ];
    }
}

