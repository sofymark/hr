<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td style="background-color:#ddd">
            <div><strong>Έγγραφα</strong></div>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="10" cellpadding="0" width="100%">
                <tr>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->cvDocument == 1) ? '&#x2713;' : '&#x25a1;' }} CV</td>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tinDocument == 1) ? '&#x2713;' : '&#x25a1;' }} ΑΦΜ</td>
                </tr>

                <tr>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->maritalStatusDocument == 1) ? '&#x2713;' : '&#x25a1;' }} Βεβαίωση οικογενειακής κατάστασης</td>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->identityDocument == 1) ? '&#x2713;' : '&#x25a1;' }} Δελτίο ταυτότητας (2 όψεις)</td>
                </tr>

                <tr>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->insuranceDocument == 1) ? '&#x2713;' : '&#x25a1;' }} ΑΜ ΙΚΑ - ΑΜΚΑ/Ένσημα</td>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->passDocument == 1) ? '&#x2713;' : '&#x25a1;' }} Διαβατήριο</td>
                </tr>

                <tr>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tsmedeDocument == 1) ? '&#x2713;' : '&#x25a1;' }} ΑΜ ΤΣΜΕΔΕ</td>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->workPermitDocument == 1) ? '&#x2713;' : '&#x25a1;' }} Άδεια εργασίας-διαμονής</td>
                </tr>
                <tr>
                    <td>{{ (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->workPermitDocument == 1) ? '&#x2713;' : '&#x25a1;' }}  Πτυχία/πιστοποιήσεις</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<p></p>
<p>Ο κάτωθι υπογεγραμμένος δηλώνω υπεύθυνα ότι:</p>

<p>
    @include('admin.employees.legalNotice')
</p>

<p></p>
<p></p>

<p style="text-align:center">
    Κηφισιά {{ date('d/m/Y') }}
</p>
<p></p>
<p></p>
<p></p>
<p></p>
<p style="text-align:center">
.............................
</p>
<p style="text-align:center">
**Εμπιστευτικό**
</p>
