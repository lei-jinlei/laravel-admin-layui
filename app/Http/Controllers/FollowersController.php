<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if(Auth::user()->id === $user->id){
            return redirect('/');
        }

        if (!Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow($user->id);
            session()->flash('success', '关注成功');
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return redirect();
        }

        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow($user->id);
            session()->flash('success', '取消关注成功');
        }

        return redirect()->route('users.show', $user->id);
    }
}
