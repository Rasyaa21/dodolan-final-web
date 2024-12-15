<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'code',
        'store_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'receipt_number',
        'original_price',
        'promo_code',
        'discount',
        'final_price',
        'payment_status',
    ];

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function recalculateTotals()
    {
        $originalPrice = $this->transactionDetails->sum(function ($detail) {
            return $detail->price;
        });

        $discount = 0;

        if($this->promoCode) {
            $promo = $this->promoCode;

            if($promo->valid_until && now()->lessThanOrEqualTo($promo->valid_until)){
                if ($promo->discount_type == 'percentage') {
                    $discount = ($promo->discount_amount / 100) * $originalPrice;
                } elseif($promo->discount_type == 'fixed') {
                    $discount = min($promo->discount_amount, $originalPrice);
                }

                $promo->decrement('amount');
            }
        }

        $finalPrice = $originalPrice - $discount;

        $this->original_price = $originalPrice;
        $this->discount = $discount;
        $this->final_price = $finalPrice;

        $this->save();
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($transaction) {
            $transaction->recalculateTotals();
        });
    }
}
