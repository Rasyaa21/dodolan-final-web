<?php

namespace App\Interfaces;

interface StoreRepositoryInterface
{
    public function getAllStores();

    public function getStoreById(int $id);

    public function getStoreByUsername(string $username);

    public function createStore(array $data);

    public function updateStore(int $id, array $data);

    public function deleteStore(int $id);
}
