<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CompanyController;
use App\Models\Game;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. REDIRECCIÓN PÚBLICA
Route::get('/', function () {
    return redirect('/index.html');
});

// 2. ACCESIBILIDAD
Route::view('/accesibilidad', 'accesibilidad');
// 3. ZONA PRIVADA (Middleware Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    // Vistas
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', ['user' => auth()->user()]);
    })->name('dashboard');
    
    // Listado de Empresas
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

    // Listado de Juegos
    Route::get('/games', [GameController::class, 'index'])->name('games');
    
    // Gestión de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // REVIEWS (Formulario y Guardado)
    Route::get('/reviews', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        
    // OFERTAS (API externa)
    Route::get('/offers', function () {
        return view('offer', ['user' => auth()->user()]);
    })->name('offers');

    // Favoritos
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
});

// 4. LOGOUT
Route::post('/logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/index.html');
})->name('logout');

// 4. Rutas solo para admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';