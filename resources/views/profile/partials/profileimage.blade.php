<div class="row">
    <div class="col-md-10 col-md-offset-1" style="margin-bottom:60px;margin-right:35px;">
        <div class="box box-widget widget-user" onclick="">
            <div class="profile widget-user-header bg-black" style="cursor:pointer;background: url('{{$user->getBackground()}}') center center;">
                @if(Auth::user()->id == $user->id)
                    <div class="temp" style="width:100%;height:100%;display:none;background-color:rgba(0,0,0,0.2)">                    
                        <form name="form1" style="text-align:center;padding-top:50px"action='/profile/changeBackgroundImage' method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <div class="form-group">   
                                <button type="button" title='Change background' type="button" class="btnfile btn btn-xs btn-default">
                                    <input name='background' style="display:none;" id="inputfile" type="file">
                                    <i class="fa fa-camera"></i>
                                </button>
                            </div> 
                            <input type="submit" value="Change Background" class="sub btn btn-default">
                        </form>
                    </div>
                @endif
            </div>
            
            <div class="widget-user-image">
                @if(Auth::user()->id == $user->id) 
                    <div class='profile-form' style="display:none" >
                        <form id='form2' name='form2' align='center' action='/profile/changeProfileImage' method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <button type="button" title='Change profile' style='position:absolute;top:22%;left:39px;' class="btnfile2 btnfile1 btn btn-xs btn-default">
                                <input name='profile' style="display:none;" id="inputfile1" type="file">
                                <i class="fa fa-camera"></i>
                            </button>
                            <button type="submit" style='position:absolute;top:40%;left:4%;' class="inputfile btn btn-xs btn-default">Change profile</button>                       
                        </form>
                    </div>                
                @endif              
                <img style="cursor:pointer" class="profile-img thumbnail" style="border:2px solid #EEE" src="{{$user->getProfile()}}" alt="User Avatar">                                
                <span class="widget-user-username">{{$user->getNameOrUsername()}}</span>
                <span style="position:absolute;top:75px;left: 105px">
                    @if(Auth::user()->isFriendWith($user))
                        <div class="dropdown">
                            <a class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Friend <i class="fa fa-check-circle"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width:180px;">
                                <li><a href="#" class="">Delete <i class="fa fa-close pull-right"></i></a></li>
                                @if(Auth::user()->isFollowerTo($user))
                                    <li><a>Follow <i class="fa fa-check-circle pull-right"></i><a></li>
                                @else
                                    <li><a href="/follow/{{$user->id}}">Follow <i class="fa fa-sign-in pull-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    @elseif(Auth::user()->hasFriendRequestPending($user))
                        <div class="dropdown">
                            <a class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Request Sending <i class="fa fa-check-circle"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width:180px;">
                                <li><a href="#" class="">Delete Request <i class="fa fa-close pull-right"></i></a></li>
                                @if(Auth::user()->isFollowerTo($user))
                                    <li><a>Follow <i class="fa fa-check-circle pull-right"></i><a></li>
                                @else
                                    <li><a href="/follow/{{$user->id}}">Follow <i class="fa fa-sign-in pull-right"></i></a></li>
                                @endif 
                            </ul>
                        </div>
                        <!--<a class="btn btn-xs btn-primary">Request Sending <i class="fa fa-user-circle"></i></a> -->                   
                    @elseif(Auth::user()->hasFriendReqestReceived($user))
                        <div class="dropdown">
                            <a class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Accept Request <i class="fa fa-check-circle"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width:180px;">
                                <li><a href="/friends/accept/{{$user->id}}" class="">Accept <i class="fa fa-check-circle primary pull-right"></i></a></li>                                
                                <li><a href="#" class="">Refause <i class="fa fa-close pull-right"></i></a></li>
                                @if(Auth::user()->isFollowerTo($user))
                                    <li><a>Follow <i class="fa fa-check-circle pull-right"></i><a></li>
                                @else
                                    <li><a href="/follow/{{$user->id}}">Follow <i class="fa fa-sign-in pull-right"></i></a></li>
                                @endif 
                            </ul>
                        </div>    
                    @else
                        @if(Auth::user()->id != $user->id)
                            <a href='/friends/add/{{$user->id}}' class="btn btn-xs btn-primary">Send Request <i class="fa fa-user-plus"></i></a>                    
                        @endif
                    @endif
                </span>
            </div>
        
            
                        
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$user->followersOfMine()->count()}}</h5>
                            <a href="/user/followers/{{$user->id}}"><span class="description-text">Followers</span></a>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$user->followersOf()->count()}}</h5>
                            <a href="/user/followed/{{$user->id}}"><span class="description-text">Followed To</span></a>
                        </div>
                    </div>
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{$user->statuses()->count()}}</h5>
                            <a href="/user/{{$user->id}}/statuses"><span class="description-text">Statuses</span></a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header">{{$user->friends()->count()}}</h5>
                            <a href="/user/{{$user->id}}/friends"><span class="description-text">Friends</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>