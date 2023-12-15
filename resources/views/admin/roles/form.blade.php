<div class="panel-body">
    <div class="form-group required">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
    </div>
    <div class="form-group required">
        {!! Form::label('machine', 'Machine Name') !!}
        {!! Form::text('machine', null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description:') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control input-lg', 'rows' => 2]) !!}
    </div>

    <div class="form-group">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th colspan="2" class="text-left">{{ trans('messages.permissions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td><input class="permissions form-checkbox" type="checkbox" id="permissions" data-init-plugin="switchery" name="permissions[{{$permission->id}}]" value="{{$permission->id}}" {{ $role->hasPermission($permission->machine) ? 'checked' : ''}}></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {!! Form::hidden('id', $role->id) !!}
</div>

<div class="panel-footer">
    <a href="{{ action('Admin\RoleController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
    <button type="submit" class="btn btn-primary pull-right legitRipple">Save<i class="icon-arrow-right14 position-right"></i></button>
</div>
