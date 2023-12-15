<div class="panel-body">
    <div class="form-group required">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group required">
        {!! Form::label('machine', 'Machine Name:') !!}
        {!! Form::text('machine', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::text('description', null, ['class' => 'form-control input-lg']) !!}
    </div>
    <div class="form-group required">
        {!! Form::label('group', 'Group:') !!}
        {!! Form::text('group', null, ['class' => 'form-control input-lg']) !!}
    </div>
    {!! Form::hidden('id', $permission->id) !!}
</div>

<div class="panel-footer">
    <a href="{{ action('Admin\PermissionController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
    <button type="submit" class="btn btn-primary pull-right legitRipple">Save<i class="icon-arrow-right14 position-right"></i></button>
</div>