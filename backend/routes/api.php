<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

// Reseñas
Route::get('/reviews', [ReviewController::class, 'index']);