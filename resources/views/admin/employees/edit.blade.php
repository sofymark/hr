@extends('layouts.app')
@section('title', trans('messages.employees'))

@section('breadcrumb')
    {!! Breadcrumbs::render('edit-employee', $employee) !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.employees', 'permissionGroup' => 'admin.employees', 'model' => $employee])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ trans('messages.employees') }}</h5>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::model($employee, ['method' => 'PATCH', 'action' => ['Admin\EmployeeController@update', $employee->id]]) !!}
                    @include('admin.employees.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ url('assets') }}/js/moment.min.js"></script>
    <script src="{{ url('assets') }}/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                weekStart: 1,
            });
        });
    </script>
@stop
