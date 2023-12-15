@extends('layouts.app')
@section('title', trans('messages.roles'))

@section('breadcrumb')
    {!! Breadcrumbs::render('edit-role', $role) !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.roles', 'permissionGroup' => 'admin.roles', 'model' => $role])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('messages.edit')}}</h5>
            </div>
            <div class="panel-body">
                {!! Form::model($role, ['method' => 'PATCH', 'action' => ['Admin\RoleController@update', $role->id]]) !!}
                @include('admin.roles.form', ['submitButtonText' => 'Update Role'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop