<?php

namespace App\Http\Controllers;

use App\Services\TMDbService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index()
    {
        $movies = $this->tmdbService->getNowPlayingMovies();
        return view('movies.index', compact('movies'));
    }
}