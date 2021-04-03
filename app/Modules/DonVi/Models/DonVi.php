<?php

namespace App\Modules\DonVi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\CanBo\Models\CanBo;

class DonVi extends Model
{
    use HasFactory;

    protected $fillable = ['TenDV'];

    public $table="don_vi";


    
    
}
