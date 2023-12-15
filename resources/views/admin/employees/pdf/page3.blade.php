<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td colspan="5" style="background-color:#ddd">
                <div><strong>Σπουδές</strong></div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f7f7f7;"><strong>Τίτλος</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Βαθμίδα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Άλλη βαθμίδα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Εκπαιδευτικό ίδρυμα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Τμήμα</strong></td>
    </tr>
    @if(isset($employee->education) && count($employee->education))
        @foreach($employee->education as $education)
        <tr>
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
    @else
        <tr><td colspan="5" style="text-align:center">-</td></tr>
    @endif
</table>

<p></p>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td colspan="5" style="background-color:#ddd">
            <div><strong>Γλώσσες</strong></div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f7f7f7;"><strong>Γλώσσα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Άλλη Γλώσσα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Επίπεδο</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Εκπαιδευτικό ίδρυμα</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Παρακαλώ προσδιορίστε</strong></td>
    </tr>
    @if(isset($employee->language) && count($employee->language))
        @foreach($employee->language as $language)
            <tr>
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
    @else
        <tr><td colspan="5" style="text-align:center">-</td></tr>
    @endif
</table>

<p></p>
<table border="1" cellspacing="0" cellpadding="10" width="100%">
    <tr>
        <td colspan="3" style="background-color:#ddd">
            <div><strong>Πιστοποιήσεις</strong></div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f7f7f7;"><strong>Τίτλος πιστοποίησης</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Φορέας</strong></td>
        <td style="background-color: #f7f7f7;"><strong>Έτος</strong></td>
    </tr>
    @if(isset($employee->certification) && count($employee->certification))
        @foreach($employee->certification as $certification)
        <tr>
            <td>{{$certification->certificationTitle}}</td>
            <td>{{$certification->certificationInstitution}}</td>
            <td>{{$certification->certificationYear}}</td>
        </tr>
        @endforeach
    @else
        <tr><td colspan="3" style="text-align:center">-</td></tr>
    @endif
</table>
