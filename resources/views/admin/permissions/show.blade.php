@extends('layouts.app')
@section('title', 'Permissions')

@section('breadcrumb')
    {!! Breadcrumbs::render('permissions') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.permissions', 'permissionGroup' => 'admin.permissions', 'model' => $permission])
        @include('message')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Permissions</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        @can('admin.permissions.edit')
                        <li><a href="{{ action('Admin\PermissionController@edit', $permission->id) }}"><i class="icon-pencil"></i></a></li>
                        @endcan
                        @can('admin.permissions.destroy')
                        <li>
                            <form action="{{ action('Admin\PermissionController@destroy', $permission->id) }}" method="POST" data-task="destroy">
                                <a href="{{ action('Admin\PermissionController@destroy', $permission->id) }}"><i class="icon-trash"></i></a>
                                <input type="hidden" name="_method" value="DELETE"/>
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endcan
                        <li><a href="{{ action('Admin\PermissionController@index') }}"><i class="icon-list"></i></a></li>
                    </ul>
                </div>
            </div>

            <table class="table table-togglable table-hover">
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{ $permission->name }}</td>
                </tr>
                <tr>
                    <td><strong>Machine Name</strong></td>
                    <td>{{ $permission->machine }}</td>
                </tr>
                <tr>
                    <td><strong>Description</strong></td>
                    <td>{{ $permission->description }}</td>
                </tr>
                <tr>
                    <td><strong>Group</strong></td>
                    <td>{{ $permission->group }}</td>
                </tr>
            </table>
        </div>

        @include('layouts.partials.footer')

    </div>
@stop