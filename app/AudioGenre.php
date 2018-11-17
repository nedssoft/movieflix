<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioGenre extends Model
{
    protected $guarded = [];

    public function audios()
    {
    	return $this->hasMany(Audio::class, 'genre_id')->orderBy('created_at', 'desc');
    }
}
