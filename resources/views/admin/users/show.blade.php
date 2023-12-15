@extends('layouts.app')
@section('title', trans('messages.users'))

@section('breadcrumb')
    {!! Breadcrumbs::render('users') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.users', 'permissionGroup' => 'admin.users', 'model' => $user])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ $user->profile->name }} {{ $user->profile->surname }}</h5>
            </div>

            <div class="panel-body">
                <div class="col-md-12">
                    <table class="table table-togglable table-hover">
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>@if($user->profile->gender == 1) Woman @else Man @endif</td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{ $user->profile->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Surname</strong></td>
                            <td>{{ $user->profile->surname }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email Address</strong></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Active</strong></td>
                            <td class="text-success">@if ($user->active == 1) <i class="icon-checkmark3"></i> @else <i class="icon-cross2"></i> @endif</td>
                        </tr>
                        <tr>
                            <td><strong>Organization</strong></td>
                            <td>
                                @foreach($organizations as $organization)
                                    <a href='{{ action('Admin\OrganizationController@show', $organization->id) }}'>{{ $organization->name }}</a><br/>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Role</strong></td>
                            @foreach($roles as $role)
                                <td>{{ $role->name }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td><strong>Telephone</strong></td>
                            <td>{{ $user->profile->telephone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Mobile</strong></td>
                            <td>{{ $user->profile->mobile }}</td>
                        </tr>
                        <tr>
                            <td><strong>Website</strong></td>
                            <td>{{ $user->profile->website }}</td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td>{{ $user->profile->address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date of birth</strong></td>
                            <td>{{ $user->profile->dateofbirth }}</td>
                        </tr>
                        <tr>
                            <td><strong>Professions</strong></td>
                            <td>{{ $user->profile->profession}}</td>
                        </tr>
                        <tr>
                            <td><strong>Comments</strong></td>
                            <td>{{ $user->profile->comments}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @include('layouts.partials.footer')

    </div>
@stop
