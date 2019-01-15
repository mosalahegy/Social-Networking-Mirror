<?php

namespace Mirror\Http\Controllers;

use Illuminate\Http\Request;
use Mirror\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    public function getFriends($id)
    {
        $user = User::find($id);
        
        $friends = $user->friends();
        return view('friends.index',compact('friends','user'));
    }
    public function addFriend($id)
    {
        $user = User::find($id);
        Auth::user()->sendRequest($user);
        return redirect()->back();
    }   
    public function acceptFriend($id)
    {
        # code...
        $user = User::find($id);
        Auth::user()->acceptFriendRequest($user);
        return redirect()->back();        
    }
    public function refuseFriend($id)
    {
        # code...
        $user = User::find($id);
        Auth::user()->refuseFriendRequset($user);
        return redirect()->back();
    }

}
