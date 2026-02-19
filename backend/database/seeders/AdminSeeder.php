<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos el usuario administrador
        $admin = User::updateOrCreate(
            ['email' => 'admin@gamereviews.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        Profile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'surname' => 'Sistema',
            ]
        );
    }
}