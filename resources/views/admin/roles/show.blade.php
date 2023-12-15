@extends('layouts.app')
@section('title', trans('messages.roles'))

@section('breadcrumb')
    {!! Breadcrumbs::render('roles') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.roles', 'permissionGroup' => 'admin.roles', 'model' => $role])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ $role->name }}</h5>
            </div>
            <div class="panel-body">
                <table class="table table-togglable table-hover">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{ $role->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Machine Name</strong></td>
                        <td>{{ $role->machine }}</td>
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        <td>{{ $role->description }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ trans('messages.permissions') }}</h5>
            </div>
            <div class="panel-body">
                <table class="table table-togglable table-hover">
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th colspan="2">Macine Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $permissions as $permission)
                        <tr>
                            <td class="vert-align permission">{{ $permission->name }}</td>
                            <td class="vert-align permission">{{ $permission->machine }}</td>
                            @if($role->hasPermission($permission->machine))
                                <td class="text-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                            @else
                                <td class="text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('layouts.partials.footer')

    </div>
@stop
