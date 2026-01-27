<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Company;
use App\Models\Platform;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Plataformas
        $pc = Platform::firstOrCreate(['name' => 'PC']);
        $ps5 = Platform::firstOrCreate(['name' => 'PlayStation 5']);
        $switch = Platform::firstOrCreate(['name' => 'Nintendo Switch']);
        $xbox = Platform::firstOrCreate(['name' => 'Xbox Series X']);

        // 2. Empresas
        $nintendo = Company::firstOrCreate(['name' => 'Nintendo'], ['nif' => 'N111', 'location' => 'Japón']);
        $sony = Company::firstOrCreate(['name' => 'Sony Interactive'], ['nif' => 'S222', 'location' => 'USA']);
        $rockstar = Company::firstOrCreate(['name' => 'Rockstar Games'], ['nif' => 'R555', 'location' => 'USA']);
        $ubisoft = Company::firstOrCreate(['name' => 'Ubisoft'], ['nif' => 'U444', 'location' => 'Francia']);
        $capcom = Company::firstOrCreate(['name' => 'Capcom'], ['nif' => 'C777', 'location' => 'Japón']);
        $squareEnix = Company::firstOrCreate(['name' => 'Square Enix'], ['nif' => 'SE88', 'location' => 'Japón']);
        $fromSoftware = Company::firstOrCreate(['name' => 'FromSoftware'], ['nif' => 'F999', 'location' => 'Japón']);

        // 3. Listado con 50 juegos y sus PORTADAS REALES
        $videojuegos = [
            // Nintendo
            ['nombre' => 'The Legend of Zelda: Breath of the Wild', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://i.pinimg.com/236x/3f/03/95/3f039584aa99d1bbaef6495e9fb9d119.jpg'],
            ['nombre' => 'The Legend of Zelda: Tears of the Kingdom', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/f/fb/The_Legend_of_Zelda_Tears_of_the_Kingdom_cover.jpg/250px-The_Legend_of_Zelda_Tears_of_the_Kingdom_cover.jpg'],
            ['nombre' => 'Super Mario Odyssey', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/91SF0Tzmv4L.jpg'],
            ['nombre' => 'Mario Kart 8 Deluxe', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/71jZAGKRAQL.jpg'],
            ['nombre' => 'Animal Crossing: New Horizons', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/81s8etnYPrL.jpg'],
            ['nombre' => 'Metroid Dread', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://http2.mlstatic.com/D_NQ_NP_851733-MLM81015225910_122024-O.webp'],
            ['nombre' => 'Splatoon 3', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/81dRB41yHrL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Luigi\'s Mansion 3', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/81EARkR39ZL.jpg'],
            ['nombre' => 'Pikmin 4', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/81go5WSOI0L.jpg'],
            ['nombre' => 'Super Smash Bros Ultimate', 'empresa' => $nintendo, 'plataformas' => [$switch->id], 'url' => 'https://m.media-amazon.com/images/I/715OVTqaTyL.jpg'],

            // Sony
            ['nombre' => 'God of War Ragnarok', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://m.media-amazon.com/images/I/81Pagnfx1DL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Horizon Forbidden West', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://cdn.grupoelcorteingles.es/SGFM/dctm/MEDIA03/202205/25/00197581502156____14__1200x1200.jpg?impolicy=Resize&width=1200&height=1200'],
            ['nombre' => 'Ghost of Tsushima', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://img.pccomponentes.com/articles/47/477772/1449-ghost-of-tsushima-directors-cut-ps5-review.jpg'],
            ['nombre' => 'Ratchet & Clank: Rift Apart', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://cdn.grupoelcorteingles.es/SGFM/dctm/MEDIA03/202205/25/00197581501307____11__1200x1200.jpg?impolicy=Resize&width=1200&height=1200'],
            ['nombre' => 'The Last of Us Part II', 'empresa' => $sony, 'plataformas' => [$ps5->id], 'url' => 'https://canarias.worten.es/i/bb60f96532b896490946241242acde80817f7fde'],
            ['nombre' => 'Spider-Man 2', 'empresa' => $sony, 'plataformas' => [$ps5->id], 'url' => 'https://m.media-amazon.com/images/I/91r6o+jL4FL.jpg'],
            ['nombre' => 'Bloodborne', 'empresa' => $sony, 'plataformas' => [$ps5->id], 'url' => 'https://m.media-amazon.com/images/I/81S5V49zZFL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Returnal', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://m.media-amazon.com/images/I/91LdJ3rob+L.jpg'],
            ['nombre' => 'Gran Turismo 7', 'empresa' => $sony, 'plataformas' => [$ps5->id], 'url' => 'https://m.media-amazon.com/images/I/81zKmfAPBmL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Days Gone', 'empresa' => $sony, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://m.media-amazon.com/images/I/91JAyQ8RLCL._AC_UF894,1000_QL80_.jpg'],

            // Rockstar
            ['nombre' => 'Red Dead Redemption 2', 'empresa' => $rockstar, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81GbRS6qEoL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Grand Theft Auto V', 'empresa' => $rockstar, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://media.game.es/COVERV2/3D_L/149/149298.png'],
            ['nombre' => 'L.A. Noire', 'empresa' => $rockstar, 'plataformas' => [$pc->id, $ps5->id, $xbox->id, $switch->id], 'url' => 'https://m.media-amazon.com/images/I/91Dewf6KS2L._AC_UF894,1000_QL80_.jpg'],
            
            // From Software
            ['nombre' => 'Elden Ring', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/M/MV5BMWNlMDBiYzYtMWMyMC00Zjc5LTlhMjItMjRlMzBmYmVkOGM0XkEyXkFqcGc@._V1_QL75_UY281_CR4,0,190,281_.jpg'],
            ['nombre' => 'Sekiro: Shadows Die Twice', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/713dRDPrThL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Dark Souls III', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81kHY1Irw0L._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Armored Core VI', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/71r0uLwyDPL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Dark Souls Remastered', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id, $switch->id], 'url' => 'https://images.g2a.com/470x276/1x1x0/dark-souls-remastered-nintendo-switch-nintendo-eshop-account-global-i10000155592020/9131f2cbc71143178a3fc8e1'],

            // Ubisoft
            ['nombre' => 'Assassin\'s Creed Valhalla', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTezMune-7Of2DRML-whguQyxWXwJ9uvgIk8Q&s'],
            ['nombre' => 'Far Cry 6', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://ir.ozone.ru/s3/multimedia-7/c1000/6264111667.jpg'],
            ['nombre' => 'Rainbow Six Siege', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/71tgPEj5afL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Watch Dogs: Legion', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/818MH3Fo7IL.jpg'],
            ['nombre' => 'Rayman Legends', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $xbox->id, $switch->id], 'url' => 'https://m.media-amazon.com/images/I/71Npem0ubhL._AC_UF1000,1000_QL80_.jpg'],
            ['nombre' => 'The Division 2', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81jrhi4zkaL.jpg'],
            ['nombre' => 'Prince of Persia: The Lost Crown', 'empresa' => $ubisoft, 'plataformas' => [$pc->id, $ps5->id, $switch->id], 'url' => 'https://media.game.es/COVERV2/3D_L/219/219367.png'],

            // Capcom
            ['nombre' => 'Resident Evil Village', 'empresa' => $capcom, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81nE+UW29OL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Monster Hunter World', 'empresa' => $capcom, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81i32e9KwaL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Street Fighter 6', 'empresa' => $capcom, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81lBSgYg9wL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Devil May Cry 5', 'empresa' => $capcom, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81mv9u9Ue9L._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Resident Evil 4 Remake', 'empresa' => $capcom, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/71+uL-h6xML._AC_UF894,1000_QL80_.jpg'],

            // Square Enix
            ['nombre' => 'Final Fantasy VII Remake', 'empresa' => $squareEnix, 'plataformas' => [$pc->id, $ps5->id], 'url' => 'hhttps://m.media-amazon.com/images/I/81W8CAno24L._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Kingdom Hearts III', 'empresa' => $squareEnix, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81YnlBNpddL.jpg'],
            ['nombre' => 'NieR: Automata', 'empresa' => $squareEnix, 'plataformas' => [$pc->id, $ps5->id, $xbox->id, $switch->id], 'url' => 'https://m.media-amazon.com/images/I/81VQgV-81UL._AC_UF894,1000_QL80_.jpg'],
            ['nombre' => 'Dragon Quest XI', 'empresa' => $squareEnix, 'plataformas' => [$pc->id, $ps5->id, $xbox->id, $switch->id], 'url' => 'https://images-eu.ssl-images-amazon.com/images/I/91KzMhN-e2L._AC_UL600_SR600,600_.jpg'],
            ['nombre' => 'Final Fantasy XVI', 'empresa' => $squareEnix, 'plataformas' => [$ps5->id, $pc->id], 'url' => 'https://m.media-amazon.com/images/I/81XfMCeJYJL.jpg'],
            ['nombre' => 'Chrono Trigger', 'empresa' => $squareEnix, 'plataformas' => [$pc->id], 'url' => 'https://m.media-amazon.com/images/I/811Fbht0DLL.png'],

            // Otros
            ['nombre' => 'Cyberpunk 2077', 'empresa' => $sony, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://m.media-amazon.com/images/I/81zzIcCKjgL.jpg'],
            ['nombre' => 'Baldur\'s Gate 3', 'empresa' => $fromSoftware, 'plataformas' => [$pc->id, $ps5->id, $xbox->id], 'url' => 'https://i0.wp.com/www.alldigitales.com/wp-content/uploads/2023/07/Baldurs-Gate-3-.png?fit=800%2C999&ssl=1'],
        ];

        // 4. Inserción o actualización
        foreach ($videojuegos as $datos) {
            $juego = Game::updateOrCreate(
                ['name' => $datos['nombre']],
                [
                    'company_id' => $datos['empresa']->id,
                    'description' => 'Un título destacado de ' . $datos['empresa']->name . '.',
                    'img' => $datos['url'] // Usamos la URL 
                ]
            );

            $juego->platforms()->sync($datos['plataformas']);
        }
    }
}