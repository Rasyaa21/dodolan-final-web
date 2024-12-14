<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'ID produk harus diisi',
            'product_id.integer' => 'ID produk harus berupa angka',
            'product_id.exists' => 'ID produk tidak valid',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'File yang diupload harus berupa gambar',
            'image.mimes' => 'File yang diupload harus berekstensi jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran file yang diupload harus kurang dari 2 MB',
        ];
    }
}

