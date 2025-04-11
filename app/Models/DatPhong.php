<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatPhong extends Model
{
    protected $table = 'dat_phong';

    protected $fillable = [
        'ma_phong', 'ngay_den', 'ngay_di', 'so_luong_khach', 'ma_nguoi_dat'
    ];

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'ma_phong');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_nguoi_dat');
    }
}
