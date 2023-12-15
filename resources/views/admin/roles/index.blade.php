@extends('layouts.app')
@section('title', trans('messages.roles'))
@section('breadcrumb')
    {!! Breadcrumbs::render('roles') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.roles', 'permissionGroup' => 'admin.roles', 'totalRecords' => count($roles)])
        @include('message')

        <div class="panel panel-flat">
            <table class="table table-togglable table-hover">
                <thead>
                @include('layouts.partials.tables.header', ['model' => 'App\Models\Role'])
                </thead>
                <tbody>
                @if(count($roles))
                    @include('layouts.partials.tables.search', ['route' => 'admin.roles', 'model' => 'App\Models\Role', 'permissionGroup' => 'admin.roles', 'totalRecords' => count($roles)])
                    @foreach( $roles as $role)
                        <tr>
                            @include('layouts.partials.tables.rowselection', ['permissionGroup' => 'admin.roles', 'model' => $role ])
                            <td><a href='#' class="stable">{{ $role->name }}</a></td>
                            <td>{{ $role->machine }}</td>
                            @include('layouts.partials.tables.rowactions', ['route' => 'admin.roles', 'model' => $role, 'permissionGroup' => 'admin.roles'])
                        </tr>
                    @endforeach
                @else
                    @include('layouts.partials.tables.norows')
                @endif
                </tbody>
            </table>
            {!! $roles->appends(request()->all())->render() !!}
        </div>

        @include('layouts.partials.footer')

    </div>
@stop
