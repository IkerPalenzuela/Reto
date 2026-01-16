<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'img',
    ];

    // Un juego pertenece a una compañia (1:N)
    public function company() {
        return $this->belongsTo(Company::class);
    }

    // Un juego esta en muchas plataformas (N:M)
    public function platforms() {
        return $this->belongsToMany(Platform::class, 'game_platform');
    }

    // Un juego tiene reseñas
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // Relacion inversa de Favoritos
    public function favoritedByUsers() {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withPivot('position')
                    ->withTimestamps();
    }
}
