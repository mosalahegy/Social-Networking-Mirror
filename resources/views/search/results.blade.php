@extends('layout.layout')

@section('content')
    @include('layout.partials.nav')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 col-md-offset-1"  style="margin-top:25px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">You search for "{{Request::input('query')}}"</h3>
                    </div>
                    <div class="panel-body">
                        @if($users->count() == 0)
                            <p>No results found, sorry</p>
                        @else   
                            @foreach($users as $user)
                                @include('user.partials.userblock')
                            @endforeach
                            
                        @endif
                    </div>
                </div>               
            </div>
        </div>
    </div>
@endsection