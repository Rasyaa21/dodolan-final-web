<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'no_resi' => 'string|nullable',
            'payment_status' => 'in:pending,paid,failed',
        ];
    }

    public function messages(): array
    {
        return [
            'no_resi.string' => 'No resi harus berupa string',
            'payment_status.in' => 'Status pembayaran harus berupa: pending, paid, atau failed',
        ];
    }
}

