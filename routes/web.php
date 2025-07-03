<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StorageController;

Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/inventory', [InventoryController::class, 'inventory'])->middleware('auth');
Route::post('/inventory/products/add', [InventoryController::class, 'addProduct'])->name('products.add');
Route::get('/images/{filename}', [StorageController::class, 'show'])->middleware('auth')->name('products.image');
Route::delete('/inventory/products/{product}', [InventoryController::class, 'destroy'])->name('products.destroy');
Route::get('/inventory/products/{id}', [InventoryController::class, 'fetchCurrentProductDetails'])->middleware('auth');
Route::patch('/inventory/products', [InventoryController::class, 'update'])->name('products.edit')->middleware('auth');
