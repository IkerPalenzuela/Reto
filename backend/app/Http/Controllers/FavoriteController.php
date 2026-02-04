<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $game = Auth::user()->favoriteGames()->orderByPivot('position')->get();
        return view('favorite', ['games' => $game]);
    }
    
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
    
    public function update(Request $request, string $id) 
    {
        $request->validate([
            'orden' => 'required|array',
            'orden.*' => 'exists:favorites,id'
        ]);

        $userId = Auth::id();

        foreach ($request->orden as $posicion => $favoritoId) {
            Favorite::where('id', $favoritoId)
                ->where('user_id', $userId)
                ->update(['position' => $posicion]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente'], 200);
    }
    
    public function destroy(string $id) {}
}