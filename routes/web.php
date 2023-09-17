<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');

//Route securisé

Route::get('dashboard', [AppController::class, 'index'])->name('dashboard');