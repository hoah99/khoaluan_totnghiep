<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Modules\CongViec\Controllers\CongViecController;
use App\Modules\CongViec\Models\CongViec;

Route::resource('congviec', CongViecController::class);

