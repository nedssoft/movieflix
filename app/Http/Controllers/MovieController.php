<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AudioGenre;
use App\Genre;
use App\Movie;
use App\Audio;
use App\MusicSubGenre;
use App\FeaturedMovie;

class MovieController extends Controller
{
    public function index()
    {
    	
        $music = MusicSubGenre::all();

        $audio_genres = AudioGenre::latest()->get();
           
        $featured = FeaturedMovie::latest()->first();
        $featured_movie = $featured ? $featured->movie : null;
        $genres = Genre::where('name', '!=', 'Music')->get();
        return view('external.home', compact('featured_movie', 'genres', 'music', 'audios', 'audio_genres'));
    }

    public function playMovie(Movie $movie)
    {
        return view('external.playmovie', compact('movie'));
    }

    public function search(Request $request)
    {   
        $search = $request->search_key;
        $result = collect();
        $genres = Genre::where('name', 'LIKE', '%'.$search.'%')->get();
        $movies = Movie::where('title', 'LIKE', '%'.$search.'%')->get();

        $audios = Audio::where('name', 'LIKE', '%'.$search.'%')->get();
        
        $genres = $genres->map(function($ge) use ($result) {

           			return  $result->push($ge->movies);

        		})->flatten();

        $data['movies'] =  $genres->merge($movies);
        $data['audios'] = $audios;

        return view('external.search', $data);
    }

    public function playAudio(Audio $audio)
    {
        return view('external.play-audio', compact('audio'));
    }

    public function showGenres(Genre $genre)
    {
        return view('external.genre-details', compact('genre'));
    }


    public function showAudioGenres(AudioGenre $audio_genre)
    {
        return view('external.audio-details', compact('audio_genre'));
    }
    public function showVideoMusicGenres(MusicSubGenre $music_sub_genre)
    {
    	return view('external.music-details', compact('music_sub_genre'));
    }


}
