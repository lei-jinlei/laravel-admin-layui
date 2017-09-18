<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            // 登陆后的相关操作
        } else {
            // 登陆失败后的相关操作
        }
        return;
    }
}
