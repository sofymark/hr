@extends('layouts.app')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <h1><strong>HR</strong></h1>
            <h5 class="content-group">Please enter your e-mail address in order to send you the password reset link</h5>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn bg-indigo btn-block">Reset Password <i class="icon-envelope position-right"></i></button>
            </div>
        </div>
    </div>
</form>
@endsection
