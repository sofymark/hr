@extends('layouts.app')
@section('title', trans('messages.permissions'))

@section('breadcrumb')
    {!! Breadcrumbs::render('add-permission') !!}
@stop

@section('content')

    <div class="content">
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{trans('messages.add')}}</h5>
            </div>
            <div class="panel-body">
                {!! Form::model($permission = new \App\Models\Permission, ['url' =>  action('Admin\PermissionController@store') ]) !!}
                @include('admin.permissions.form', ['submitButtonText' => 'Add Permission'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop