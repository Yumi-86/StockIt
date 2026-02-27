<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Exists;

class Product extends Model
{
    protected $fillable = [
        'code','code_prefix', 'category_id', 'name', 'weight', 'image_path', 'is_active'
    ];

    protected $appends = [
        'display_product_code',
        'image_url',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function incomingPlans() {
        return $this->hasMany(IncomingPlan::class);
    }

    public function getStatusNameAttribute() {
        return $this->is_active ? '有効' : '無効';
    }

    public function scopeKeywordSearch($query, $keyword) {
        if($keyword !== null && $keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'like', "%{$keyword}%")
                    ->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhereHas('category', function ($c) use ($keyword) {
                        $c->where('name', 'like', "%{$keyword}%");
                    });
            });
        }
        return $query;
    }

    public function scopeCategorySearch($query, $categoryId) {
        if($categoryId !== null && $categoryId !== '') {
            $query->where('category_id', $categoryId);
        }
        return $query;
    }

    public function scopeStatusSearch($query, $is_active) {
        if($is_active !== null && $is_active !== '') {
            $query->where('is_active', $is_active);
        }
        return $query;
    }

    public function getDisplayProductCodeAttribute()
    {
        return $this->code_prefix . '-' .
        str_pad($this->code, 5, '0', STR_PAD_LEFT);
    }

    public function getImageUrlAttribute()
    {
        if(!$this->exists) {
            return null;
        }
        if($this->image_path && file_exists(public_path('storage/' . $this->image_path))) {
            return asset('storage/' . $this->image_path);
        }

        return asset('images/no-image.png');
    }
}
