<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopBill extends Model
{
    protected $fillable = [
        'shop_id',
        'amount',
        'month',
        'year',
        'due_date',
        'payment_method',
        'status',
        'payment_proof',
        'paid_at',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
