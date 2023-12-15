@extends('layouts.app')
@section('title', trans('messages.employees'))

@section('breadcrumb')
    {!! Breadcrumbs::render('add-employee') !!}
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
                <div class="col-md-12">
                    {!! Form::model($employee = new \App\Models\Employee, ['url' => action('Admin\EmployeeController@store')]) !!}
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
