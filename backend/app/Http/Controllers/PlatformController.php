<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $platforms = Platform::all();
        return view('platforms.index', compact('platforms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform): View
    {
        $platform->load('games.company');
        return view('platforms.show', compact('platform'));
    }
}
