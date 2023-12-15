
<h1 style="text-align:center"><strong>ΕΝΤΥΠΟ ΣΤΟΙΧΕΙΩΝ ΕΡΓΑΖΟΜΕΝΟΥ</strong></h1>
<p style="text-align:center">**Εμπιστευτικό**</p>

<p></p>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td style="background-color:#ddd">
            <div><strong>Προσωπικά Στοιχεία</strong></div>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="10" cellpadding="0" width="100%">
                <tr>
                    <td>
                        <div><strong>Επώνυμο</strong></div>
                        <div>{{$employee->surname}}</div>
                    </td>
                    <td>
                        <div><strong>Όνομα</strong></div>
                        <div>{{$employee->name}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Email</strong></div>
                        <div>{{$employee->email}}</div>
                    </td>
                    <td>
                        <div><strong>Ημ/νία Πρόσληψης</strong></div>
                        <div>{{$employee->employeePersonalInfo->hireDate}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Φύλο</strong></div>
                        <div>{{ ($employee->employeePersonalInfo->gender == 0) ? 'Άνδρας' : 'Γυναίκα' }}</div>
                    </td>
                    <td>
                        <div><strong>Υπηκοότητα</strong></div>
                        <div>
                        @foreach($countries as $option)
                            @if ($option->code == $employee->employeePersonalInfo->citizenship)
                                {{$option->description}}
                            @endif
                        @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Όνομα πατέρα</strong></div>
                        <div>{{ $employee->employeePersonalInfo->fatherName }}</div>
                    </td>
                    <td>
                        <div><strong>Όνομα μητέρας</strong></div>
                        <div>{{ $employee->employeePersonalInfo->motherName }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Ημ/νία Γέννησης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->birthDate }}</div>
                    </td>
                    <td>
                        <div><strong>Τόπος γέννησης</strong></div>
                        <div>{{ $employee->employeePersonalInfo->placeBirth }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Διεύθυνση</strong></div>
                        <div>{{ $employee->employeePersonalInfo->address }}</div>
                    </td>
                    <td>
                        <div><strong>Περιοχή</strong></div>
                        <div>{{ $employee->employeePersonalInfo->region }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Ταχυδρομικός Κώδικας</strong></div>
                        <div>{{ $employee->employeePersonalInfo->postalCode }}</div>
                    </td>
                    <td>
                        <div><strong>Πόλη</strong></div>
                        <div>{{ $employee->employeePersonalInfo->city }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Τηλέφωνο</strong></div>
                        <div>{{ $employee->employeePersonalInfo->phone }}</div>
                    </td>
                    <td>
                        <div><strong>Κινητό</strong></div>
                        <div>{{ $employee->employeePersonalInfo->mobilePhone }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>Οικογενειακή Κατάσταση</strong></div>
                        <div>
                            @foreach($selects['maritalStatus'] as $option)
                                @if ($option->code == $employee->employeePersonalInfo->maritalStatus)
                                    {{$option->description}}
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>

                @if($employee->employeePersonalInfo->gender == 0)
                <tr>
                    <td>
                        <div><strong>Στρατιωτικές Υποχρεώσεις</strong></div>
                        <div>
                            @foreach($selects['militaryObligations'] as $option)
                                @if ($option->code == $employee->employeePersonalInfo->militaryObligations)
                                    {{$option->description}}
                                @endif
                            @endforeach
                        </div>
                    </td>
                    @if($employee->employeePersonalInfo->militaryObligations == 2)
                    <td>
                        <div><strong>Λήξη αναβολής</strong></div>
                        <div>{{ $employee->employeePersonalInfo->militaryObligationsExpiryDate }}</div>
                    </td>
                    @endif
                </tr>
                @endif
                <tr>
                    <td>
                        <div><strong>Λογαριασμός Τράπεζας Πειραιώς</strong></div>
                        <div>{{ ($employee->employeePersonalInfo->iban_holder == 1) ? 'Διαθέτω και είμαι ο κύριος δικαιούχος του' : 'Δεν διαθέτω' }}</div>
                    </td>
                    @if($employee->employeePersonalInfo->iban_holder == 1)
                    <td>
                        <div><strong>IBAN Λογαριασμού Τράπεζας Πειραιώς</strong></div>
                        <div>{{ $employee->employeePersonalInfo->iban_number }}</div>
                    </td>
                    @endif
                </tr>
            </table>
        </td>
    </tr>
</table>

@if(isset($employee->protectedMember) && count($employee->protectedMember))
<p></p>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td colspan="3" style="background-color:#ddd">
                <div><strong>Προστατευόμενα Μέλη</strong></div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f7f7f7;"><strong>Ονοματεπώνυμο</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Ημερομηνία γέννησης</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Σχέση</strong></td>
    </tr>
    @if(isset($employee->protectedMember) && count($employee->protectedMember))
        @foreach($employee->protectedMember as $protectedMember)
        <tr>
            <td>{{$protectedMember->protectedMemberLastName}} {{$protectedMember->protectedMemberFirstName}}</td>
            <td>{{Carbon\Carbon::parse($protectedMember->protectedMemberBirthDate)->format('d/m/Y')}}</td>
            <td>{{($protectedMember->protectedMemberRelation == 1) ? 'Σύζυγος' : 'Τέκνο'}}</td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3" style="text-align:center">-</td>
        </tr>
    @endif
</table>
@endif
