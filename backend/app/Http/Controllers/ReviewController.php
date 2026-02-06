<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Game; 
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // API: Devuelve las reseñas en JSON (para leer desde JS)
    public function index()
    {
        $reviews = Review::with(['user', 'game'])->latest()->get();
        return response()->json($reviews);
    }

    // WEB: Muestra la vista del formulario
    public function create()
    {
        $game = Game::all();
        return view('review', [
            'games' => $game,
            'user' => auth()->user()
        ]);
    }

    // WEB: Procesa el formulario y redirige
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id'    => 'required|exists:games,id',
            'title'      => 'required|string|max:100',
            'contenido'  => 'required|string',
            'evaluation' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->game_id = $validated['game_id'];
        $review->title = $validated['title'];
        $review->contenido = $validated['contenido'];
        $review->evaluation = $validated['evaluation'];
        $review->save();

        // Redirige a la lista de juegos tras guardar
        return redirect()->route('games')->with('success', 'Reseña creada correctamente');
    }
}