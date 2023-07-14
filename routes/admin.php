<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;


Route::get('principal', [HomeController::class, 'index']);

Route::get('cobro', [HomeController::class, 'cobro']);


    