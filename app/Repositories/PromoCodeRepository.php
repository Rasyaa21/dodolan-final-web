<?php

namespace App\Repositories;

use App\Models\PromoCode;
use App\Interfaces\PromoCodesRepositoryInterface;

class PromoCodeRepository implements PromoCodesRepositoryInterface
{
    public function getPromoCodeById(int $id)
    {
        return PromoCode::find($id);
    }

    public function addPromoCode(array $data)
    {
        $code = PromoCode::create([
            'code' => $data['code'],
            'discount_type' => $data['discount_type'],
            'store_id' => $data['store_id'],
            'discount_amount' => $data['discount_amount'],
            'valid_until' => $data['valid_until'],
            'amount' => $data['amount']
        ]);

        return $code;
    }

    public function updatePromoCode(int $id, array $data)
    {
        $code = PromoCode::find($id);

        $code->update([
            'code' => $data['code'],
            'discount_type' => $data['discount_type'],
            'discount_amount' => $data['discount_amount'],
            'valid_until' => $data['valid_until'],
            'amount' => $data['amount']
        ]);
    }

    public function deletePromoCode(int $id)
    {
        return PromoCode::find($id)->delete();
    }

    public function getAllPromoCodes()
    {
        return PromoCode::all();
    }

    public function getPromoCodeByStoreId(int $id){
        return PromoCode::where('store_id', $id)->get();
    }
}

