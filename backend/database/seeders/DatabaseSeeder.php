<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Administrador (Lo ponemos primero para asegurar que existe)
        $this->call(AdminSeeder::class);

        // 2. Usuarios
        User::factory(10)->create();

        // 3. Juegos
        $this->call(GameSeeder::class);

        // 4. Reseñas
        $this->call(ReviewSeeder::class);
    }
}