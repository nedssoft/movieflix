<?php

namespace App;

use App\Movie;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function genre()
    {
    	return $this->belongsTo(Genre::class, 'genre_id')->orderBy('created_at', 'desc');
    }

    public function related()
    {
    	return Movie::where('genre_id', $this->genre_id)->latest()->get();
    }
}
