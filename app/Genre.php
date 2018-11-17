<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{	
	protected $casts = [
        'types' => 'array'
    ];
    
    public function movies()
    {
    	return $this->hasMany(Movie::class, 'genre_id')->orderBy('created_at', 'desc');
    }
}
