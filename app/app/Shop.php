<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'code', 'is_active'];
    
    public function users() {
        return $this->hasMany(User::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function incomingPlans() {
        return $this->hasMany(IncomingPlan::class);
    }
}
