<h6>Προσωπικά στοιχεία</h6>
<fieldset>
    <legend class="text-bold">ΠΡΟΣΩΠΙΚΑ ΣΤΟΙΧΕΙΑ</legend>
    <div class="row">
        <div class="col-md-6">
            <label>Ημερομηνία πρόσληψης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>

            <div class='input-group date datepicker-greek'>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                {{ Form::input('text', 'hireDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->hireDate : '',
                ['class' => 'form-control required dateuntiltoday datewrongformat', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Φύλο: <span class="text-danger">*</span></label>

                <div class="row">
                    <div class="col-md-4">
                        <div class="radio">
                            <label>
                                {{ Form::radio('gender', 0,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->gender == 0)? true : false,
                                ['class' => 'styled required']) }}
                                Άνδρας
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="radio">
                            <label>
                                {{ Form::radio('gender', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->gender == '1')? true : false,
                                ['class' => 'styled required']) }}
                                Γυναίκα
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Επώνυμο: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'surname',isset($employee) ? $employee->surname : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Όνομα: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'name',isset($employee) ? $employee->name : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Όνομα πατέρα: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'fatherName',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->fatherName : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Όνομα μητέρας: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'motherName',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->motherName : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label>Ημερομηνία γέννησης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
            <div class='input-group date datepicker-greek'>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                {{ Form::input('text', 'birthDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->birthDate : '',
                ['class' => 'form-control required dateuntiltoday datewrongformat', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Τόπος γέννησης: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'placeBirth',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->placeBirth : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Υπηκοότητα: <span class="text-danger">*</span></label>
                <select name="citizenship" class="select required">
                    <option value="">Επιλέξτε Υπηκοότητα</option>
                    @foreach($countries as $country)
                        @if ((isset($employee->employeePersonalInfo))
                        && ( $employee->employeePersonalInfo->citizenship == $country->code))
                            <option value={{$country->code}} selected>{{$country->description}}</option>
                        @else
                            @if ($country->code == 1)
                                <option value={{$country->code}} selected>{{$country->description}}</option>
                            @else
                                <option value={{$country->code}}>{{$country->description}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Διεύθυνση κατοικίας: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'address',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->address : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Περιοχή: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'region',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->region : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Πόλη: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'city',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->city : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Ταχυδρομικός Κώδικας: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'postalCode',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->postalCode : '',
                ['class' => 'form-control zip required', 'maxlength' => '5']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
				<label>Τηλέφωνο σταθερό: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'phone',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->phone : '',
                ['class' => 'form-control phone']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Τηλέφωνο κινητό: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'mobilePhone',isset($employee->employeePersonalInfo) ? $employee->employeePersonalInfo->mobilePhone : '',
                ['class' => 'form-control phone required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Email: <span class="text-danger">*</span></label>
                {{ Form::input('email', 'email', $employee->email,
                ['class' => 'form-control required', 'disabled', 'placeholder' => 'your@email.com']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Oικογενειακή κατάσταση : <span class="text-danger">*</span></label>
                <select name="maritalStatus" class="select required">
                    <option value="">Επιλέξτε οικογενειακή κατάσταση</option>
                    @foreach($selects['maritalStatus'] as $option)
                        @if ((isset($employee->employeePersonalInfo))
                        && ( $employee->employeePersonalInfo->maritalStatus == $option->code))
                            <option value={{$option->code}} selected>{{$option->description}}</option>
                        @else
                            <option value={{$option->code}}>{{$option->description}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row militaryObligationsRow" style="display:{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->gender == 1) ? 'none' : ''}};">
        <div class="col-md-6">
            <div class="form-group">
                <label>Στρατιωτικές υποχρεώσεις: <span class="text-italic">(μόνο για άνδρες)</span></label>
                <select name="militaryObligations" class="select">
                    <option value="">Επιλέξτε</option>
                    @foreach($selects['militaryObligations'] as $option)
                        @if ((isset($employee->employeePersonalInfo))
                        && ( $employee->employeePersonalInfo->militaryObligations == $option->code))
                            <option value={{$option->code}} selected>{{$option->description}}</option>
                        @else
                            <option value={{$option->code}}>{{$option->description}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 militaryObligationsExpiryDateCol">
            <label>Λήξη αναβολής: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
            <div class='input-group date datepicker-greek'>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                {{ Form::input('text', 'militaryObligationsExpiryDate',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->militaryObligationsExpiryDate : '',
                ['class' => 'form-control required dateuntiltoday datewrongformat', 'placeholder'=> 'Επιλέξτε ημερομηνία']) }}
            </div>
        </div>
    </div>

    <div class="row iban">
        <div class="col-md-6">
            <div class="form-group">
                <label>Λογαριασμός Τράπεζας Πειραιώς: <span class="text-danger">*</span></label>
                <select name="iban_holder" class="select required">
                    <option value="">Επιλέξτε</option>
                    <option value="1" {{ (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->iban_holder === 1))) ? 'selected' : '' }}>Διαθέτω και είμαι ο κύριος δικαιούχος του</option>
                    <option value="0" {{ (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->iban_holder === 0))) ? 'selected' : '' }}>Δεν διαθέτω</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 iban_number" style="display:{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->iban_holder === 1) ? '' : 'none'}};">
            <div class="form-group">
                <label>Iban Λογαριασμού τράπεζας Πειραιώς: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'iban_number', (((isset($employee->employeePersonalInfo)) && ( $employee->employeePersonalInfo->iban_number))) ? $employee->employeePersonalInfo->iban_number : 'GR',
                ['class' => 'form-control required iban']) }}
            </div>
        </div>
    </div>
    <div class="spacer-down">
    </div>

    <div class="panel panel-flat">
        <legend class="panel-title text-semibold">ΠΡΟΣΤΑΤΕΥΟΜΕΝΑ ΜΕΛΗ (Σύζυγος - Τέκνα)</legend>
        <div class="panel-heading">
            <span style="display:none;" class="errorMessage alert alert-danger alert-styled-right alert-bordered">Όλα τα πεδία είναι υποχρεωτικά</span>
        </div>

        <table class="table datatable-basic list members_list">
        {{ Form::hidden('protectedMember', isset($employee->protectedMember ) ? $employee->protectedMember : '[]') }}
            {{ Form::hidden(null, '[{"column": "protectedMemberLastName"},{"column": "protectedMemberFirstName"}, {"column": "protectedMemberBirthDate"}, {"column": "vAttr_protectedMemberRelation"} ]',
            ['class'=> 'tableConfig']) }}
            <thead>
            <tr>
                <th>Επώνυμο</th>
                <th>Όνομα</th>
                <th>Ημερομηνία γέννησης</th>
                <th>Σχέση</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employee->protectedMember as $protectedMember)
                <tr class="list-data">
                    <td>{{$protectedMember->protectedMemberLastName}}</td>
                    <td>{{$protectedMember->protectedMemberFirstName}}</td>
                    <td>{{Carbon\Carbon::parse($protectedMember->protectedMemberBirthDate)->format('d/m/Y')}}</td>
                    <td>{{($protectedMember->protectedMemberRelation == 1) ? 'Σύζυγος' : 'Τέκνο'}}</td>
                    <td class="text-right">
                        <button class="btn btn-danger btn-remove" type="button">
                            <span class="glyphicon glyphicon-minus"></span>ΑΦΑΙΡΕΣΗ
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-center">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_members" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-plus"></span>
                            ΕΙΣΑΓΩΓΗ
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <legend class="text-bold">ΣΕ ΠΕΡΙΠΤΩΣΗ ΑΝΑΓΚΗΣ ΠΑΡΑΚΑΛΩ ΕΙΔΟΠΟΙΗΣΤΕ</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Oνοματεπώνυμο: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'emergencyPersonFullName',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->emergencyPersonFullName : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Τηλέφωνο: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'emergencyPersonPhone',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->emergencyPersonPhone : '',
                ['class' => 'form-control required phone']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Σχέση: <span class="text-danger">*</span></label>
                {{ Form::input('text', 'emergencyPersonRelation',isset($employee->employeePersonalInfo )?$employee->employeePersonalInfo->emergencyPersonRelation : '',
                ['class' => 'form-control required']) }}
            </div>
        </div>
    </div>
</fieldset>
