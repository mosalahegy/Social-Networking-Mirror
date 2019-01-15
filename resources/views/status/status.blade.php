@extends('layout.layout')
@section('title')
    Profile
@endsection

@section('header')
   
@endsection

@section('content')
    @include('layout.partials.nav')
    <div class="row" style="margin-top:100px">
        @include('status.statusblock')
    </div>
@endsection

@section('footer')

@endsection