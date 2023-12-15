@extends('layouts.app')
@section('title', trans('messages.permissions') )
@section('breadcrumb')
    {!! Breadcrumbs::render('permissions') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.permissions', 'permissionGroup' => 'admin.permissions', 'totalRecords' => count($permissions)])
        @include('message')

        <div class="panel panel-flat">
            <table class="table table-togglable table-hover">
                <thead>
                @include('layouts.partials.tables.header', ['model' => 'App\Models\Permission'])
                </thead>
                <tbody>
                @if(count($permissions))
                    @include('layouts.partials.tables.search', ['route' => 'admin.permissions', 'model' => 'App\Models\Permission', 'permissionGroup' => 'admin.permissions', 'totalRecords' => count($permissions)])
                    @foreach( $permissions as $permission)
                        <tr>
                            @include('layouts.partials.tables.rowselection', ['permissionGroup' => 'admin.permissions', 'model' => $permission ])
                            <td><a href='#' class="stable">{{ $permission->name }}</a></td>
                            <td>{{ $permission->machine }}</td>
                            <td>{{ $permission->group }}</td>
                            @include('layouts.partials.tables.rowactions', ['route' => 'admin.permissions', 'model' => $permission, 'permissionGroup' => 'admin.permissions'])
                        </tr>
                    @endforeach
                @else
                    @include('layouts.partials.tables.norows')
                @endif
                </tbody>
            </table>
            {!! $permissions->appends(request()->all())->render() !!}
        </div>

        @include('layouts.partials.footer')

    </div>
@stop