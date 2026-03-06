<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'code', 'jis_code'];

    public function shops() {
        return $this->hasMany(Shop::class);
    }
}
