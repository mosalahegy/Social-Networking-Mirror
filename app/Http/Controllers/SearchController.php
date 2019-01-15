<?php

namespace Mirror\Http\Controllers;
use Illuminate\Http\Request;
use Mirror\User;
use DB;
class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('query');
        
        if(!$query)
        {
            return redirect()->back();
        }
        else
        {
            $users = User::where(DB::raw("CONCAT(first_name,' ',last_name)"),'LIKE',"%{$query}%")
                            ->orWhere('username','LIKE',"%{$query}%")
                            ->get();
        }
        return view('search.results',compact('users'));
    }
}