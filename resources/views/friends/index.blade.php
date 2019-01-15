@extends('layout.layout')
@section('title')
    Friends
@endsection

@section('header')
   
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
                <div class="box box-widget">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$user->getNameOrUsername()}}'s friends</h3>
                        </div>
                        <div class="panel-body">
                            @if($friends->count() == 0)
                                <p>No results found, sorry</p>
                            @else   
                                @foreach($friends as $friend)
                                    @include('user.partials.userblock',['user' => $friend])
                                @endforeach
                                
                            @endif
                        </div>
                    </div>  
                </div>
            </div>  
            @include('profile.partials.mainsetting')
        </div>
    </div>
@endsection

