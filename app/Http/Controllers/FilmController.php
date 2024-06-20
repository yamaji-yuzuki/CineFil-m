<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Film;
use App\Models\Like;
use App\Models\Review;
use Auth;

class FilmController extends Controller
{
    public function index()
    {
        $apiKey = env('TMDB_API_KEY');
        $response = Http::get("https://api.themoviedb.org/3/movie/top_rated", [
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

    public function like($id)
    {
        $film = Film::findOrFail($id);
        $like = Like::firstOrCreate(['user_id' => Auth::id(), 'film_id' => $id]);
        $film->increment('like_count');
        return back();
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string'
        ]);

        $film = Film::findOrFail($id);
        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'film_id' => $id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        // レビューの平均評価を再計算
        $film->review_count = $film->reviews()->count();
        $film->reviews_total = $film->reviews()->avg('rating');
        $film->save();

        return back();
    }
}

