<?php

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;

Route::get('/login', [AuthController::class, 'getLoginPage'])->middleware(RedirectIfAuthenticated::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/inventory', [InventoryController::class, 'inventory'])->middleware(EnsureTokenIsValid::class);
