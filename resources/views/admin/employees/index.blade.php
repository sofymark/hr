@extends('layouts.app')
@section('title', trans('messages.employees'))
@section('breadcrumb')
    {!! Breadcrumbs::render('employees') !!}
@stop

@section('content')

    <div class="content">
        @include('layouts.partials.tables.bulkactions', ['route' => 'admin.employees', 'permissionGroup' => 'admin.employees', 'hasActivation' => true, 'totalRecords' => count($employees)])
        @include('message')

        <div class="panel panel-flat">
            <table class="table table-hover">
                <thead>
                @include('layouts.partials.tables.header', ['model' => 'App\Models\Employee', 'hideRole' => true])
                </thead>
                <tbody>
                @include('layouts.partials.tables.search', ['route' => 'admin.employees', 'model' => 'App\Models\Employee', 'hideRole' => true, 'permissionGroup' => 'admin.employee', 'totalRecords' => count($employees)])
                @if(count($employees))
                    @foreach( $employees as $employee)
                        <tr>
                            @include('layouts.partials.tables.rowselection', ['model' => $employee, 'permissionGroup' => 'admin.employees'])
                            <td><a href="{{ url('admin/employees/' . $employee->id) }}" class="stable">{{ $employee->surname }}</a></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>
                                @if($employee->status == $employee::STATUS_MAIL_SENT)
                                    Email sent to employee
                                @elseif($employee->status == $employee::STATUS_SAVE_TEMP)
                                    Temporary saved
                                @elseif($employee->status == $employee::STATUS_FOR_REVIEW)
                                    For Review by HR
                                @elseif($employee->status == $employee::STATUS_COMPLETED)
                                    Ready for HCM
                                @elseif($employee->status == $employee::STATUS_HCM_MIGRATED)
                                    Tranfrer to HCM - OK
                                @elseif($employee->status == $employee::STATUS_HCM_FAILED)
                                    Tranfrer to HCM - Failed
                                @endif
                            </td>
                            <td>{{$employee->employeePersonalInfo->hireDate}}</td>
                            @include('layouts.partials.tables.rowactions', ['route' => 'admin.employees', 'model' => $employee, 'permissionGroup' => 'admin.employees'])
                        </tr>
                    @endforeach
                @else
                    @include('layouts.partials.tables.norows')
                @endif
                </tbody>
            </table>
            {!! $employees->appends(request()->all())->render() !!}
        </div>

        @include('layouts.partials.footer')

    </div>
@stop
