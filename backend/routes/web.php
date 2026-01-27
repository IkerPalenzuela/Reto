<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirección inicial a la Landing Page
Route::get('/', function () {
    return redirect('/index.html');
});

// --- ZONA PRIVADA (Middleware Auth) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Principal
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // 2. Catálogo de Videojuegos
    Route::view('/videojuegos', 'videojuegos')->name('videojuegos');

    // 3. Perfil
    Route::view('/perfil', 'perfil')->name('perfil');
    
    // 4. CRUD Reseñas
    Route::resource('reviews', ReviewController::class);

    // 5. Lógica interna de actualización de usuario (Nombre, Email, Password)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// LOGOUT 
// Cierra sesión y redirige al index.html público
Route::post('/api/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->away('/index.html');
})->name('logout');

require __DIR__.'/auth.php';