<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Review::with(['user', 'game'])->latest()->take(5)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'game_id'    => 'required|exists:games,id',
            'title'      => 'required|string|max:100',
            'contenido'  => 'required|string',
            'evaluation' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'user_id'    => Auth::id(),
            'game_id'    => $validated['game_id'],
            'title'      => $validated['title'],
            'contenido'  => $validated['contenido'],
            'evaluation' => $validated['evaluation'],
        ]);

        return response()->json(['message' => 'Created', 'data' => $review], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
