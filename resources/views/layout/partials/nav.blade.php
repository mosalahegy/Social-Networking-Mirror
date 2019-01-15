<aside class="main-sidebar" style="position:fixed">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">FRIENDS</li>
            @foreach(Auth::user()->friends() as $friend)
            
              <li>
                <a style="cursor:pointer">
                  <img class="" src="{{$friend->getProfile()}}" style="width:20px;" alt="{{$friend->getNameOrUsername()}}">                  
                  <span>{{str_limit($friend->getNameOrUsername() ,18)}}</span>
                  @if($friend->isUserOnline())
                    <span class="pull-right-container">
                        <small class="circle pull-right" style="margin-top:-3px;"><i class="fa fa-circle text-success" style="font-size:10px;"></i></small>
                    </span>
                  @else
                    <span class="pull-right-container">
                        <small class="circle pull-right" style="margin-top:-3px;font-size:9px;"><i style='color:#BBB' class="fa fa-circle" style="font-size:10px;"></i></small>
                    </span>
                  @endif
                  
                </a>
              </li>
            @endforeach
              
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>