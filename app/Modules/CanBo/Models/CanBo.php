<?php

namespace App\Modules\CanBo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\DonVi\Models\DonVi;
use App\Modules\NhomQuyen\Models\NhomQuyen;

class CanBo extends Model
{
    use HasFactory;

    public $table="can_bo";
    
    protected $fillable=[
        'HoTen','TaiKhoan','MatKhau','Email','IDDonVi','IDNhomQuyen'
    ];
}
