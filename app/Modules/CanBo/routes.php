<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CanBo\Controllers\CanBoController;
use App\Modules\CanBo\Models\CanBo;
use App\Modules\DonVi\Controllers\DonViController;
use App\Modules\DonVi\Models\DonVi;


Route::resource('canbo', CanBoController::class);
