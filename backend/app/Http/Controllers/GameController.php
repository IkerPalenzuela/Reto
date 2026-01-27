<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Muestra el catálogo de juegos.
     */
    public function index(Request $request) 
    {
        // 1. Cargamos las relaciones: company (1:N) y platforms (N:M)
        $query = Game::with(['company', 'platforms']);

        // 2. Filtro opcional por compañía
        if ($request->has('company_id')) {
            $query->where('company_id', $request->query('company_id'));
        }

        // 3. Obtenemos los datos
        $videojuegos = $query->get();

        // 4. RETORNAMOS LA VISTA
        return view('videojuegos', compact('videojuegos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return response()->json(
            $game->load(['company', 'platforms', 'reviews.user'])
        );
    }

    public function create() {}
    public function store(Request $request) {}
    public function edit(Game $game) {}
    public function update(Request $request, Game $game) {}
    public function destroy(Game $game) {}
}