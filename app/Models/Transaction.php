<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'discount',
        'final_price',
        'payment_status',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
