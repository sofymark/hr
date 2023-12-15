@extends('layouts.app')
@section('title', trans('messages.users'))
@section('breadcrumb')
    {!! Breadcrumbs::render('users') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.users', 'permissionGroup' => 'admin.users', 'hasActivation' => true, 'totalRecords' => count($users)])
        @include('message')

        <div class="panel panel-flat">
            <table class="table table-togglable table-hover">
                <thead>
                @include('layouts.partials.tables.header', ['model' => 'App\Models\User'])
                </thead>
                <tbody>
                @if(count($users))
                    @include('layouts.partials.tables.search', ['route' => 'admin.users', 'model' => 'App\Models\User', 'permissionGroup' => 'admin.users', 'totalRecords' => count($users)])
                    @foreach( $users as $user)
                        <tr>
                            @include('layouts.partials.tables.rowselection', ['model' => $user, 'permissionGroup' => 'admin.users'])
                            <td><a href="#" class="stable">{{ $user->username }}</a></td>
                            <td>{{ $user->name }}</td>
                            @if($user->canAccessRoles())
                                <td>
                                    @foreach($user->roles as $role)
                                        {{ $role->name }}<br/>
                                    @endforeach
                                </td>
                            @endif
                            @include('layouts.partials.tables.rowactivation', ['route' => 'admin.users', 'model' => $user, 'permissionGroup' => 'admin.users'])
                            @include('layouts.partials.tables.rowactions', ['route' => 'admin.users', 'model' => $user, 'permissionGroup' => 'admin.users'])
                        </tr>
                    @endforeach
                @else
                    @include('layouts.partials.tables.norows')
                @endif
                </tbody>
            </table>
            {!! $users->appends(request()->all())->render() !!}
        </div>

        @include('layouts.partials.footer')

    </div>
@stop
