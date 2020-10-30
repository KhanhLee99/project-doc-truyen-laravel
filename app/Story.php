<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'path_image', 'status', 'user_id', 'author_id',
    ];

    function Author(){
        return $this->belongsTo('App\Author');
    }
}
