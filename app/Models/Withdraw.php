<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdraw extends Model
{
    protected $fillable = [
        'store_id',
        'status',
        'amount',
        'requested_at',
        'processed_at',
        'description',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}

