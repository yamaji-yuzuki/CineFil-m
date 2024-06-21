<?php

namespace App\Http\Controllers;

use App\Services\TMDbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Film;
use Auth;

class FilmController extends Controller
{
    
    public function index()
    {
        $apiKey = env('TMDB_API_KEY');
        $response = Http::get("https://www.themoviedb.org/movie/now-playing", [
            'api_key' => $apiKey,
            'language' => 'ja-JP',
            'page' => 1
        ]);

        $films = $response->json()['results'];

        return view('films.index', compact('films'));
    }

    public function show($id)
    {
        $film = Film::with('likes', 'reviews')->findOrFail($id);
        return view('films.show', compact('film'));
    }
}

