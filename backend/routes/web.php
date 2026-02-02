<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GameController;
use App\Models\Game;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. REDIRECCIÓN PÚBLICA
Route::get('/', function () {
    return redirect('/index.html');
});

// 2. ZONA PRIVADA (Middleware Auth)
Route::middleware(['auth', 'verified'])->group(function () {

    // Vistas
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Controlador de Juegos
    Route::get('/games', [GameController::class, 'index'])->name('games');

    // Gestión de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // REVIEWS (Formulario y Guardado)
    Route::get('/reviews', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// 3. LOGOUT
Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/index.html');
})->name('logout');

// 4. API externa
Route::get('/offers', function (){
    return view('offer');
});

require __DIR__.'/auth.php';