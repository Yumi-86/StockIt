<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingPlan extends Model
{
    protected $fillable = [
        'product_id', 'shop_id', 'quantity', 'arriving_date', 'status',
    ];

    const STATUS_NOT_ARRIVED = 0;
    const STATUS_ARRIVED = 1;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function scopeByShop($query, $shopId) {
        return $query->where('shop_id', $shopId);
    }

    public function scopeNotArrived($query)
    {
        return $query->where('status', self::STATUS_NOT_ARRIVED);
    }

    public function totalWeight() :int
    {
        return $this->product->weight * $this->quantity;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $like = "%{$keyword}%";

            $query->whereHas('product', function($p) use ($like) {
                $p->where('name', 'like', $like)
                    ->orWhere('code', 'like', $like)
                    ->orWhereHas('category', function ($c) use ($like) {
                        $c->where('name', 'like', $like);
                    });
            });
        }
        return $query;
    }

    public function scopeCategorySearch($query, $categoryId)
    {
        if(!empty($categoryId)) {
            $query->whereHas('product', function ($p) use ($categoryId) {
                $p->where('category_id', $categoryId);
            });
        }

        return $query;
    }

    public function scopeDateSearch($query, $date)
    {
        if($date !== null && $date !== '') {
            $query->where('arriving_date', $date);
        }
        return $query;
    }

    public function getDisplayProductCodeAttribute()
    {
        return $this->product->code_prefix . '-' . str_pad($this->product->code, 5, '0', STR_PAD_LEFT);
    }
}
