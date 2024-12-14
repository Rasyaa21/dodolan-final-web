<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_amount',
        'valid_until',
        'amount',
        'store_id',
    ];

    public function orders()
    {
        return $this->hasMany(Transaction::class);
    }
}
