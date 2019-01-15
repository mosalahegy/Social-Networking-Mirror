<div class="media">
    <div class="media-left media-middle">
      <a href="/profile/{{$user->id}}">
        <img class="media-object thumbnail" src="{{$user->getProfile()}}" style="width:60px;" alt="{{$user->getNameOrUsername()}}">
      </a>
    </div>
    <div class="media-body">
        <h3 class="media-heading"><a href="/profile/{{$user->id}}">{{$user->getNameOrUsername()}}</a></h3>
        @if($user->location)
          <p>{{$user->location}}</p>
        @endif
                       
            @if(Auth::user()->isFriendWith($user))
            <div class="pull-right" style="margin-right:60px;">
                <div class="dropdown" style="position:absolute">
                    <a class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu{{$user->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Friend <i class="fa fa-check-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$user->id}}">
                        <li><a href="#" class="">Delete <i class="fa fa-close pull-right"></i></a></li>
                        @if(Auth::user()->isFollowerTo($user))
                            <li><a>Follow <i class="fa fa-check-circle pull-right"></i><a></li>
                        @else
                            <li><a href="/follow/{{$user->id}}">Follow <i class="fa fa-sign-in pull-right"></i></a></li>
                        @endif
                    </ul>
                </div>

            </div>

            
            @elseif(Auth::user()->hasFriendRequestPending($user))
            <div class="pull-right" style="margin-right:118px">
                <div class="dropdown" style="position:absolute">
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
            </div>
            @elseif(Auth::user()->hasFriendReqestReceived($user))
            <div class="pull-right" style="margin-right:110px">
                <div class="dropdown" style="position:absolute">
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
            </div> 
            @else
                @if(Auth::user()->id != $user->id)
                <div class="pull-right">
                    <a href='/friends/add/{{$user->id}}' class="btn btn-xs btn-primary">Send Request <i class="fa fa-user-plus"></i></a>                    
                </div>
                @endif
            @endif
        
    </div>
    <hr>
</div>