<?php

namespace App\Modules\CongViec\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongViec extends Model
{
    use HasFactory;

    public $table="cong_viec";

    protected $fillable = [
        'TenCV'
    ];
}
