<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Game;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Compañías
        $nintendo = Company::firstOrCreate(['name' => 'Nintendo'], ['nif' => 'N111', 'location' => 'Japón']);
        $sony = Company::firstOrCreate(['name' => 'Sony Santa Monica'], ['nif' => 'S222', 'location' => 'USA']);
        $cdprojekt = Company::firstOrCreate(['name' => 'CD Projekt Red'], ['nif' => 'C333', 'location' => 'Polonia']);
        $from = Company::firstOrCreate(['name' => 'FromSoftware'], ['nif' => 'F444', 'location' => 'Japón']);

        // 2. Crear Usuarios (SIN la columna phone)
        $users = [];
        $nombres = ['AlexGamer', 'MartaPlayer', 'Iker_Dev', 'SaraZelda', 'GamerPro99'];
        foreach ($nombres as $nombre) {
            $users[] = User::firstOrCreate(
                ['email' => strtolower($nombre) . '@test.com'],
                ['name' => $nombre, 'password' => Hash::make('123')]
            );
        }

        // 3. Crear Juegos
        $juegos = [
            ['name' => 'Zelda: TotK', 'company' => $nintendo, 'img' => 'img/zelda.jpg'],
            ['name' => 'God of War', 'company' => $sony, 'img' => 'img/GODofWAR.jpg'],
            ['name' => 'Cyberpunk 2077', 'company' => $cdprojekt, 'img' => 'img/Cyberpunk2077.jpg'],
            ['name' => 'Elden Ring', 'company' => $from, 'img' => 'img/ELDEN_RING.jpg'], 
            ['name' => 'Baldurs Gate 3', 'company' => $from, 'img' => 'img/Baldurs_Gate.jpg'],
        ];

        $games = [];
        foreach ($juegos as $j) {
            $games[] = Game::firstOrCreate(
                ['name' => $j['name']],
                ['company_id' => $j['company']->id, 'description' => 'Un juego increíble.', 'img' => $j['img']]
            );
        }

        // 4. Crear Reseñas
        $reseñas = [
            ['title' => 'Obra maestra', 'cont' => 'No puedo dejar de jugar, la libertad es total.', 'eval' => 5],
            ['title' => 'Visualmente increíble', 'cont' => 'Los gráficos son de otra generación.', 'eval' => 5],
            ['title' => 'Un poco difícil', 'cont' => 'Me ha costado mucho pasar el primer boss.', 'eval' => 3],
            ['title' => 'Historia profunda', 'cont' => 'Hacía tiempo que no lloraba con un final.', 'eval' => 4],
            ['title' => 'Mejorable', 'cont' => 'Tiene algunos bugs que rompen la experiencia.', 'eval' => 2],
            ['title' => 'Inmersión total', 'cont' => 'Sientes que realmente estás en ese mundo.', 'eval' => 5],
            ['title' => 'Divertido con amigos', 'cont' => 'El cooperativo es lo mejor del juego.', 'eval' => 4],
            ['title' => 'Decepción', 'cont' => 'Esperaba mucho más después de tanto hype.', 'eval' => 1],
            ['title' => 'El mejor RPG', 'cont' => 'Las decisiones de verdad importan aquí.', 'eval' => 5],
            ['title' => 'Banda sonora 10/10', 'cont' => 'Escucharía la música incluso sin jugar.', 'eval' => 5],
        ];

        foreach ($reseñas as $index => $r) {
            Review::create([
                'user_id' => $users[$index % 5]->id,
                'game_id' => $games[$index % 5]->id,
                'title' => $r['title'],
                'contenido' => $r['cont'],
                'evaluation' => $r['eval']
            ]);
        }
    }
}