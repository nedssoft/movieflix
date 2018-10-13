<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;
use App\AudioUserType;
use App\AudioGenre;
use App\Audio;
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
        $audio_genres = collect(new \StdClass());
        $muzic = Genre::whereName('Music')->first();
        
        if ($muzic && in_array(auth()->user()->type, (array)$muzic->types)) {

            $music = MusicSubGenre::all();

        }
        
        $audioTypes = AudioUserType::first();

        if ($audioTypes) {

            $types = $audioTypes->types;

            if (in_array(auth()->user()->type, $types)) {

                $audio_genres = AudioGenre::latest()->get();
            }
        }
        $featured = FeaturedMovie::where('type', auth()->user()->type)->first();
        $featured_movie = $featured ? $featured->movie : null;
        $genres = Genre::where('name', '!=', 'Music')->get();
        return view('home', compact('featured_movie', 'genres', 'music', 'audios', 'audio_genres'));
    }

    public function playMovie(Movie $movie)
    {
        return view('playmovie', compact('movie'));
    }

    public function search(Request $request)
    {   
        $search = $request->search_key;
        $result = collect();
        $genres = Genre::where('name', 'LIKE', '%'.$search.'%')->get();
        $movies = Movie::where('title', 'LIKE', '%'.$search.'%')->get();
        
        $audios = collect();

         $audioTypes = AudioUserType::first();

        if ($audioTypes) {

            $types = $audioTypes->types;

            if (in_array(auth()->user()->type, $types)) {

                $audios = Audio::where('name', 'LIKE', '%'.$search.'%')->get();
            }
        }
        $genres = $genres->filter(function($g){
            return in_array(auth()->user()->type, (array)$g->types);
        })->map(function($ge) use ($result) {

           return  $result->push($ge->movies);

        })->flatten();


        $movies = $movies->filter(function($m){
            return in_array(auth()->user()->type, (array)$m->genre->types);
        });

        $data['movies'] =  $genres->merge($movies);
        $data['audios'] = $audios;

        return view('search', $data);
    }

    public function playAudio(Audio $audio)
    {
        return view('play-audio', compact('audio'));
    }

    public function showGenres(Genre $genre)
    {
        return view('genre-details', compact('genre'));
    }

    public function showAudioGenres(AudioGenre $audio_genre)
    {
        return view('audio-details', compact('audio_genre'));
    }

     public function showVideoMusicGenres(MusicSubGenre $music_sub_genre)
    {
        return view('music-details', compact('music_sub_genre'));
    }

}
