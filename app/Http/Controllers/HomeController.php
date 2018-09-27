<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\FeaturedMovie;
use App\MusicSubGenre;
use DB;

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
        
        $music =  collect(new \StdClass());

        $muzic = Genre::whereName('Music')->first();
        
        if ($muzic && in_array(auth()->user()->type, (array)$muzic->types)) {

            $music = MusicSubGenre::all();

        }
    
        $featured = FeaturedMovie::where('type', auth()->user()->type)->first();
        $featured_movie = $featured ? $featured->movie : null;
        $genres = Genre::where('name', '!=', 'Music')->get();
        return view('home', compact('featured_movie', 'genres', 'music'));
    }

    public function playMovie(Movie $movie)
    {
        return view('playmovie', compact('movie'));
    }

    public function search(Request $request)
    {   
        $search = $request->search_key;
        $genres = DB::table('genres')->where('name', '=', `%{$search}%`)->get();

        dd($genres);
    }
}
