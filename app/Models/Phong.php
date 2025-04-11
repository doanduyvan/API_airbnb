<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = 'phong';

    protected $fillable = [
        'ten_phong', 'khach', 'phong_ngu', 'giuong', 'phong_tam',
        'mo_ta', 'gia_tien', 'may_giat', 'ban_ui', 'tivi', 'dieu_hoa',
        'wifi', 'bep', 'do_xe', 'ho_boi', 'hinh_anh', 'vi_tri_id'
    ];

    public function viTri()
    {
        return $this->belongsTo(ViTri::class, 'vi_tri_id');
    }

    public function datPhong()
    {
        return $this->hasMany(DatPhong::class, 'ma_phong');
    }

    public function binhLuan()
    {
        return $this->hasMany(BinhLuan::class, 'ma_phong');
    }
}
