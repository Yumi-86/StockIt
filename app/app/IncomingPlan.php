<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingPlan extends Model
{
    protected $fillable = [
        'product_id', 'shop_id', 'quantity', 'arriving_date', 'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
