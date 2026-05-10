<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    // Fungsi untuk cek apakah tagihan ini sudah melewati jatuh tempo
    public function getIsOverdueAttribute()
    {
        return $this->status === 'unpaid' && Carbon::now()->gt($this->due_date);
    }
}
