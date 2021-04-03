<?php

namespace App\Modules\PhieuYeuCau\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuYeuCau extends Model
{
    use HasFactory;

    public $table="yeu_cau";
    
    protected $fillable=[
        'NoiDung','TieuDe','DinhKem','NgayTao', 'HanNgay','TrangThai', 'IDDuAn','IDCanBo'
    ];
}
