<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    protected $fillable = [
        'name', 'view', 'path_image', 'story_id', 'pages'
    ];

    function Story(){
        return $this->belongsTo('App\Story');
    }

    function Images(){
        return $this->hasMany('App\Image');
    }
}
