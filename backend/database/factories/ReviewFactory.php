<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;
use App\Models\User;
use App\Models\Game;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        // Lista de títulos realistas
        $titulos = [
            'Una obra maestra absoluta',
            'Muy divertido pero con fallos',
            'No me ha gustado nada',
            'Los mejores gráficos que he visto',
            'Historia increíble, jugabilidad regular',
            'Totalmente recomendado',
            'Me esperaba mucho más',
            'Un vicio total',
            'Obra de arte',
            'Lleno de bugs'
        ];

        // Lista de opiniones realistas
        $opiniones = [
            'Llevo jugadas más de 50 horas y no me canso. El mundo abierto es inmenso y siempre encuentras algo nuevo que hacer. Vale cada euro que cuesta.',
            'Visualmente es espectacular, pero la historia se hace un poco lenta al principio. Si tienes paciencia, mejora mucho a partir de la mitad del juego.',
            'La optimización en PC es horrible. Me da tirones todo el rato incluso con una buena gráfica. Esperaré a que saquen un parche para seguir jugando.',
            'Es exactamente lo que buscaba. Acción frenética, buena música y jefes finales muy difíciles. Me ha recordado a los juegos de la vieja escuela.',
            'Sinceramente, no entiendo el hype con este juego. El combate es repetitivo y los personajes son planos. Lo he dejado a las 2 horas.',
            'Una experiencia narrativa única. Me ha hecho llorar al final. La banda sonora es para escucharla todo el día. 10/10.',
            'El modo multijugador es muy divertido para jugar con amigos, pero si juegas solo te aburres rápido. Faltan modos de juego.',
            'Tiene mecánicas muy innovadoras que no había visto antes. Al principio cuesta acostumbrarse a los controles, pero luego fluye genial.'
        ];

        return [
            // Si ya existen usuarios/juegos, coge uno al azar. Si no, crea uno nuevo.
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'game_id' => Game::inRandomOrder()->first()->id ?? Game::factory(),
            
            // Elegimos un título y una opinión al azar de nuestra lista
            'title' => fake()->randomElement($titulos),
            'contenido' => fake()->randomElement($opiniones),
            
            'evaluation' => fake()->numberBetween(1, 5),
        ];
    }
}