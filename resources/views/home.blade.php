@extends('layout.layout')

@section('header')
<link rel="stylesheet" href="{{asset('website/css/custom.css')}}">
<script>
    function clickBtn()
    {
        var btn = document.getElementById('btnfile');
        var inp = document.getElementById('inputfile');
        inp.click();
    }
</script>
@endsection
@section('content') 
    @include('layout.partials.nav')
    <div class="content-wrapper">
        <div class="row" style="margin-top:10px;">
            <div class='col-md-3'>
                <div class="col-md-12 settings" style="margin-top:19px;margin-left:0">
                    <div class="list-group main-settings">
                        <a title='MyProfile' href='#' class="list-group-item">
                            <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                            {{Auth::user()->getNameOrUsername()}}
                        </a>
                        
                    </div>                       
                </div>   
            </div>
            <div class='col-md-6'>
                <div class="col-md-12" style="margin-right:35px;margin-bottom:30px;">
                    <div class="box box-widget">
                        <div class="panel panel-default">
                            <div class="panel-heading">What is in you mind ?</div>
                            <div class="panel-body">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                        <img class="media-object img-circle" style='width:30px;' src="{{Auth::user()->getProfile()}}" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <form action="status/add" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{Session::token()}}" />
                                            <div class="form-group">
                                                <textarea rows='4' name="body" class="arrow form-control"></textarea>                                        
                                            </div>
                                                <input type="submit" value="Add Post" class="btn btn-xs btn-primary">
                                                <button type="button" title='Change background' class="btnfile btn btn-xs btn-default">
                                                    <input name='status_image' style="display:none;" id="inputfile" accept="png" type="file">
                                                    <i class="fa fa-camera"></i>
                                                </button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($statuses as $status)
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <a href="/profile/{{$status->user->id}}">
                                    <img class="img-circle" src="{{$status->user->getProfile()}}" alt="User Image">
                                </a>
                                <span class="username"><a href="/profile/{{$status->user->id}}">{{$status->user->getNameOrUsername()}}</a></span>
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
                            @if($status->user_id != Auth::user()->id)
                                <a href='/status/{{$status->id}}/share' class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</a>
                            @endif
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
                                <button type="button" class="btn btn-default btn-xs"><i class="fa fa-reply"></i> Reply</button>
                                @if(Auth::user()->hasLikedStatus($reply))
                                    <a href='/status/{{$reply->id}}/like' class="btn btn-primary btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>
                                @else
                                    <a href='/status/{{$reply->id}}/like' class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</a>                                
                                @endif
                                <span class="text-muted">{{$reply->likes()->count()}} {{str_plural('Like',$status->likes()->count())}} <i class="fa fa-thumbs-o-up" style="color:#3c8dbc"></i></span>
                            </div>
                        @endforeach

                        <div class="box-footer">
                            <form action="status/{{$status->id}}/reply" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <img class="img-responsive img-circle img-sm" src="{{Auth::user()->getProfile()}}" alt="Alt Text">
                                <div class="img-push">
                                    <input type="text" style='border-radius:150px;' class="form-control input-sm" name="body_{{$status->id}}" placeholder="Reply for this post">
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
                
            </div>  
                

            <div class='col-md-3'>
                <div class="col-md-12 settings" style="margin-top:19px;margin-left:0">
                        <div style="position:fixed;width: 17%;" class="list-group main-settings">
                            <a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a>
                            <a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a>
                            <a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a><a title='MyProfile' href='#' class="list-group-item">
                                <img class="img-circle" style='width:25px;margin-right:5px' src="{{Auth::user()->getProfile()}}" alt="...">
                                {{Auth::user()->getNameOrUsername()}}
                            </a>
                        </div>                       
                </div>      
            </div>
             
            
        </div>
        
    </div>
@endsection