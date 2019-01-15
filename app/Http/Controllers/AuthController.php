<?php


namespace Mirror\Http\Controllers;

use Mirror\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mirror\User;

class AuthController extends Controller
{
    public function getSignUp()
    {
        return view('auth.signup');
    }
    public function postSignUp(UserRequest $request)
    {
        $user = new User();
        $user->fill(array_except($request->all(),['_token','password']));
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('/')->with('flash','Your account has been created,Sign in now :)');
    }
    public function getSignIn()
    {
        return view('auth.signin');
    }
    public function postSignIn(Request $request)
    {
        $this->validate($request,[
            'email'     =>  'required',
            'password'  =>  'required'
        ]);
        
        if(!Auth::attempt($request->only(['email','password']), $request->has('remeber')))
        {
            return redirect()->back()->with('error','Email or Password is wronge,try again');
        }
        return redirect('/home');
    }
    public function getSignOut()
    {
        Auth::logout();
        return redirect('/');
    }
}