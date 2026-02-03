<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = 
    [
        'user_id', 
        'game_id', 
        'position'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con Game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}