<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Company;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Compañía (necesaria para evitar el error de company_id)
        $company = Company::firstOrCreate(
            ['name' => 'Steam Publisher'], 
            ['nif' => 'A12345678', 'location' => 'Global']
        );

        // 2. Juegos con enlaces a IMÁGENES DE INTERNET
        $juegos = [
            [
                'name' => 'Elden Ring', 
                'description' => 'RPG de acción en un mundo de fantasía oscura.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1245620/header.jpg' 
            ],
            [
                'name' => 'Cyberpunk 2077', 
                'description' => 'Aventura de acción en el mundo abierto de Night City.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1091500/header.jpg'
            ],
            [
                'name' => 'Red Dead Redemption 2', 
                'description' => 'La vida en América en el umbral de la era moderna.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1174180/header.jpg'
            ],
            [
                'name' => 'Black Myth: Wukong', 
                'description' => 'RPG de acción basado en la mitología china.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/2358720/header.jpg'
            ],
            [
                'name' => 'God of War', 
                'description' => 'Kratos se enfrenta a los dioses nórdicos.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1593500/header.jpg'
            ],
            [
                'name' => 'Baldurs Gate 3', 
                'description' => 'RPG basado en el universo de Dungeons & Dragons.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1086940/header.jpg'
            ],
            [
                'name' => 'Spider-Man Remastered', 
                'description' => 'Aventura de acción con el superhéroe de Marvel.',
                'img' => 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/1817070/header.jpg'
            ],
        ];

        // 3. Crear los juegos
        foreach ($juegos as $juegoData) {
            $juegoData['company_id'] = $company->id;
            Game::create($juegoData);
        }
    }
}