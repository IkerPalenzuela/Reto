<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $query = Game::with(['company', 'platforms']);

        if ($request->has('company_id')) {
            $query->where('company_id', $request->query('company_id'));
        }

        $game = $query->get();
        
        return view('game', [
            'game' => $game,
            'user' => $request->user() // Enviamos el usuario
        ]);
    }
}