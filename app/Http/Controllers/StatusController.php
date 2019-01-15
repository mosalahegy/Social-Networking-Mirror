<?php

namespace Mirror\Http\Controllers;

use Mirror\Http\Requests\StatusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mirror\User;
use Mirror\Status;
use Mirror\Like;

class StatusController extends Controller
{
    //
    public function addStatus(StatusRequest $request)
    {
        $status = new Status;
        if($request->hasFile('status_image'))
        {
            $fileNameWithExtension = $request->file('status_image')->getClientOriginalName();
            $fileName              = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
            $extension             = pathinfo($fileNameWithExtension,PATHINFO_EXTENSION);
            $fileNameToStore       = $fileName . '_' . time() . '.' . $extension;
            $path                  = $request->file('status_image')->storeAs('public/uploads/images/status',$fileNameToStore);
            $status->status_image  = $fileNameToStore;
        }
        
        $status->fill([
            'body'  => $request->input('body'),
            'user_id'   => Auth::user()->id
        ])->save();
        return redirect()->back();
    }

    public function getPost($id)
    {
        $status = Status::find($id);
        return view('status.status',compact('status'));
    }

    public function addReply(Request $request,$statusId)
    {
        $this->validate($request,[
            "body_{$statusId}" => 'required'
        ]);
        $status = Status::notReply()->find($statusId);
        if(!$status)
        {
            return redirect()->back();
        }
        $reply = Status::create([
            'body' => $request->input("body_{$statusId}"),
            'user_id'   => Auth::user()->id
        ]);
        $status->replies()->save($reply);
        return redirect()->back();
    }

    public function Like($statusId)
    {
        $status = Status::find($statusId);
        if(!$status)
        {
            return redirect()->back();
        }
        if(Auth::user()->hasLikedStatus($status))
        {
            return redirect()->back();
        }
        /*
        $like =$status->likes()->create([]);
        Auth::user()->likes()->save($like);
        */
        $like = new Like();
        $like->fill([
            'user_id'       => Auth::user()->id,
            'likeable_id'   =>  $status->id,
            'likeable_type' =>  get_class($status)
        ])->save();
        return redirect()->back();
    }

    public function shareStatus($id)
    {
        $status = Status::find($id);
        $sharedStatus = new Status();
        $sharedStatus->fill([
            'body'  => $status->body,
            'user_id'   => Auth::user()->id,        
        ]);
        $sharedStatus->status_image = $status->status_image;
        $sharedStatus->save();
        return redirect()->back();
    }
}
