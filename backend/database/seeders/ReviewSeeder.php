<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Game;
use Illuminate\Support\Facades\Hash;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios de prueba
        $users = [];
        $nombres = ['AlexGamer', 'MartaPlayer', 'Iker_Dev', 'SaraZelda', 'GamerPro99'];
        
        foreach ($nombres as $nombre) {
            $users[] = User::firstOrCreate(
                ['email' => strtolower($nombre) . '@test.com'],
                ['name' => $nombre, 'password' => Hash::make('123')]
            );
        }

        // Datos de las reseñas para los juegos de la lista
        $datos = [
            ['juego' => 'The Legend of Zelda: Breath of the Wild', 't' => 'Obra maestra', 'c' => 'No puedo dejar de jugar, la libertad es total.', 'e' => 5],
            ['juego' => 'God of War Ragnarok', 't' => 'Visualmente increíble', 'c' => 'Los gráficos son de otra generación.', 'e' => 5],
            ['juego' => 'Elden Ring', 't' => 'Un poco difícil', 'c' => 'Me ha costado mucho pasar el primer boss.', 'e' => 4],
            ['juego' => 'Cyberpunk 2077', 't' => 'Historia profunda', 'c' => 'Hacía tiempo que no disfrutaba tanto de una ciudad futurista.', 'e' => 4],
            ['juego' => 'Final Fantasy VII Remake', 't' => 'Mejorable', 'c' => 'Tiene algunos bugs visuales, pero el combate es top.', 'e' => 4],
            ['juego' => 'Super Mario Odyssey', 't' => 'Pura diversión', 'c' => 'Nintendo nunca falla con las plataformas.', 'e' => 5],
            ['juego' => 'Red Dead Redemption 2', 't' => 'Inmersión total', 'c' => 'Sientes que realmente estás en el oeste.', 'e' => 5],
            ['juego' => 'Resident Evil 4 Remake', 't' => 'Terror del bueno', 'c' => 'Fiel al original y mucho más intenso.', 'e' => 5],
            ['juego' => 'Baldur\'s Gate 3', 't' => 'El mejor RPG', 'c' => 'Las decisiones de verdad importan aquí.', 'e' => 5],
            ['juego' => 'Ghost of Tsushima', 't' => 'Arte en movimiento', 'c' => 'Cada captura de pantalla parece un cuadro.', 'e' => 5],
        ];

        foreach ($datos as $index => $d) {
            $game = Game::where('name', $d['juego'])->first();

            if ($game) {
                Review::updateOrCreate(
                    ['title' => $d['t']],
                    [
                        'user_id' => $users[$index % 5]->id,
                        'game_id' => $game->id,
                        'contenido' => $d['c'],
                        'evaluation' => $d['e']
                    ]
                );
            }
        }
    }
}