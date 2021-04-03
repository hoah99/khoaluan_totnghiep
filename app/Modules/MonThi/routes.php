<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MonThi\Controllers\MonThiController;
use App\Modules\MonThi\Models\MonThi;

Route::resource('monthi', MonThiController::class);

