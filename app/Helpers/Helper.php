<?php

use App\Movie;
use App\Genre;


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

				return $m->genre->name == 'Live TV' && 
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