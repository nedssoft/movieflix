<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $guarded = [];

    public function genre()
    {
    	return $this->belongsTo(AudioGenre::class, 'genre_id');
    }

    public function related()
    {
    	return Audio::where('genre_id', $this->genre_id)->get();
    }
}
