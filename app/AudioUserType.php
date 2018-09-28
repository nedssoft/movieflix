<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioUserType extends Model
{
    protected $casts = [
        'types' => 'array'
    ];

    protected $guarded = [];
}
