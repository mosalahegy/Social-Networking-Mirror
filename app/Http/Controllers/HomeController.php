<?php

namespace Mirror\Http\Controllers;

use Mirror\Status;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function home()
    {
        $fId = Auth::user()->friends()->toArray('id');
        $ids = [];
        foreach($fId as $id)
        {
            $ids[] = $id['id'];
        }
        $statuses = Status::where('user_id',Auth::user()->id)
                ->orWhereIn('user_id',$ids)
                ->orderBy('created_at','DESC')
                ->get();
        $statuses = $statuses->where('parent_id',NULL);
        
        return view('home',compact('statuses'));
    }
}