<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $guarded = [];

    public function genre()
    {
    	return $this->belongsTo(AudioGenre::class, 'genre_id')->orderBy('created_at', 'desc');
    }

    public function related()
    {
    	return Audio::where('genre_id', $this->genre_id)->latest()->get();
    }
}
