<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', [HomeController::class, 'getNewBouquets'])->middleware('auth:sanctum');
Route::get('/gallery', [GalleryController::class, 'getBouquets'])->middleware('auth:sanctum');
Route::post('/cart/items', [CartController::class, 'add'])->middleware('auth:sanctum');
Route::get('/cart/items', [CartController::class, 'getCartItems'])->middleware('auth:sanctum');
Route::get('/cart/total', [CartController::class, 'getCartTotal'])->middleware('auth:sanctum');
Route::delete('/cart/items/{id}', [CartController::class, 'deleteItem'])->middleware('auth:sanctum');
Route::patch('/cart/items/{id}', [CartController::class, 'updateItemQuantity'])->middleware('auth:sanctum');
Route::patch('/cart/{id}', [CartController::class, 'updateCartStatus']);
Route::get('/profile', [ProfileController::class, 'getUser'])->middleware('auth:sanctum');
Route::patch('/profile', [ProfileController:: class , 'updateProfile'])->middleware('auth:sanctum');
Route::get('/cart/items/checkout', [CartController::class, 'getItemsForCheckout'])->middleware('auth:sanctum');
Route::post('/order', [OrderController::class, 'createOrder'])->middleware('auth:sanctum');
Route::get('/order/{status}', [OrderController::class, 'getOrderDetails'])->middleware('auth:sanctum');
Route::patch('/order/{id}', [OrderController::class, 'markOrderAsComplete'])->middleware('auth:sanctum');
