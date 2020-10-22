<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    protected $fillable = [
        'name', 'view', 'path_image', 'story_id'
    ];
}
