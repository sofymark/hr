@extends('layouts.app')

@section('content')

<form class="form-validate" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <h1><strong>HR</strong></h1>
            <h5 class="content-group">Please sign in to start your session</h5>
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback has-feedback-left">
            <input id="username" type="text" class="form-control" placeholder="Username" name="username" required="required">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
            @if ($errors->has('username'))
                <label class="validation-error-label">{{ $errors->first('username') }}</label>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required="required">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
            @if ($errors->has('password'))
                <label class="validation-error-label">{{ $errors->first('password') }}</label>
            @endif
        </div>

        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="styled" name="remember" checked="checked"> Remember
                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ url('/password/reset') }}">Forgot password?</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-indigo btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
        </div>

        <span class="help-block text-center no-margin">Powered by <a href="http://portal.singularlogic.eu" target="_blank">SingularLogic</a></span>
    </div>
</form>
@endsection
