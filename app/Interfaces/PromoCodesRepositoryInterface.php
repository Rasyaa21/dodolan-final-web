<?php

namespace App\Interfaces;
interface PromoCodesRepositoryInterface {
    public function getPromoCodeById(int $id);
    public function addPromoCode(array $data);
    public function updatePromoCode(int $id, array $data);
    public function deletePromoCode(int $id);
    public function getAllPromoCodes();
    public function getPromoCodeByStoreId(int $id);
}

