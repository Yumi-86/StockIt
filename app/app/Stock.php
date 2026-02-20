<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id', 'shop_id', 'quantity', 
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function scopeByShop($query, $shopId) {
        return $query->where('shop_id', $shopId);
    }

    public function totalWeight() :int
    {
        return $this->product->weight * $this->quantity;
    }
}
