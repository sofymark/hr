@extends('layouts.app')

@section('content')

<!-- Main charts -->
<div class="content">
    @include('message')

    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Προσωπικά Στοιχεία</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Επώνυμο</label>
                                <div>{{ $employee->surname }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Όνομα</label>
                                <div>{{ $employee->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Email</label>
                                <div>{{ $employee->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Κωδικός</label>
                                <div>{{ $employee->guid }}</div>
                            </div>
                        </div>
                    </div>

                @if(isset($employee->employeePersonalInfo))
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημ/νία Πρόσληψης</label>
                                <div>{{ $employee->employeePersonalInfo->hireDate }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Φύλο</label>
                                <div>{{ ($employee->employeePersonalInfo->gender == 0) ? 'Άνδρας' : 'Γυναίκα' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Όνομα πατέρα</label>
                                <div>{{ $employee->employeePersonalInfo->fatherName }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Όνομα μητέρας</label>
                                <div>{{ $employee->employeePersonalInfo->motherName }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημ/νία Γέννησης</label>
                                <div>{{ $employee->employeePersonalInfo->birthDate }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Τόπος γέννησης</label>
                                <div>{{ $employee->employeePersonalInfo->placeBirth }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Υπηκοότητα</label>
                                <div>
                                    @foreach($countries as $option)
                                        @if ($option->code == $employee->employeePersonalInfo->citizenship)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Διεύθυνση</label>
                                <div>{{ $employee->employeePersonalInfo->address }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Περιοχή</label>
                                <div>{{ $employee->employeePersonalInfo->region }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Πόλη</label>
                                <div>{{ $employee->employeePersonalInfo->city }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ταχυδρομικός Κώδικας</label>
                                <div>{{ $employee->employeePersonalInfo->postalCode }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Τηλέφωνο</label>
                                <div>{{ $employee->employeePersonalInfo->phone }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Κινητό</label>
                                <div>{{ $employee->employeePersonalInfo->mobilePhone }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Οικογενειακή Κατάσταση</label>
                                <div>
                                    @foreach($selects['maritalStatus'] as $option)
                                        @if ($option->code == $employee->employeePersonalInfo->maritalStatus)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($employee->employeePersonalInfo->gender == 0)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Στρατιωτικές Υποχρεώσεις</label>
                                <div>
                                    @foreach($selects['militaryObligations'] as $option)
                                        @if ($option->code == $employee->employeePersonalInfo->militaryObligations)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($employee->employeePersonalInfo->militaryObligations == 2)
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Λήξη αναβολής</label>
                                <div>{{ $employee->employeePersonalInfo->militaryObligationsExpiryDate }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Λογαριασμός Τράπεζας Πειραιώς</label>
                                <div>{{ ($employee->employeePersonalInfo->iban_holder == 1) ? 'Διαθέτω και είμαι ο κύριος δικαιούχος του' : 'Δεν διαθέτω' }}</div>
                            </div>
                        </div>
                        @if($employee->employeePersonalInfo->iban_holder == 1)
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>IBAN Λογαριασμού Τράπεζας Πειραιώς</label>
                                <div>{{ $employee->employeePersonalInfo->iban_number }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($employee->protectedMember) && count($employee->protectedMember))
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Προστατευόμενα Μέλη</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic list members_list">
                        <thead>
                            <tr>
                                <th>Ονοματεπώνυμο</th>
                                <th>Ημερομηνία γέννησης</th>
                                <th>Σχέση</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->protectedMember as $protectedMember)
                            <tr class="list-data">
                                <td>{{$protectedMember->protectedMemberLastName}} {{$protectedMember->protectedMemberFirstName}}</td>
                                <td>{{Carbon\Carbon::parse($protectedMember->protectedMemberBirthDate)->format('d/m/Y')}}</td>
                                <td>{{($protectedMember->protectedMemberRelation == 1) ? 'Σύζυγος' : 'Τέκνο'}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->employeePersonalInfo))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Σε περίπτωση ανάγκης ειδοποιήστε</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group">
                                <label>Oνοματεπώνυμο</label>
                                <div>{{ $employee->employeePersonalInfo->emergencyPersonFullName }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group">
                                <label>Τηλέφωνο</label>
                                <div>{{ $employee->employeePersonalInfo->emergencyPersonPhone }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <div class="form-group">
                                <label>Σχέση</label>
                                <div>{{ $employee->employeePersonalInfo->emergencyPersonRelation }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->employeePersonalInfo))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Στοιχεία Ταυτότητας <i>(όπως αναγράφονται στο σχετικό δημόσιο δελτίο)</i></h2>
                </div>
                <div class="panel-body">
                    @if($employee->employeePersonalInfo->identityType == 1)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία έκδοσης</label>
                                <div>{{ $employee->employeePersonalInfo->identityIssueDate }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Αρχή έκδοσης</label>
                                <div>{{ $employee->employeePersonalInfo->identityPublisher }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Αριθμός</label>
                                <div>{{ $employee->employeePersonalInfo->identityId }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($employee->employeePersonalInfo->identityType == 2)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Διαβατήριο</label>
                                <div>{{ $employee->employeePersonalInfo->passportType }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Χώρα</label>
                                <div>{{ $employee->employeePersonalInfo->passportCountry }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Αριθμός</label>
                                <div>{{ $employee->employeePersonalInfo->passportId }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία έκδοσης</label>
                                <div>{{ $employee->employeePersonalInfo->passportIssueDate }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία λήξης</label>
                                <div>{{ $employee->employeePersonalInfo->passportExpiryDate }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($employee->employeePersonalInfo->identityType == 3 || $employee->employeePersonalInfo->identityType == 4)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία έκδοσης άδειας εργασίας</label>
                                <div>{{ $employee->employeePersonalInfo->workPermitIssueDate }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία λήξης άδειας εργασίας</label>
                                <div>{{ $employee->employeePersonalInfo->workPermitExpiryDate }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($employee->employeePersonalInfo->identityType == 5)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ταυτότητα</label>
                                <div>{{ $employee->employeePersonalInfo->identityOther }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->employeePersonalInfo))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Στοιχεία Ασφάλισης <i>(όπως αναγράφονται στα σχετικά δημόσια έγγραφα)</i></h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>ΑΦΜ</label>
                                <div>{{ $employee->employeePersonalInfo->tin }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>ΔΟΥ</label>
                                <div>
                                @foreach($selects['taxoffice'] as $option)
                                    @if ($option->code == $employee->employeePersonalInfo->taxoffice)
                                        {{$option->description}}
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία έναρξης ασφάλισης</label>
                                <div>
                                    @foreach($selects['dateEntryInsurance'] as $option)
                                        @if ($option->code == $employee->employeePersonalInfo->dateEntryInsurance)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>ΑΜΚΑ</label>
                                <div>{{ $employee->employeePersonalInfo->amka }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ημερομηνία αρχικής εγγραφής</label>
                                <div>{{ $employee->employeePersonalInfo->initialDateEntryInsurance }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="form-group">
                                <label>Ασφαλιστικός φορέας</label>
                                <div>
                                    @foreach($selects['insurance'] as $option)
                                        @if ($option->code == $employee->employeePersonalInfo->insurance)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            @if($employee->employeePersonalInfo->insurance == 1 || $employee->employeePersonalInfo->insurance == 2)
                            <div class="form-group">
                                <label>Αριθμός μητρώου ΙΚΑ</label>
                                <div>{{ $employee->employeePersonalInfo->registrationNumberIka }}</div>
                            </div>
                            @endif
                            @if($employee->employeePersonalInfo->insurance == 2)
                            <div class="form-group col-xs-6">
                                <label>Αριθμός δύναμης ΤΣΜΕΔΕ</label>
                                <div>{{ $employee->employeePersonalInfo->powerNumberTsmede }}</div>
                            </div>
                            @endif
                            @if($employee->employeePersonalInfo->insurance == 3)
                            <div class="form-group col-xs-6">
                                <label>Άλλος Ασφαλιστικός φορέας</label>
                                <div>{{ $employee->employeePersonalInfo->insuranceOther }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->education) && count($employee->education))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Σπουδές</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic list education_list">
                        <thead>
                        <tr>
                            <th>Τίτλος</th>
                            <th>Βαθμίδα</th>
                            <th>Άλλη βαθμίδα</th>
                            <th>Εκπαιδευτικό ίδρυμα</th>
                            <th>Τμήμα</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employee->education as $education)
                            <tr class="list-data">
                                <td>
                                    @foreach($selects['educationTitle'] as $option)
                                        @if ($option->code == $education->educationTitle)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($selects['educationType'] as $option)
                                        @if ($option->code == $education->educationType)
                                            {{ implode(' ', array($option->description, $education->educationTypeOther)) }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{$education->educationTypeOther}}
                                </td>
                                <td>
                                    @foreach($selects['educationInstitution'] as $option)
                                        @if ($option->code == $education->educationInstitution)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{$education->educationDepartment}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->language) && count($employee->language))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Γλώσσες</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic list language_list">
                        <thead>
                        <tr>
                            <th>Γλώσσα</th>
                            <th>Άλλη Γλώσσα</th>
                            <th>Επίπεδο</th>
                            <th>Εκπαιδευτικό ίδρυμα</th>
                            <th>Παρακαλώ προσδιορίστε</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employee->language as $language)
                            <tr class="list-data">
                                <td>
                                    @foreach($selects['language'] as $option)
                                        @if ($option->code == $language->language)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$language->languageOther}}</td>
                                <td>
                                    @foreach($selects['languageLevel'] as $option)
                                        @if ($option->code == $language->languageLevel)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($selects['languageInstitution'] as $option)
                                        @if ($option->code == $language->languageInstitution)
                                            {{$option->description}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$language->languageInstitutionOther}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->certification) && count($employee->certification))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Πιστοποιήσεις</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic list certifications_list">
                        <thead>
                        <tr>
                            <th>Τίτλος πιστοποίησης</th>
                            <th>Φορέας</th>
                            <th>Έτος</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employee->certification as $certification)
                            <tr class="list-data">
                                <td>{{$certification->certificationTitle}}</td>
                                <td>{{$certification->certificationInstitution}}</td>
                                <td>{{$certification->certificationYear}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->experience) && count($employee->experience))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Επαγγελματική Εξέλιξη</h2>
                </div>
                <div class="panel-body">
                    <table class="table datatable-basic experience_list list">
                        <thead>
                        <tr>
                            <th>Από</th>
                            <th>Μέχρι</th>
                            <th>Εργοδότης/εταιρία</th>
                            <th>Θέση</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employee->experience as $experience)
                            <tr class="list-data">
                                <td>{{Carbon\Carbon::parse($experience->experienceDateFrom)->format('d/m/Y')}}</td>
                                <td>{{Carbon\Carbon::parse($experience->experienceDateTo)->format('d/m/Y')}}</td>
                                <td>{{$experience->experienceCompany}}</td>
                                <td>{{$experience->experiencePosition}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($employee->employeePersonalInfo))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">Έγγραφα</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                       <div class="col-md-3 col-xs-3">
                          <div class="form-group pt-15">
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('cvDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->cvDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                CV
                                </label>
                             </div>
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('tinDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tinDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                ΑΦΜ
                                </label>
                             </div>
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('maritalStatusDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->maritalStatusDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                Βεβαίωση οικογενειακής κατάστασης
                                </label>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3 col-xs-3">
                          <div class="form-group pt-15">
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('identityDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->identityDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                Δελτίο ταυτότητας (2 όψεις)
                                </label>
                             </div>
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('insuranceDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->insuranceDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                ΑΜ ΙΚΑ - ΑΜΚΑ/Ένσημα
                                </label>
                             </div>
                              <div class="checkbox">
                                  <label>
                                      {{ Form::checkbox('iban_holder', 1,
                                      (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->iban_holder == 1)? true : false,
                                      ['class' => 'styled']) }}
                                      IBAN
                                  </label>
                              </div>
                          </div>
                       </div>
                       <div class="col-md-3 col-xs-3">
                          <div class="form-group pt-15">
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('passDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->passDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                Διαβατήριο
                                </label>
                             </div>
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('tsmedeDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tsmedeDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                ΑΜ ΤΣΜΕΔΕ
                                </label>
                             </div>
                          </div>
                       </div>
                       <div class="col-md-3 col-xs-3">
                          <div class="form-group pt-15">
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('workPermitDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->workPermitDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                Άδεια εργασίας-διαμονής
                                </label>
                             </div>
                             <div class="checkbox">
                                <label>
                                {{ Form::checkbox('certificationDocument', 1,
                                (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->certificationDocument == 1)? true : false,
                                ['class' => 'styled']) }}
                                Πτυχία/πιστοποιήσεις
                                </label>
                             </div>
                          </div>
                       </div>
                    </div>
                    @if(isset($attachments) && count($attachments))
                    <div class="row">
                        <table class="table uploads">
                             <tbody>
                             @foreach ($attachments as $attachment)
                              <tr>
                                  <td><a target="_new" href="{{ $attachment->path }}">{{ $attachment->original_name }}</a></td>
                              </tr>
                             @endforeach
                             </tbody>
                         </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    {!! Form::model($employee, ['method' => 'PATCH', 'action' => ['Admin\EmployeeController@update', $employee->id]]) !!}
                    @include('admin.employees.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

</div>
@stop
