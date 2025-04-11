<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = 'binh_luan';

    protected $fillable = [
        'ma_phong', 'ma_nguoi_binh_luan', 'ngay_binh_luan', 'noi_dung', 'sao_binh_luan'
    ];

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'ma_phong');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'ma_nguoi_binh_luan');
    }
}
