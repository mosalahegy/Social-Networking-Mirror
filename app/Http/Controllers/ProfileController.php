<?php

namespace Mirror\Http\Controllers;

use Mirror\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user)
        {
            abort(404);
        }

        $statuses = $user->statuses()->NotReply()->orderBy('created_at','DESC')->get();
        $isFriendWithMe = Auth::user()->isFriendWith($user);

        return view('profile.index',compact('user','statuses','isFriendWithMe'));
    }

    public function changeProfileImage(Request $request)
    {
        $this->validate($request,[
            'profile'   =>  'required|image|mimes:jpg,png,jpeg'
        ]);

        $user = User::find(Auth::user()->id);
        if($request->hasFile('profile'))
        {
            $fileNameWithExtension = $request->file('profile')->getClientOriginalName();
            $fileName              = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension             = pathinfo($fileNameWithExtension,PATHINFO_EXTENSION);
            $fileNameToStore      = $fileName . '_' . time() . '.' . $extension;
            $path                  = $request->file('profile')->storeAs('public/uploads/images/users/profile',$fileNameToStore);
            $user->profile         = $fileNameToStore;
            $user->save();
        }

        return redirect()->back();
    }

    public function changeBackgroundImage(Request $request)
    {
        $this->validate($request,[
            'background'   =>  'required|image|mimes:jpg,png,jpeg'
        ]);

        $user = User::find(Auth::user()->id);

        if($request->hasFile('background'))
        {
            $fileNameWithExtension = $request->file('background')->getClientOriginalName();
            $fileName              = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension             = pathinfo($fileNameWithExtension,PATHINFO_EXTENSION);
            $fileNameToStore      = $fileName . '_' . time() . '.' . $extension;
            $path                  = $request->file('background')->storeAs('public/uploads/images/users/background',$fileNameToStore);
            $user->background         = $fileNameToStore;
            $user->save();
        }
        return redirect()->back();
    }
}