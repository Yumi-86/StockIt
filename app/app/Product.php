<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'sku', 'category_id', 'name', 'weight', 'image_path', 'is_active'
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
}
