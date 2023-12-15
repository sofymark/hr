@extends('layouts.app')
@section('title', trans('messages.roles'))

@section('breadcrumb')
    {!! Breadcrumbs::render('add-role') !!}
@stop

@section('content')

    <div class="content">
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ trans('messages.add') }}</h5>
            </div>
            <div class="panel-body">
                {!! Form::model($role = new \App\Models\Role, ['url' => action('Admin\RoleController@store') ]) !!}
                @include('admin.roles.form', ['submitButtonText' => 'Add Role'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop