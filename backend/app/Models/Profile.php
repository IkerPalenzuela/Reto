<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactroy;
    
    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'phone',
    ];

    // Un perfil pertenece a un usuario (1:1)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
