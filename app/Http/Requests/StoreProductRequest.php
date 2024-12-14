<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.required' => 'Store ID harus diisi',
            'store_id.exists' => 'Store ID tidak valid',
            'name.required' => 'Nama produk harus diisi',
            'name.string' => 'Nama produk harus berupa string',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter',
            'thumbnail.required' => 'Thumbnail harus diisi',
            'thumbnail.image' => 'Thumbnail harus berupa gambar',
            'thumbnail.mimes' => 'Thumbnail harus berekstensi jpeg, png, jpg, atau gif',
            'thumbnail.max' => 'Thumbnail tidak boleh lebih dari 2 MB',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
            'price.required' => 'Harga harus diisi',
            'price.integer' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh kurang dari 0',
            'stock.required' => 'Stok harus diisi',
            'stock.integer' => 'Stok harus berupa angka',
            'stock.min' => 'Stok tidak boleh kurang dari 0',
            'images.*.required' => 'Setiap gambar harus diisi',
            'images.*.image' => 'Setiap file harus berupa gambar',
            'images.*.mimes' => 'Setiap gambar harus berekstensi jpeg, png, jpg, atau gif',
            'images.*.max' => 'Setiap gambar tidak boleh lebih dari 2 MB',
        ];
    }
}

