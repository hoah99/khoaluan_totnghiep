<?php

namespace App\Modules\YeuCau\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCau extends Model
{
    use HasFactory;

    public $table="yeu_cau";
    public $fillable = [
        'NoiDung','TieuDe','DinhKem','HanNgay','IDDuAn', 'IDCanBo'
    ];
}
