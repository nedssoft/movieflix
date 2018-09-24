<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\FeaturedMovie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $featured = FeaturedMovie::where('type', auth()->user()->type)->first();
        $featured_movie = $featured ? $featured->movie : null;
        $genres = Genre::all();
        return view('home', compact('featured_movie', 'genres'));
    }

    public function playMovie(Movie $movie)
    {
        return view('playmovie', compact('movie'));
    }
}
