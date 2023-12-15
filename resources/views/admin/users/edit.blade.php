@extends('layouts.app')
@section('title', trans('messages.users'))

@section('breadcrumb')
    {!! Breadcrumbs::render('edit-user', $user) !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.users', 'permissionGroup' => 'admin.users', 'model' => $user])
        @include('message')
        @include('errors.list')

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">{{ trans('messages.users') }}</h5>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="panel-heading">
                        <h5 class="panel-title">Personal Info</h5>
                    </div>
                    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['Admin\UserController@update', $user->id]]) !!}
                    @include('admin.users.form', ['submitButtonText' => 'Update User'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ url('assets') }}/js/moment.min.js"></script>
    <script src="{{ url('assets') }}/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js"></script>
    <script src="{{ url('assets/js') }}/plugins/uploaders/dropzone.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.date').datepicker({
                format: 'yyyy-mm-dd',
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                weekStart: 1,
            });
            Dropzone.options.avatarForm = {
                paramName: 'image',
                maxFilesize: 5,
                maxFiles: 1,
                uploadMultiple: false,
                clickable:true,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                error: function(file, msg){
                    alert(msg);
                },
                init: function() {
                    var myDropzone = this;
                    myDropzone.on("addedfile", function(file) {
                        $('.dz-default').addClass('hidden');
                    });
                    myDropzone.on("removedfile", function(file) {
                        $('.dz-default').removeClass('hidden');
                        $('#image_id').val(0);
                    });
                },
                success: function(file, response){
                    if(response){
                        $('input[name="image_id"]').val(response);
                    }
                }
            };
        });
    </script>
@stop
