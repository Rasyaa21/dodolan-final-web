<?php

namespace App\Repositories;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Models\ProductImage;

class ProductImageRepository  implements ProductImageRepositoryInterface
{
    public function getAllProductImages()
    {
        return ProductImage::all();
    }

    public function getProductImageById(int $id)
    {
        return ProductImage::find($id);
    }

    public function createProductImage(array $data)
    {
        return ProductImage::create([
            'product_id' => $data['product_id'],
            'image' => $data['image']->store('assets/products', 'public'),
        ]);
    }

    public function updateProductImage(int $id, array $data)
    {
        $productImage = ProductImage::find($id);

        $productImage->update([
            'product_id' => $data['product_id'],
            'image' => $data['image']->store('assets/products', 'public'),
        ]);
    }

    public function deleteProductImage(int $id)
    {
        $productImage = ProductImage::find($id);
        $productImage->delete();
    }
}
