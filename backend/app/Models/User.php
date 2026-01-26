<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un usuario tiene un prefil (1:1)
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    // Relacion 1:N  User --> Reviews
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // Relacion N:M Favoritos (User <--> Game)
    public function favorites() {
        return $this->belongsToMany(Game::class, 'favorites')
                    ->withPivot('position')
                    ->withTimestamps();
    }
}
