@yield('personalInfo')
<h6>Στοιχεία ταυτότητας</h6>
<fieldset>
    <legend class="text-bold">ΣΤΟΙΧΕΙΑ ΤΑΥΤΟΤΗΤΑΣ <i>(όπως αναγράφονται στο σχετικό δημόσιο δελτίο)</i></legend>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Τύπος: <span class="text-danger">*</span></label>
                <select name="identityType" class="select" required>
                    <option value="">Επιλέξτε τύπο ταυτότητας</option>
                    @foreach($selects['identityType'] as $option)
                        @if ((isset($employee->employeePersonalInfo))
                        && ( $employee->employeePersonalInfo->identityType == $option->code))
                            <option value="{{$option->code}}" selected>{{$option->description}}</option>
                        @else
                            <option value="{{$option->code}}">{{$option->description}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="indentityInfo"
         style="display:{{ ( isset($employee->employeePersonalInfo) && $employee->employeePersonalInfo->identityType == 1) ? 'block' : 'none' }};" data-insurance="1">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία έκδοσης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'identityIssueDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->identityIssueDate : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Αρχή έκδοσης: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'identityPublisher',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->identityPublisher : '',
                        ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Αριθμός: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'identityId',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->identityId : '',
                        ['class' => 'form-control','required']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="passportInfo"
         style="display:{{ (isset($employee->employeePersonalInfo) && $employee->employeePersonalInfo->identityType == 2) ? 'block' : 'none' }};" data-insurance="2">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Διαβατήριο: </label>
                    <select name="passportType" class="select" required>
                        <option value="">Επιλέξτε</option>
                        @foreach($selects['passportType'] as $option)
                            @if ((isset($employee->employeePersonalInfo))
                            && ( $employee->employeePersonalInfo->passportType == $option->code))
                                <option value="{{$option->code}}" selected>{{$option->description}}</option>
                            @else
                                <option value="{{$option->code}}">{{$option->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Χώρα: <span class="text-danger">*</span></label>
                    <select name="passportCountry" class="select" required>
                        <option value="">Επιλέξτε Χώρα</option>
                        @foreach($countries as $country)
                            @if ((isset($employee->employeePersonalInfo))
                            && ( $employee->employeePersonalInfo->passportCountry == $country->code))
                                <option value="{{$country->code}}" selected>{{$country->description}}</option>
                            @else
                                <option value="{{$country->code}}">{{$country->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Αριθμός: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'passportId',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->passportId : '',
                        ['class' => 'form-control', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία έκδοσης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'passportIssueDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->passportIssueDate : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία λήξης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'passportExpiryDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->passportExpiryDate : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="workPemitInfo"
         style="display:{{ (isset($employee->employeePersonalInfo) && ($employee->employeePersonalInfo->identityType == 3 || $employee->employeePersonalInfo->identityType == 4)) ? 'block' : 'none' }};" data-insurance="3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία έκδοσης άδειας εργασίας: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'workPermitIssueDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->workPermitIssueDate : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία λήξης άδειας εργασίας: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'workPermitExpiryDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->workPermitExpiryDate : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="identityOther"
         style="display:{{ (isset($employee->employeePersonalInfo) && $employee->employeePersonalInfo->identityType == 5) ? 'block' : 'none' }};" data-insurance="5">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Προσδιορίστε τύπο ταυτότητας:  <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'identityOther',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->identityOther : '',
                        ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="insuranceInfo">
        <legend class="text-bold">ΣΤΟΙΧΕΙΑ ΑΣΦΑΛΙΣΗΣ <i>(όπως αναγράφονται στα σχετικά δημόσια έγγραφα)</i></legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ΑΦΜ: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'tin',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->tin : '',
                        ['class' => 'form-control tin', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>ΔΟΥ:
                        <span class="text-danger">*</span>
                    </label>
                    <select name="taxoffice" class="select" required>
                        <option value="">Επιλέξτε</option>
                        @foreach($selects['taxoffice'] as $option)
                            @if ((isset($employee->employeePersonalInfo))
                            && ( $employee->employeePersonalInfo->taxoffice == $option->code))
                                <option value="{{$option->code}}" selected>{{$option->description}}</option>
                            @else
                                <option value="{{$option->code}}">{{$option->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία έναρξης ασφάλισης: <span class="text-danger">*</span></label>
                    <select name="dateEntryInsurance" class="select" required>
                        <option value="">Επιλέξτε ημερομηνία</option>
                        @foreach($selects['dateEntryInsurance'] as $option)
                            @if ((isset($employee->employeePersonalInfo))
                            && ( $employee->employeePersonalInfo->dateEntryInsurance == $option->code))
                                <option value={{$option->code}} selected>{{$option->description}}</option>
                            @else
                                <option value={{$option->code}}>{{$option->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>ΑΜΚΑ: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'amka',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->amka : '',
                        ['class' => 'form-control amka required']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Λαμβάνετε επίδομα ανεργίας από Ο.Α.Ε.Δ;: <span class="text-danger">*</span></label>
                    <select name="unemployment_insurance" class="select required" required>
                        <option value="">Παρακαλώ επιλέξτε</option>
                        <option value="1" {{ (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->unemployment_insurance === 1))) ? 'selected' : '' }}>Ναί</option>
                        <option value="0" {{ (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->unemployment_insurance === 0))) ? 'selected' : '' }}>Οχι</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 unemployment_insurance_service" style="display:{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->unemployment_insurance === 1) ? '' : 'none'}};">
                <div class="form-group">
                    <label>Υπηρεσία ΟΑΕΔ από την οποία λαμβάνετε επίδομα ανεργίας (πχ ΟΑΕΔ Κηφισιάς). <span class="text-danger"></span></label>
                    {{ Form::input('text', 'unemployment_insurance_service', (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->unemployment_insurance_service))) ? $employee->employeePersonalInfo->unemployment_insurance_service : '',
             ['class' => 'form-control required unemployment_insurance']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ημερομηνία αρχικής εγγραφής: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                    <div class='input-group date datepicker-greek'>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        {{ Form::input('text', 'initialDateEntryInsurance',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->initialDateEntryInsurance : '',
                        ['class' => 'form-control dateuntiltoday datewrongformat', 'required', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ασφαλιστικός φορέας: <span class="text-danger">*</span></label>
                    <select name="insurance" class="select required">
                        <option value="">Επιλέξτε</option>
                        @foreach($selects['insurance'] as $option)
                            @if ((isset($employee->employeePersonalInfo))
                            && ( $employee->employeePersonalInfo->insurance == $option->code))
                                <option value={{$option->code}} selected>{{$option->description}}</option>
                            @else
                                <option value={{$option->code}}>{{$option->description}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" style="display:none;">
                    <label>Αριθμός μητρώου ΙΚΑ: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'registrationNumberIka',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->registrationNumberIka : '',
                        ['class' => 'form-control', 'required', 'disabled']) }}
                </div>
                <div class="form-group" style="display:none;">
                    <label>Αριθμός δύναμης ΤΣΜΕΔΕ: <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'powerNumberTsmede',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->powerNumberTsmede : '',
                        ['class' => 'form-control', 'required', 'disabled']) }}
                </div>
                <div class="form-group" style="display:none;">
                    <label>Προσδιορίστε ασφαλιστικό φορέα:  <span class="text-danger">*</span></label>
                    {{ Form::input('text', 'insuranceOther',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->insuranceOther : '',
                        ['class' => 'form-control', 'required', 'disabled']) }}
                </div>
            </div>
        </div>
    </div>
</fieldset>
