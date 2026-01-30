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
        $query = Game::with(['company', 'platforms']);

        if ($request->has('company_id')) {
            $query->where('company_id', $request->query('company_id'));
        }

        $videojuegos = $query->get();

        return view('videojuegos', compact('videojuegos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game){ 
        //
    }
    public function create() {
        //
    }
    public function store(Request $request) {
        //
    }
    public function edit(Game $game) { 
        //
    }
    public function update(Request $request, Game $game) {
        //
    }
    public function destroy(Game $game) {
        //
    }
}