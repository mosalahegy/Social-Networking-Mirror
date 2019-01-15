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
            <div class="box box-widget widget-user" onclick="">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href='#'>Followeds</a>                            
                            </h3>
                            
                        </div>
                        <div class="panel-body">
                            @if($followeds->count() == 0)
                                <p>No results found, sorry</p>
                            @else   
                                @foreach($followeds as $followed)
                                    @include('user.partials.userblock',['user' => $followed])
                                @endforeach
                                
                            @endif
                        </div>
                    </div>               
                </div>
            </div>
        </div>
    </div>
        
@endsection
@section('footer')
@endsection
