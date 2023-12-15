@if(isset($create) && $create)
    <div class="panel-body">
        <div class="form-group required">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', isset($employee->name) ? $employee->name : null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
        </div>

        <div class="form-group required">
            {!! Form::label('surname', 'Surname:') !!}
            {!! Form::text('surname', isset($employee->surname) ? $employee->surname : null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
        </div>

        <div class="form-group required">
            {!! Form::label('alias', 'Alias:') !!}
            {!! Form::text('alias', isset($employee->alias) ? $employee->alias : null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
        </div>

        <div class="form-group required">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control input-lg', 'required' => 'required']) !!}
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Φύλο: <span class="text-danger">*</span></label>

                <div class="row">
                    <div class="col-md-4">
                        <div class="radio">
                            <label>
                                {{ Form::radio('gender', 0,
                                isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->gender == 0 ? 'checked': '',
                                ['class' => 'styled required']) }}
                                Άνδρας
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="radio">
                            <label>
                                {{ Form::radio('gender', 1,
                                    isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->gender == 1 ? 'checked': '',
                                ['class' => 'styled required']) }}
                                Γυναίκα
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label>Ημερομηνία πρόσληψης: <span class="text-danger">*</span></label>

            <div class='input-group date datepicker-greek'>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
                {{ Form::input('text', 'hireDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->hireDate : '',
                ['class' => 'form-control required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
            </div>
        </div>

    </div>

    <div class="panel-footer">
        <a href="{{ action('Admin\EmployeeController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
        <button type="submit" class="btn btn-primary pull-right legitRipple">Save<i class="icon-arrow-right14 position-right"></i></button>
    </div>
@else
    @if($employee->status > 1)
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label('name', 'Status') !!}
                <select class="select" name="status">
                    {{-- <option value="1"{{ ($employee->status == $employee::STATUS_MAIL_SENT) ? ' selected="selected"' : '' }}>Email sent to employee</option> --}}
                    <option value="{{ $employee::STATUS_SAVE_TEMP }}"{{ ($employee->status == $employee::STATUS_SAVE_TEMP) ? ' selected="selected"' : '' }}>Temporary saved</option>
                    <option value="{{ $employee::STATUS_FOR_REVIEW }}"{{ ($employee->status == $employee::STATUS_FOR_REVIEW) ? ' selected="selected"' : '' }}>For Review by HR</option>
                    <option value="{{ $employee::STATUS_COMPLETED }}"{{ ($employee->status == $employee::STATUS_COMPLETED) ? ' selected="selected"' : '' }}>Ready for HCM</option>
                    <option value="{{ $employee::STATUS_HCM_MIGRATED }}"{{ ($employee->status == $employee::STATUS_HCM_MIGRATED) ? ' selected="selected"' : '' }}>Transfer to HCM - OK</option>
                    <option value="{{ $employee::STATUS_HCM_FAILED }}"{{ ($employee->status == $employee::STATUS_HCM_FAILED) ? ' selected="selected"' : '' }}>Tranfrer to HCM - Failed</option>
                </select>
            </div>
        </div>

        <div class="panel-footer">
            <a href="{{ action('Admin\EmployeeController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
            <a href="{{ action('Admin\EmployeeController@pdf', ['id' => $employee->id]) }}" style="margin-left:10px;" target="_new" class="btn btn-success legitRipple pull-left">Print<i class="icon-printer position-right"></i></a>
            <button type="submit" class="btn btn-primary pull-right legitRipple">Save<i class="icon-arrow-right14 position-right"></i></button>

        </div>
    @else

        <div class="panel-footer">
            <a href="{{ action('Admin\EmployeeController@email', ['id' => $employee->id]) }}" class="btn btn-success legitRipple pull-left">Resend Email<i class="icon-envelope position-right"></i></a>
            <a href="{{ action('Admin\EmployeeController@index') }}" class="btn btn-default legitRipple pull-left">Cancel<i class="icon-cross position-right"></i></a>
        </div>

    @endif
@endif
