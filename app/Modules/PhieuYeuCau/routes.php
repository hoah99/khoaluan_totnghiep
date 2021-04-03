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
use App\Modules\PhieuYeuCau\Controllers\PhieuYeuCauController;
use App\Modules\PhieuYeuCau\Models\PhieuYeuCau;

Route::resource('phieuyeucau', PhieuYeuCauController::class);