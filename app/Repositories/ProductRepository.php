<?php

namespace App\Repositories;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{

    private ProductImageRepositoryInterface $productImageRepository;

    public function __construct(ProductImageRepositoryInterface $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById(int $id)
    {
        $product = Product::find($id);
        if ($product){
            $product->increment('visitor');
        }
        return $product;
    }

    public function getProductBySlug(string $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $product->increment('visitor');
        }
        return $product;
    }

    public function getProductBySlugAndStoreId(string $slug, int $store_id)
    {
        $product = Product::where('slug', $slug)->where('store_id', $store_id)->first();
        if ($product) {
            $product->increment('visitor');
        }
        return $product;
    }

    public function createProduct(array $data)
    {
        $product = Product::create([
            'store_id' => $data['store_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . Str::random(5),
            'thumbnail' => $data['thumbnail']->store('assets/products', 'public'),
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);

        if (array_key_exists('images', $data)) {
            foreach ($data['images'] as $image) {
                $this->productImageRepository->createProductImage([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }
        }

        return $product;
    }

    public function updateProduct(int $id, array $data)
    {
        $product = Product::find($id);

        $product->update([
            'store_id' => $data['store_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . Str::random(5),
            'thumbnail' => array_key_exists('thumbnail', $data) && $data['thumbnail'] ? $data['thumbnail']->store('assets/products', 'public') : $product->thumbnail,
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);

        if (array_key_exists('images', $data)) {
            foreach ($data['images'] as $image) {
                $this->productImageRepository->createProductImage([
                    'product_id' => $product->id,
                    'image' => $image,
                ]);
            }
        }

        return $product;
    }

    public function deleteProduct(int $id)
    {
        return Product::find($id)->delete();
    }

    public function getProductByStoreId(int $id)
    {
        return Product::where('store_id', $id)->get();
    }
}
