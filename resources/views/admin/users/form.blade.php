<div class="panel-body">
    <div class="form-group required">
        {!! Form::label('username', 'Username') !!}
        {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group required">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', isset($user->profile->name) ? $user->profile->name : null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password') !!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>

    @can('admin.roles.index')
    <div class="form-group required">
        {!! Form::label('role_list', 'Role') !!}
        {!! Form::select('role_list[]', $roles, null, ['id' => 'role_list', 'class' => 'form-control select', 'data-placeholder' => 'Select Role...', 'multiple']) !!}
    </div>
    @endcan
    <div class="form-group">
        {!! Form::label('active', 'Active') !!}
        {!! Form::checkbox('active', 1, null, ['data-init-plugin' => 'switchery'  ]) !!}
    </div>
</div>

<div class="panel-footer">
    <a href="{{ action('Admin\UserController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
    <button type="submit" class="btn btn-primary pull-right legitRipple">Save<i class="icon-arrow-right14 position-right"></i></button>
</div>
