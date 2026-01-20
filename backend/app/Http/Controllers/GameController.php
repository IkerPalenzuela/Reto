<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     * CUMPLE B.2: Búsqueda y Filtro
     */
    public function index(Request $request): JsonResponse
    {
        // Iniciamos la consulta cargando la compañía
        $query = Game::with('company');

        // SI en la URL viene ?company_id=3, filtramos por esa compañía
        if ($request->has('company_id')) {
            $query->where('company_id', $request->query('company_id'));
        }

        // FALTABA EL PUNTO Y COMA AQUÍ ABAJO
        return response()->json($query->get());
    }

    // ... create y store vacíos ...

    /**
     * Display the specified resource.
     */
    public function show(Game $game): JsonResponse
    {
        // FALTABA EL PUNTO Y COMA AQUÍ ABAJO
        return response()->json(
            $game->load(['company', 'platforms', 'reviews.user'])
        );
    }

    // ... resto de métodos vacíos ...
    public function create() {}
    public function store(Request $request) {}
    public function edit(Game $game) {}
    public function update(Request $request, Game $game) {}
    public function destroy(Game $game) {}
}