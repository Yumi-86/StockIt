<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'product_id',
        'shop_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function scopeByShop($query, $shopId)
    {
        return $query->where('shop_id', $shopId);
    }

    public function totalWeight(): int
    {
        return $this->product->weight * $this->quantity;
    }

    public function scopeCodeSearch($query, $code)
    {
        if (empty($code)) {
            return $query;
        }

        $code = trim($code);

        if (str_contains($code, '-')) {
            [$prefix, $code] = array_pad(explode('-', $code, 2), 2, null);

            if (!$prefix || !$code) {
                return $query->whereRaw('1=0');
            }

            $code = ltrim($code, '0');

            return $query->whereHas('product', function ($q) use ($prefix, $code) {
                $q->where('code_prefix', $prefix)
                    ->where('code', $code);
            });
        }

        return $query->whereRaw('1=0');
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $like = "%{$keyword}%";

            $query->where(function ($q) use ($like) {
                $q->where('products.name', 'like', $like)
                    ->orWhere('categories.name', 'like', $like);

                if (auth()->user()->isAdmin()) {
                    $q->orWhere('shops.name', 'like', $like);
                }
            });
        }
        return $query;
    }

    public function scopeCategorySearch($query, $categoryId)
    {
        if (!empty($categoryId)) {
            $query->whereHas('product', function ($p) use ($categoryId) {
                $p->where('category_id', $categoryId);
            });
        }

        return $query;
    }

    public function getDisplayProductCodeAttribute()
    {
        return $this->product->code_prefix . '-' . str_pad($this->product->code, 5, '0', STR_PAD_LEFT);
    }

    public function scopeSorted($query, $sort)
    {
        switch ($sort) {
            case 'newest':
                return $query->orderBy('stocks.created_at', 'desc');
                break;

            case 'oldest':
                return $query->orderBy('stocks.created_at', 'asc');
                break;
            case 'title_asc':
                return $query->orderBy('products.name', 'asc');
                break;
            case 'title_desc':
                return $query->orderBy('products.name', 'desc');
                break;

            default:
                $query->orderBy('stocks.updated_at', 'desc');
        }
        return $query;
    }
}
