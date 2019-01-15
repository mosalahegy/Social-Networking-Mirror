@extends('layout.layout')

@section('content')
<div class="content">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Sign Up</h3>
            </div>
            <form class="form-horizontal" action="/signup" method="POST">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <div class="box-body">
                    <div class="form-group{{$errors->has('username') ? ' has-error' : '' }}">
                        <label for="inputUsername" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name='username' value="{{ Request::old('username') ?: ''}}" required id="inputUsername" placeholder="Username">
                            @if($errors->has('username'))
                                <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{$errors->has('email') ? ' has-error' : '' }}">
                        <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name='email' value="{{ Request::old('email') ?: ''}}" required id="inputEmail" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('username')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{$errors->has('password') ? ' has-error' : '' }}">
                        <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name='password' id="inputPassword" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{$errors->has('password-confirm') ? ' has-error' : '' }}">
                        <label for="inputPasswordConfirmation" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name='password-confirm' id="inputPasswordConfirmation" placeholder="Confirm Password">
                            @if($errors->has('password-confirm'))
                                <span class="help-block">{{$errors->first('password-confirm')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
<!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Sign Up <i class="fa fa-user-plus"></i></button>
                </div>
<!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
@endsection