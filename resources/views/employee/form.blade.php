@extends('layouts.front')

@section('header')
    <title>Νέος Εργαζόμενος</title>
@endsection
@section('content')
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="content ">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <div class="site-logo" style="float:left;">
                                <a href="/" title="Αρχική">
                                    <img src="{{ url('/assets/images/singularlogic-logo.png') }}" alt="Αρχική">
                                </a>
                            </div>
                            <div class="page-title"></div>
                        </div>
                        {!! Form::open(['url' => url('welcome/' . $employee->guid . '/store'), 'class' => 'steps-validation']) !!}
                        {{ Form::hidden('employee_id', $employee->id) }}
                        @foreach(['employeePersonalInfo','employeeIdentityInfo', 'employeeEducations', 'employeeLanguage', 'employeeCertifications', 'employeeExperience', 'employeeAttachments'] as $subView)
                            @include( implode('.', array('employee', 'sections', $subView)) )
                        @endforeach
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @foreach(['errorModal', 'legalModal', 'uploadModal', 'membersModal', 'educationModal', 'languageModal', 'certificationsModal', 'experienceModal'] as $modal)
        @include( implode('.', array('employee', 'modals', $modal)) )
    @endforeach
@endsection

@section('footer')
@endsection

@section('script')
<script type="text/javascript">
    base_url = '{{ url('/') }}';
    guid = '{{ $guid }}';
</script>
@endsection
