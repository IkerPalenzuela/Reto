<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Game; 
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Solo datos, nada de vistas
        $reviews = Review::with(['user', 'game'])->latest()->get();
        return response()->json($reviews);
    }

    public function create()
    {
        $game = Game::all();
        return view('review', compact('game'));
    }

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

        return response()->json(['message' => 'Created'], 201);
    }
}