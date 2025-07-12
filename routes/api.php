<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', [HomeController::class, 'getRecentlyAddedBouquets']);
Route::get('/gallery', [GalleryController::class, 'fetchBouquets']);
