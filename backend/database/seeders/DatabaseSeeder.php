<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuarios
        User::factory(10)->create();

        // 2. Juegos
        $this->call(GameSeeder::class);

        // 3. Reseñas
        Review::factory(20)->create();
    }
}