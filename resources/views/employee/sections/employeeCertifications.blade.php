<h6>Πιστοποιήσεις</h6>
<fieldset>
    <div class="spacer-down">
    </div>
    <div class="panel panel-flat">
        <legend class="panel-title text-semibold">ΠΙΣΤΟΠΟΙΗΣΕΙΣ</legend>
        <div class="panel-heading">
            <span style="display:none;" class="errorMessage alert alert-danger alert-styled-right alert-bordered">Όλα τα πεδία είναι υποχρεωτικά</span>
        </div>
        <table class="table datatable-basic list certifications_list">
            {{ Form::hidden('certification', isset($employee->certification ) ? $employee->certification : '[]') }}
            {{ Form::hidden(null, '[{"column": "certificationTitle"}, {"column": "certificationInstitution"}, {"column": "certificationYear"} ]',
            ['class'=> 'tableConfig']) }}
            <thead>
            <tr>
                <th>Τίτλος πιστοποίησης</th>
                <th>Φορέας</th>
                <th>Έτος</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employee->certification as $certification)
                <tr class="list-data">
                    <td>{{$certification->certificationTitle}}</td>
                    <td>{{$certification->certificationInstitution}}</td>
                    <td>{{$certification->certificationYear}}</td>
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
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_certifications" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-plus"></span>
                            ΕΙΣΑΓΩΓΗ
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="panel-footer">
            <h7 class="panel-title">Σημείωση: Αφορά επαγγελματικές πιστοποιήσεις όπως πχ PMI, SAP, CCNA, Oracle, Siebel κ.α.</h7>
        </div>
    </div>
</fieldset>
