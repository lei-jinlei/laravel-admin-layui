<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['nickname', 'email', 'website', 'content', 'article_id'];
}
