<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function index() {}
    public function create() {}
    public function store(Request $request) {}

    public function show(Profile $profile): JsonResponse
    {
        return response()->json(Auth::user()->load('profile'));
    }

    public function edit(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone'   => 'nullable|string|max:20',
        ]);

        $user = $request->user();
        $user->update(['name' => $validated['name']]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'surname' => $validated['surname'] ?? null,
                'phone'   => $validated['phone'] ?? null,
            ]
        );

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    public function destroy(Profile $profile) {}
}