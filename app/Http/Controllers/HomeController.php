<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;

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
        $featured_movie = Movie::first();
        $genres = Genre::all();
        return view('home', compact('featured_movie', 'genres'));
    }

    public function playMovie(Movie $movie)
    {
        return view('playmovie', compact('movie'));
    }
}
