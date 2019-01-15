<div class="col-md-4 settings" style="margin-top:19px;margin-left:5px">
    <div class="col-md-12">
        <div class="list-group main-settings">
            <a id="list-group-user-link" href='#' class="list-group-item">
                {{$user->getNameOrUsername()}}
                <img class="img-circle pull-right" style="width:25px" src="{{$user->getProfile()}}" alt="User Image">
            </a>
            <a href='#' class="list-group-item">
                Common Friends
                <i class="pull-right fa fa-users" style="font-size:22px;"></i>
            </a>
            <a href='#' class="list-group-item">
                Uploads Photos
                <i class="pull-right fa fa-photo" style="font-size:22px;"></i>
            </a>
            <a href='#' class="list-group-item">
                Status
                <i class="pull-right fa fa-comment" style="font-size:22px;"></i>
            </a>
            <a href='#' class="list-group-item">
                videos
                <i class="pull-right fa fa-film" style="font-size:22px;"></i>
                                        
            </a>
        </div>
    </div>
    
</div>      