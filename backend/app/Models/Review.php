<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'title',
        'contenido',
        'evaluation',
    ];

    // Una reseña pertenece a un usuario (1:N)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Una reseña pertenece a un juego (1:N)
    public function game() {
        return $this->belongsTo(Game::class);
    }
}
