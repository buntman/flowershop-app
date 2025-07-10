<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\StorageController;

Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->middleware('guest:admin');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/inventory', [InventoryController::class, 'inventory'])
    ->middleware('auth:admin');
Route::post('/inventory/products/add', [InventoryController::class, 'addProduct'])
    ->middleware('auth:admin')->name('products.add');
Route::get('/images/{filename}', [StorageController::class, 'show'])
    ->middleware('auth:admin')->name('products.image');
Route::delete('/inventory/products/{product}', [InventoryController::class, 'destroy'])
    ->middleware('auth:admin')->name('products.destroy');
Route::get('/inventory/products/{id}', [InventoryController::class, 'fetchCurrentProductDetails'])
    ->middleware('auth:admin');
Route::patch('/inventory/products', [InventoryController::class, 'update'])
    ->middleware('auth:admin')->name('products.edit');
