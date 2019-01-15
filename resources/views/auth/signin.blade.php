@extends('layout.layout')

@section('content')
<div class="content">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Sign In</h3>
            </div>
            <form class="form-horizontal" action="/signin" method="POST">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <div class="box-body">
                    <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                        <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name='email' required id="inputEmail" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
                        <label for="inputPassword" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" name='password' id="inputPassword" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="help-block">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input name='remember' type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    
                </div>
<!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Sign In <i class="fa fa-sign-in"></i></button>
                </div>
<!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
@endsection