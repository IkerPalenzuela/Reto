<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Asegúrate de importar esto
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'user_id',
        'surname',
        'phone',
    ];

    // Un perfil pertenece a un usuario (1:1)
    public function user() {
        return $this->belongsTo(User::class);
    }
}