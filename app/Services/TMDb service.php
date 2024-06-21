<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDbService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
    }

    public function getNowPlayingMovies()
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing", [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        if ($response->successful()) {
            return $response->json()['results'];
        }

        return [];
    }
}
