<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        // return '主页';
        return view('static_pages/home');
    }

    public function help()
    {
        // return '帮助页面';
        return view('static_pages/help');
    }

    public function about()
    {
        // return '关于页';
        return view('static_pages/about');
    }
}
