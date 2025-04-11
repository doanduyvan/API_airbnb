<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NguoiDung extends Authenticatable implements JWTSubject
{
    protected $table = 'nguoi_dung';

    protected $fillable = [
        'name', 'email', 'password', 'refresh_token',
        'phone', 'birth_day', 'gender', 'role'
    ];

    protected $hidden = [
        'password', 'refresh_token'
    ];

    public $timestamps = false;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function datPhong()
    {
        return $this->hasMany(DatPhong::class, 'ma_nguoi_dat');
    }

    public function binhLuan()
    {
        return $this->hasMany(BinhLuan::class, 'ma_nguoi_binh_luan');
    }
}
