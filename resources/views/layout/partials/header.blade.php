
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      Home <i class="fa fa-home"></i>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      @if(Auth::user())
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      @endif
        <form class="navbar-form navbar-left" action="/search" method="GET" class="sidebar-form">
            <div class="pull-left input-group input-group-sm">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default">Go!</button>
                </span>
            </div>
        </form>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          @if(Auth::user())

          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{Auth::user()->getNotifications()->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{Auth::user()->getNotifications()->count()}} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  
                  
                    @foreach(Auth::user()->getNotifications() as $notification)
                      <!-- -->
                      <li style="padding-top:0px;padding-left:3px;padding-right:3px;"><!-- Task item -->
                        
                        <div class="media" >
                            <div class="media-left media-middle">
                              <a href="/profile/{{$notification->user->id}}">
                                <img class="media-object" src="{{$notification->user->getProfile()}}" style="width:60px;" alt="{{$notification->user->getNameOrUsername()}}">
                              </a>
                            </div>
                            <div class="media-body">
                                <h5 style="padding-top: 10px;padding-bottom:0;" class="media-heading"><a href="/profile/{{$notification->user->id}}">{{$notification->user->getNameOrUsername()}}</a></h5>
                                
                                
                                  @if($notification->parent_id)
                                  <a href="/posts/{{$notification->parent_id}}" style="color:#666">
                                    {{$notification->user->getNameOrUsername()}} has replyed to 
                                    
                                      <?php
                                        
                                        if($notification->parent['user_id'] == Auth::user()->id)
                                          echo "your ";
                                        elseif($notification->user->id == $notification->parent['user_id'])
                                          echo "his ";
                                        else
                                        {
                                          $firstName = Mirror\User::find($notification->parent['user_id'])['first_name'];
                                          $lastName  = Mirror\User::find($notification->parent['user_id'])['last_name'];
                                          echo $firstName != NULL && $lastName != Null  ? $firstName . " " . $lastName: Mirror\User::find($notification->parent['user_id'])['username'];                             
                                        }
                                          
                                      ?>
                                      Status
                                    </a>
                                  @else
                                  <a href="/posts/{{$notification->id}}" style="color:#666">
                                    {{$notification->user->getNameOrUsername()}} have posted {{$notification->created_at->diffForHumans()}}
                                  </a>
                                  @endif
                                  <span style="float: right;margin-right:5px;font-size: 10px;padding-top: 15px;color:#3c8dbc">{{$notification->created_at->diffForHumans()}}</span>
                                
                              </div>
                                
                            <hr style="margin-top:5px;margin-bottom:5px;">
                        </div>
                      </li>

                    @endforeach
                  
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-o"></i>
              <span class="label label-danger">{{Auth::user()->friendRequests()->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{Auth::user()->friendRequests()->count()}} request</li>
               <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                  @foreach(Auth::user()->friendRequests() as $user)
               
                    <li style="padding-top:0px;padding-left:3px;padding-right:3px;"><!-- Task item -->
                      <div class="media" >
                          <div class="media-left media-middle">
                            <a href="/profile/{{$user->id}}">
                              <img class="media-object" src="{{$user->getProfile()}}" style="width:60px;" alt="{{$user->getNameOrUsername()}}">
                            </a>
                          </div>
                          <div class="media-body">
                              <h5 style="padding-top: 10px;padding-bottom:0;" class="media-heading"><a href="/profile/{{$user->id}}">{{$user->getNameOrUsername()}}</a></h5>
                              @if($user->location)
                                <h5>{{$user->location}}</h5>
                              @endif
                              <div class="pull-right">
                                <a href="/friends/refuse/{{$user->id}}" style="margin-top:-22px;" class="btn btn-xs btn-danger" >Refuse <i class="fa fa-close"></i></a>
                                <a href='/friends/accept/{{$user->id}}' style="margin-top:-22px;" class="btn btn-xs btn-primary" >Agree <i class="fa fa-check-circle"></i></a>          
                              </div>
                          </div>
                          <hr style="margin-top:0;margin-bottom:3px;">
                      </div>
                    </li>
                    
                  @endforeach
    
                  <!-- end task item -->
                
                </ul>
              </li>
<!-- inner menu: contains the actual data -->
<li class="header">Another Suggested Friends</li>
<li>
   <!-- inner menu: contains the actual data -->
   <ul class="menu">
   @foreach(Auth::user()->suggestedFriends() as $user)

     <li style="padding-top:0px;padding-left:3px;padding-right:3px;"><!-- Task item -->
       <div class="media" >
           <div class="media-left media-middle">
             <a href="/profile/{{$user->id}}">
               <img class="media-object" src="{{$user->getProfile()}}" style="width:60px;" alt="{{$user->getNameOrUsername()}}">
             </a>
           </div>
           <div class="media-body">
               <h5 style="padding-top: 10px;padding-bottom:0;" class="media-heading"><a href="/profile/{{$user->id}}">{{$user->getNameOrUsername()}}</a></h5>
               @if($user->location)
                 <h5>{{$user->location}}</h5>
               @endif
               <div class="pull-right">
               <a href='/friends/add/{{$user->id}}' class="btn btn-xs btn-primary">Send Request <i class="fa fa-user-plus"></i></a>                    
                   
              </div>
           </div>
           <hr style="margin-top:0;margin-bottom:3px;">
       </div>
     </li>  
     
   @endforeach

   <!-- end task item -->
 
 </ul>
</li>


              
                            
              <li class="footer">
                <a href="#">View all friends</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu open">
            <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <img src="{{Auth::user()->getProfile()}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->getNameOrUsername()}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{Auth::user()->getProfile()}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->getNameOrUsername()}}
                  <small>Member since {{Auth::user()->created_at->diffForHumans()}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Status</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/signout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          @else
          <li>
            <a href="/signin">Sign In</a>
          </li>
          <li>
              <a href="/signup">Sign Up</a>
          </li>
          @endif
      
        </ul>
      </div>
    </nav>
  </header>
  