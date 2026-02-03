<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index() {}
    public function create() {}

    public function store(Request $request){
        $request->validate([
            'juegos' => 'required|array',
            'juegos.*' => 'exists:games,id'
        ]);
        $userId = Auth::id();

        Favorite::where('user_id', $userId)->delete();

        foreach ($request->juegos as $posicion => $gameId) {
            Favorite::create([
                'user_id' => $userId,
                'game_id' => $gameId,
                'position' => $posicion
            ]);
        }

        return response()->json(['mensaje' => 'Favoritos guardados correctamente'], 200);
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}