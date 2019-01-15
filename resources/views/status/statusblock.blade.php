<div class="col-md-7 col-md-offset-3" style="margin-right:35px;margin-bottom:30px;">
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
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                    <span class="pull-right text-muted">127 likes - {{$status->replies->count()}} comments</span>
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
                        <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                        <span class="text-muted">127 likes</span>
                    </div>
                @endforeach

                <div class="box-footer">
                    <form action="status/{{$status->id}}/reply" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <img class="img-responsive img-circle img-sm" src="{{Auth::user()->getProfile()}}" alt="Alt Text">
                        <div class="img-push">
                            <input type="text" class="form-control input-sm" name="body_{{$status->id}}" placeholder="Reply for this post">                                  
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>