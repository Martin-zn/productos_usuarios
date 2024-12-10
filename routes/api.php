<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;


Route::apiResource('productos', ProductoController::class);

Route::post('/register', [AuthController::class, 'register']);


Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
