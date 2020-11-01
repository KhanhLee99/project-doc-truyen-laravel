<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_Story extends Model
{
    //
    protected $fillable = [
        'story_id', 'category_id'
    ];
}
