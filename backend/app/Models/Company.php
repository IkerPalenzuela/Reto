<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'nif',
        'location',
    ];

    // Una compañia tiene muchos juegos (1:N)
    public function games() {
        return $this->hasMany(Game::class);
    }
}
