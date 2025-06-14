<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;

Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/inventory', [InventoryController::class, 'inventory'])->middleware('auth');
Route::post('/inventory/products/add', [InventoryController::class, 'addProduct'])->name('products.add');
