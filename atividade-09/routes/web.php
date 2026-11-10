<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Página única: entrega o HTML que carrega o React
Route::view('/', 'app');

// Rotas chamadas pelo React (respondem em JSON)
Route::get('/usuario', [AuthController::class, 'usuario']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/logout', [AuthController::class, 'logout']);
