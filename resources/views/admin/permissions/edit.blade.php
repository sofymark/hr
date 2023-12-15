@extends('layouts.app')
@section('title', trans('messages.permissions'))

@section('breadcrumb')
    {!! Breadcrumbs::render('edit-permission', $permission) !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.permissions', 'permissionGroup' => 'admin.permissions', 'model' => $permission])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{  $permission->name }}</h5>
            </div>
            <div class="panel-body">
                {!! Form::model($permission, ['method' => 'PATCH', 'action' => ['Admin\PermissionController@update', $permission->id]]) !!}
                @include('admin.permissions.form', ['submitButtonText' => 'Update Permission'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop