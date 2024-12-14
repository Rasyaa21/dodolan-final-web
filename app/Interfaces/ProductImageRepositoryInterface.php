<?php

namespace App\Interfaces;


interface ProductImageRepositoryInterface
{
    public function getAllProductImages();
    public function getProductImageById(int $id);
    public function createProductImage(array $data);
    public function updateProductImage(int $id, array $data);
    public function deleteProductImage(int $id);
}
