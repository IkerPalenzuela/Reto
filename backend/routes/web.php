<?php

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
    Route::view('/perfil', 'perfil')->name('perfil');

    // Controlador de Juegos
    Route::get('/videojuegos', [GameController::class, 'index'])->name('videojuegos');

    // Gestión de Perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // RESEÑAS (Formulario y Guardado)
    Route::get('/reseñas', function () {
        $videojuegos = Game::all(); 
        return view('reseñas', compact('videojuegos'));
    })->name('reseñas.crear');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// 3. LOGOUT
Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/index.html');
})->name('logout');

require __DIR__.'/auth.php';