<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;

Route::get('/login', [AuthController::class, 'login']);
Route::get('/inventory', [InventoryController::class, 'inventory']);
