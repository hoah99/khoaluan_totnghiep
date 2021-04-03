
<?php

use Illuminate\Support\Facades\Route;
use App\Modules\DonVi\Controllers\DonViController;
use App\Modules\DonVi\Models\DonVi;


Route::resource('donvi', DonViController::class);







