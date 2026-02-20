<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_GENERAL = 1;
    const ROLE_ADMIN = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','shop_id','is_active', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function shop() {
        return $this->belongsTo(Shop::class);
    }

    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function getRoleNameAttribute() {
        return $this->role === self::ROLE_ADMIN ? '管理者' : '一般';
    }

    public function getStatusNameAttribute() {
        return $this->is_active ? '有効' : '無効';
    }

    public function scopeGeneral($query) {
        return $query->where('role', self::ROLE_GENERAL);
    }

    public function scopeByShop($query, $shopId) {
        return $query->where('shop_id', $shopId);
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if($keyword !== null && $keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('email', 'like', "%{$keyword}%")
                    ->orWhere('name', 'like', "%{$keyword}%")
                    ->orWhereHas('shop', function ($s) use ($keyword) {
                        $s->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        return $query;
    }

    public function scopeRoleSearch($query, $role) {
        if($role !== null && $role !== '') {
            $query->where('role', $role);
        }
        return $query;
    }

    public function scopeIsActiveSearch($query, $is_active) {
        if($is_active !== null && $is_active !== '') {
            $query->where('is_active', $is_active);
        }
        return $query;
    }
}
