<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', [HomeController::class, 'getRecentlyAddedBouquets'])->middleware('auth:sanctum');
Route::get('/gallery', [GalleryController::class, 'fetchBouquets'])->middleware('auth:sanctum');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->middleware('auth:sanctum');
