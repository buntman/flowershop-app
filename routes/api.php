<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', [HomeController::class, 'getRecentlyAddedBouquets'])->middleware('auth:sanctum');
Route::get('/gallery', [GalleryController::class, 'fetchBouquets'])->middleware('auth:sanctum');
Route::post('/cart', [CartController::class, 'addToCart'])->middleware('auth:sanctum');
Route::get('/cart', [CartController::class, 'fetchItemsInCart'])->middleware('auth:sanctum');
Route::get('/cart/total', [CartController::class, 'calculateTotalPrice'])->middleware('auth:sanctum');
Route::delete('/cart/{id}', [CartController::class, 'deleteItem'])->middleware('auth:sanctum');
Route::patch('/cart/{id}', [CartController::class, 'updateItemQuantity'])->middleware('auth:sanctum');
Route::get('/profile', [ProfileController::class, 'fetchUserDetails'])->middleware('auth:sanctum');
Route::patch('/profile', [ProfileController:: class , 'updateUserDetails'])->middleware('auth:sanctum');
