<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($transactionDetail) {
            try {
                $product = $transactionDetail->product;

                if ($product && isset($product->price)) {
                    $transactionDetail->price = $product->price * $transactionDetail->qty;
                } else {
                    throw new \Exception('Product price is not set');
                }
            } catch (\Exception $e) {
                Log::error('Error calculating transaction detail price: ' . $e->getMessage());
                $transactionDetail->price = 0;
            }
        });
    }
}

