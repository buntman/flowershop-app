<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/login', [AuthController::class, 'getLoginPage'])->middleware('guest:admin');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/inventory', [InventoryController::class, 'inventory'])
    ->middleware('auth:admin')->name('inventory');
Route::post('/inventory/products/add', [InventoryController::class, 'add'])
    ->middleware('auth:admin')->name('products.add');
Route::get('/images/{filename}', [StorageController::class, 'show'])
    ->name('products.image');
Route::delete('/inventory/products/{product}', [InventoryController::class, 'destroy'])
    ->middleware('auth:admin')->name('products.destroy');
Route::get('/inventory/products/{id}', [InventoryController::class, 'get'])
    ->middleware('auth:admin');
Route::patch('/inventory/products', [InventoryController::class, 'update'])
    ->middleware('auth:admin')->name('products.edit');
Route::get('/dashboard', [DashboardController::class, 'getDashboard'])
    ->middleware('auth:admin');
Route::patch('/dashboard/pending/{id}', [DashboardController::class, 'markOrderItemAsCompleted'])
    ->middleware('auth:admin')->name('item.update');
