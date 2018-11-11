<?php

use App\Movie;
use App\Genre;
use App\AudioGenre;
use App\AudioUserType;
use App\MusicSubGenre;
use App\ComedySubGenre;


if (!function_exists('movies')){

	function movies()
	{
		$movies = Movie::all();

		if ($movies) {
			$movies = $movies->filter(function($m){

				return in_array(auth()->user()->type, $m->genre->types);
				
			});

			return $movies;
		}

		return null;
	}
}

if (!function_exists('liveTv')){

	function liveTv()
	{
		$movies = Movie::all();

		if ($movies) {
			$movies = $movies->filter(function($m){

				return strtolower($m->genre->name) == 'live tv' && 
				in_array(auth()->user()->type, $m->genre->types);
				
			});

			return $movies;
		}

		return null;
	}
}

if (!function_exists('genres')){

	function genres()
	{
		
		// dd(Genre::all());
		$genres = Genre::get()->filter(function($g){

			return $g->types && strtolower($g->name) != 'live tv' &&  in_array(auth()->user()->type, $g->types);
		});

		return $genres;
	}
}

function audios()
{
	 $audioTypes = AudioUserType::first();

        if ($audioTypes) {

            $types = $audioTypes->types;

            if (in_array(auth()->user()->type, $types)) {

                $audio_genres = AudioGenre::latest()->get();

                return $audio_genres;
            }
        }

        return null;
}


if (!function_exists('_movies')){

	function _movies()
	{
		return Movie::all();

		
	}
}

if (!function_exists('_liveTv')){

	function _liveTv()
	{
		$movies = Movie::all();

		if ($movies) {
			$movies = $movies->filter(function($m){

				return strtolower($m->genre->name) == 'live tv';
				
			});

			return $movies;
		}

		return null;
	}
}

if (!function_exists('_genres')){

	function _genres()
	{
		
		// dd(Genre::all());
		$genres = Genre::get()->filter(function($g){

			return $g->types && strtolower($g->name) != 'live tv';
		});

		return $genres;
	}
}

function _audios()
{
	 
    $audio_genres = AudioGenre::latest()->get();

    return $audio_genres;
         
}

function _musicVideo()
{
	  $music = MusicSubGenre::all();
	  return $music;
}

function musicVideo()
{
	 $muzic = Genre::whereName('Music')->first();
        
        if ($muzic && in_array(auth()->user()->type, (array)$muzic->types)) {

            $music = MusicSubGenre::all();

            return $music;

        }
}

function comedies()
{
	$comedy = ComedySubGenre::all();
	return $comedy;
}

 