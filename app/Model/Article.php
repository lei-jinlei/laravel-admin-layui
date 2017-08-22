<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function hasManyComments()
    {
        return $this->hasMany('App\Model\Comment', 'article_id', 'id');
    }
}
