<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

// Route::get()

Route::apiResource('productos', ProductoController::class);
