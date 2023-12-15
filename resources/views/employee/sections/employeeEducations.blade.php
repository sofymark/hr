<h6>Σπουδές</h6>
<fieldset>
    <div class="spacer-down">
    </div>
    <div class="panel panel-flat">
        <legend class="panel-title text-semibold">ΣΠΟΥΔΕΣ</legend>
        <div class="panel-heading">
            <span style="display:none;" class="errorMessage alert alert-danger alert-styled-right alert-bordered">Όλα τα πεδία είναι υποχρεωτικά</span>
        </div>
        <table class="table datatable-basic list education_list">
            {{ Form::hidden('education', isset($employee->education ) ? $employee->education : '[]') }}
            {{ Form::hidden(null, '[{"column": "vAttr_educationTitle"}, {"column": "vAttr_educationType"}, {"column": "educationTypeOther"}, {"column": "vAttr_educationInstitution"}, {"column": "educationDepartment"} ]',
            ['class'=> 'tableConfig']) }}
            <thead>
            <tr>
                <th>Τίτλος</th>
                <th>Βαθμίδα</th>
                <th>Άλλη βαθμίδα</th>
                <th>Εκπαιδευτικό ίδρυμα</th>
                <th>Τμήμα</th>
                <th></th>
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
                    <td colspan="6" class="text-center">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_education" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-plus"></span>
                            ΕΙΣΑΓΩΓΗ
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="panel-footer">
            <h7 class="panel-title">Σημείωση: Για την καταχώρηση σπουδών στο εξωτερικό επιλέγετε στο πεδίο της Βαθμίδας την επιλογή <strong>Άλλο, παρακαλώ προσδιορίστε</strong> και συμπληρώνετε το Εκπαιδευτικό Ίδρυμα και τον τίτλο που έχετε λάβει πχ University of London, Master in Finance.</h7>
        </div>
    </div>
</fieldset>
