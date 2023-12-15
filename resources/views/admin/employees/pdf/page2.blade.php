<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td colspan="3" style="background-color:#ddd">
                <div><strong>Σε περίπτωση ανάγκης ειδοποιήστε</strong></div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f7f7f7;"><strong>Ονοματεπώνυμο</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Τηλέφωνο</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Σχέση</strong></td>
    </tr>
    <tr>
        <td>{{$employee->employeePersonalInfo->emergencyPersonFullName}}</td>
        <td>{{$employee->employeePersonalInfo->emergencyPersonPhone}}</td>
        <td>{{$employee->employeePersonalInfo->emergencyPersonRelation}}</td>
    </tr>
</table>
<p></p>


<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td style="background-color:#ddd">
            <div><strong>Στοιχεία Ταυτότητας</strong> <i>(όπως αναγράφονται στο σχετικό δημόσιο δελτίο)</i></div>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="10" cellpadding="0" width="100%">
                @if($employee->employeePersonalInfo->identityType == 1)
                <tr>
                    <td>
                        <div><strong>Ημερομηνία έκδοσης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->identityIssueDate }}</div>
                    </td>
                    <td>
                        <div><strong>Αρχή έκδοσης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->identityPublisher }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Αριθμός</strong></div>
                        <div>{{ $employee->employeePersonalInfo->identityId }}</div>
                    </td>
                </tr>
                @endif
                @if($employee->employeePersonalInfo->identityType == 2)
                <tr>
                    <td>
                        <div><strong>Διαβατήριο</strong></div>
                        <div>{{ $employee->employeePersonalInfo->passportType }}</div>
                    </td>
                    <td>
                        <div><strong>Χώρα</strong></div>
                        <div>{{ $employee->employeePersonalInfo->passportCountry }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Αριθμός</strong></div>
                        <div>{{ $employee->employeePersonalInfo->passportId }}</div>
                    </td>
                    <td>
                        <div><strong>Ημερομηνία έκδοσης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->passportIssueDate }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Ημερομηνία λήξης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->passportExpiryDate }}</div>
                    </td>
                </tr>
                @endif
                @if($employee->employeePersonalInfo->identityType == 3 || $employee->employeePersonalInfo->identityType == 4)
                <tr>
                    <td>
                        <div><strong>Ημερομηνία έκδοσης άδειας εργασίας</strong></div>
                        <div>{{ $employee->employeePersonalInfo->workPermitIssueDate }}</div>
                    </td>
                    <td>
                        <div><strong>Ημερομηνία λήξης άδειας εργασίας</strong></div>
                        <div>{{ $employee->employeePersonalInfo->workPermitExpiryDate }}</div>
                    </td>
                </tr>
                @endif
                @if($employee->employeePersonalInfo->identityType == 5)
                <tr>
                    <td>
                        <div><strong>Ταυτότητα</strong></div>
                        <div>{{ $employee->employeePersonalInfo->identityOther }}</div>
                    </td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
<p></p>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td style="background-color:#ddd">
            <div><strong>Στοιχεία Ασφάλισης</strong> <i>όπως αναγράφονται στα σχετικά έγγραφα)</i></div>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="10" cellpadding="0" width="100%">
                <tr>
                    <td>
                        <div><strong>ΑΦΜ</strong></div>
                        <div>{{ $employee->employeePersonalInfo->tin }}</div>
                    </td>
                    <td>
                        <div><strong>ΔΟΥ</strong></div>
                        <div>
                            @foreach($selects['taxoffice'] as $option)
                                @if ($option->code == $employee->employeePersonalInfo->taxoffice)
                                    {{$option->description}}
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Ημερομηνία έναρξης ασφάλισης</strong></div>
                        <div>
                            @foreach($selects['dateEntryInsurance'] as $option)
                                @if ($option->code == $employee->employeePersonalInfo->dateEntryInsurance)
                                    {{$option->description}}
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>ΑΜΚΑ</strong></div>
                        <div>{{ $employee->employeePersonalInfo->amka }}</div>
                    </td>
                    <td>
                        <div><strong>Ημερομηνία αρχικής εγγραφής</strong></div>
                        <div>{{ $employee->employeePersonalInfo->initialDateEntryInsurance }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Ασφαλιστικός φορέας</strong></div>
                        <div>
                            @foreach($selects['insurance'] as $option)
                                @if ($option->code == $employee->employeePersonalInfo->insurance)
                                    {{$option->description}}
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
                @if($employee->employeePersonalInfo->insurance == 1 || $employee->employeePersonalInfo->insurance == 2)
                <tr>
                    <td>
                        <div><strong>Αριθμός μητρώου ΙΚΑ</strong></div>
                        <div>{{ $employee->employeePersonalInfo->registrationNumberIka }}</div>
                    </td>
                    @if($employee->employeePersonalInfo->insurance == 2)
                    <td>
                        <div><strong>Αριθμός δύναμης ΤΣΜΕΔΕ</strong></div>
                        <div>{{ $employee->employeePersonalInfo->powerNumberTsmede }}</div>
                    </td>
                    @endif
                </tr>
                @endif
                @if($employee->employeePersonalInfo->insurance == 3)
                <tr>
                    <td>
                        <div><strong>Άλλος Ασφαλιστικός φορέας</strong></div>
                        <div>{{ $employee->employeePersonalInfo->insuranceOther }}</div>
                    </td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>
