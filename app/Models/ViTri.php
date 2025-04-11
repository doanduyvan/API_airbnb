<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViTri extends Model
{
    protected $table = 'vi_tri';

    protected $fillable = [
        'ten_vi_tri', 'hinh_anh', 'tinh_thanh', 'quoc_gia'
    ];

    public function phong()
    {
        return $this->hasMany(Phong::class, 'vi_tri_id');
    }
}
