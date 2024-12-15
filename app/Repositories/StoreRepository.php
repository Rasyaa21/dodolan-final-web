<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAllStores()
    {
        return Store::all();
    }

    public function getStoreById(int $id)
    {
        return Store::find($id);
    }

    public function getStoreByUsername(string $username)
    {
        return Store::where('username', $username)->first();
    }

    public function createStore(array $data)
    {
        $store = Store::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'store_name' => $data['store_name'],
            'city' => $data['city'],
            'logo' => $data['logo']->store('assets/store', 'public'),
        ]);

        return $store;
    }

    public function updateStore(int $id, array $data)
    {
        $store = Store::find($id);

        $store->update([
            'username' => $data['username'],
            'password' => bcrypt($data['password']) ?? $store->password,
            'store_name' => $data['store_name'],
            'city' => $data['city'],
            'logo' => array_key_exists('logo', $data) && $data['logo'] ? $data['logo']->store('assets/store', 'public') : $store->logo,
            'header_color' => $data['header_color'],
            'primary_color' => $data['primary_color'],
        ]);

        return $store;
    }

    public function updateColor(int $id, array $data){
        $store = Store::find($id);

        $store->update([
            'header_color' => $data['header_color'],
            'primary_color' => $data['primary_color'],
        ]);

        return $store;
    }

    public function deleteStore(int $id)
    {
        return Store::find($id)->delete();
    }
}
