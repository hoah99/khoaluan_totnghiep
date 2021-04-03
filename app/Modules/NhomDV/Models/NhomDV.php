<?php

namespace App\Modules\NhomDV\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhomDV extends Model
{
    use HasFactory;

    public $table="nhom_dv";
    protected $fillable=[
        'TenNhom'
    ];
}
