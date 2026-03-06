<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name', 'code', 'region_id','phone', 'postal_code', 'prefecture', 'city', 'address_line1', 'address_line2', 'is_active'];

    public function region() {
        return $this->belongsTo(Region::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function incomingPlans() {
        return $this->hasMany(IncomingPlan::class);
    }

    public function getStatusNameAttribute()
    {
        return $this->is_active ? '有効' : '無効';
    }

    public function getDisplayShopCodeAttribute()
    {
        $regionCode = $this->region->code;
        $shopCode = str_pad($this->code, 5, '0', STR_PAD_LEFT);
        return $regionCode . '-' . $shopCode;
    }

    public function scopeByShop($query,$shopId) {
        return $query->where('shop_id', $shopId);
    }

    public function scopeCodeSearch($query, $code)
    {
        if(empty($code)){
            return $query;
        }

        $code = trim($code);

        if(str_contains($code, '-')) {
            [$regionCode, $shopCode] = array_pad(explode('-', $code, 2), 2, null);

            $shopCode = ltrim($shopCode, '0');
            $regionId = Region::where('code', $regionCode)->value('id');

            if($regionId && $shopCode){
                return $query->where('region_id', $regionId)
                    ->where('code', $shopCode);
            }
            return $query->whereRaw('1=0');
        }
    }

    public function scopeKeywordSearch($query, $keyword) {
        if($keyword == null || $keyword == '') {
            return $query;
        }

        $keywords = preg_split('/[\s　]+/', trim($keyword));

        return $query->where(function ($query) use ($keywords) {
            foreach ($keywords as $word) {
                $query->where('name', 'like', "%{$word}%")
                    ->orWhere('phone', 'like', "%{$word}%")
                    ->orWhere('postal_code', 'like', "%{$word}%")
                    ->orWhere('prefecture', 'like', "%{$word}%")
                    ->orWhere('city', 'like', "%{$word}%")
                    ->orWhere('address_line1', 'like', "%{$word}%")
                    ->orWhere('address_line2', 'like', "%{$word}%")

                    ->orWhereRaw(
                        "CONCAT(prefecture, city, address_line1, address_line2) LIKE ?",
                        ["%{$word}%"]
                    );
            }
        });

    }

    public function scopeStatusSearch($query, $is_active)
    {
        if($is_active !== null && $is_active !== '') {
            return $query->where('is_active', $is_active);
        }
    }
}
