<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'article_id', 'id');
    }
}
