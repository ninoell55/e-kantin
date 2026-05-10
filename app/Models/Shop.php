<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'banner_path',
        'qr_image_path',
        'payment_info',
        'is_open',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bills()
    {
        return $this->hasMany(ShopBill::class);
    }

    public function currentBill()
    {
        // Mengambil satu tagihan terbaru
        return $this->hasOne(ShopBill::class)->latestOfMany();
    }
}
