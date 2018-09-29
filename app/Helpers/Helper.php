<?php

use App\Movie;


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