@if(Session::has('flash'))
    <div style='margin-top:20px' class="container alert alert-info">
        {{Session::get('flash')}}
    </div>
@endif
@if(Session::has('error'))
    <div style='margin-top:20px' class="container alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif