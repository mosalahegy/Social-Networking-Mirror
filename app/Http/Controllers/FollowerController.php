<?php

namespace Mirror\Http\Controllers;

use Illuminate\Http\Request;
use Mirror\User;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    //
    public function follow($id)
    {
        $user = User::find($id);
        if(Auth::user()->isFollowerTo($user))
        {
            return redirect()->back();
        }
        Auth::user()->Follow($user);
        return redirect()->back();
        
    }
    public function getFollowers($id)
    {
        $user = User::find($id);
        $followers = $user->followers();
        return view('profile.followers',compact('followers','user'));
    }
    public function getFolloweds($id)
    {
        $user = User::find($id);
        $followeds = $user->followeds();
        return view('profile.followeds',compact('followeds','user'));   
    }
    
}
