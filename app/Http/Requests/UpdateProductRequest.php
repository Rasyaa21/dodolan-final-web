<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'store_id' => 'nullable|exists:stores,id',
            'name' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'price' => 'nullable|integer|min:0',
            'stock' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.exists' => 'Store ID tidak valid',
            'name.string' => 'Nama produk harus berupa string',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'thumbnail.mimes' => 'Thumbnail harus berekstensi jpeg, png, jpg, atau gif',
            'thumbnail.max' => 'Thumbnail tidak boleh lebih dari 2 MB',
            'description.string' => 'Deskripsi produk harus berupa string',
            'price.integer' => 'Harga produk harus berupa angka',
            'price.min' => 'Harga produk tidak boleh kurang dari 0',
            'stock.integer' => 'Stok produk harus berupa angka',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0',
        ];
    }
}

