@extends('layout.layout')
@section('title')
    Profile
@endsection

@section('header')
   
<style>
    
    .widget-user-header
    {
        min-height: 300px;
        width: 100%;
        -webkit-background-size: 100%;
        -moz-background-size: 100%;
        -o-background-size: 100%;
        background-size: 100%;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding-bottom: 100px;
    }
</style>
@endsection
@section('content')
    @include('layout.partials.nav')
    <div class="content-wrapper">
        @include('profile.partials.profileimage')
        <div class="row">
            <div class="col-md-6 col-md-offset-1" style="margin-right:35px;margin-bottom:30px;">
                @foreach($statuses as $status)
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="{{$status->user->getProfile()}}" alt="User Image">
                                <span class="username"><a href="#">{{$status->user->getNameOrUsername()}}</a></span>
                                <span class="description">{{$status->user->location}} - {{$status->created_at->diffForHumans()}}</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                                    <i class="fa fa-circle-o"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <div class="box-body">
                            <p style="margin-left:10px;">{{$status->body}}</p>
                            @if($status->status_image != NULL)
                                <img class="img-responsive pad" src="{{$status->getStatusImage()}}" alt="Photo">
                            @endif
                            <a href='/status/{{$status->id}}/share' class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</a>
                            @if(Auth::user()->hasLikedStatus($status))
                                <a href='/status/{{$status->id}}/like' class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>
                            @else
                                <a href='/status/{{$status->id}}/like' class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>                                
                            @endif
                            <span class="pull-right text-muted">{{$status->likes()->count()}} {{str_plural('Like',$status->likes()->count())}} - {{$status->replies->count()}} {{str_plural('Comment',$status->likes()->count())}}</span>
                        </div>
                        @foreach($status->replies as $reply)
                            <div class="box-footer box-comments">
                                <div class="box-comment">
                                    <img class="img-circle img-sm" src="{{$reply->user->getProfile()}}" alt="User Image">
                                    <div class="comment-text">
                                        <span class="username">
                                            {{$reply->user->getNameOrUsername()}}
                                            <span class="text-muted pull-right">{{$reply->created_at->diffForHumans()}}</span>
                                        </span>
                                            {{$reply->body}}
                                    </div>
                                </div>
                                @if(Auth::user()->hasLikedStatus($reply))
                                    <a href='/status/{{$reply->id}}/like' class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>
                                @else
                                    <a href='/status/{{$reply->id}}/like' class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>                                
                                @endif
                                <span class="text-muted">{{$reply->likes()->count()}} {{str_plural('Like',$reply->likes()->count())}} <i class="fa fa-thumbs-o-up" style="color:#3c8dbc"></i></span>
                            </div>
                        @endforeach
                        @if($isFriendWithMe || Auth::user()->id == $status->user->id)
                            <div class="box-footer">
                                <form action="/status/{{$status->id}}/reply" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
                                    <img class="img-responsive img-circle img-sm" src="{{Auth::user()->getProfile()}}" alt="Alt Text">
                                    <div class="img-push">
                                        <input type="text" class="form-control input-sm" name="body_{{$status->id}}" placeholder="Reply for this post">                                  
                                    
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>  
            @include('profile.partials.mainsetting')
        </div>
    </div>
@endsection

@section('footer')
@endsection

