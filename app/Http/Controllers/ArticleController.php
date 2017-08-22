<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function show($id)
    {
        return view('article/show')->withArticle(Article::with('hasManyComments')->find($id));
    }
}
