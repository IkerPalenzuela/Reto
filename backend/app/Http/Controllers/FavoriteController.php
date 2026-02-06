<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;

class FavoriteController extends Controller
{
    public function index()
    {
        $games = Auth::user()->favoriteGames()->get(); 
        return view('favorite', [
            'games' => $games,
            'user' => $user
        ]);
    }
    
    public function store(Request $request){
        $request->validate([
            'juegos' => 'required|array',
            'juegos.*' => 'exists:games,id'
        ]);

        $user = Auth::user();
        
        $datosSync = [];
        foreach ($request->juegos as $index => $idJuego) {
            $datosSync[$idJuego] = ['position' => $index];
        }
        $user->favoriteGames()->sync($datosSync);
        return response()->json(['mensaje' => 'Favoritos guardados correctamente'], 200);
    }
}