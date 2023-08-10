<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\RolControlador;

Route::get('', [HomeController::class, 'index']);

