<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProducts();

    public function getProductById(int $id);

    public function getProductByStoreId(int $id);

    public function getProductBySlug(string $slug);

    public function getProductBySlugAndStoreId(string $slug, int $store_id);

    public function createProduct(array $data);

    public function updateProduct(int $id, array $data);

    public function deleteProduct(int $id);
}
