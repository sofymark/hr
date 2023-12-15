<h6>Επαγγελματική πορεία</h6>
<fieldset>
    <div class="spacer-down">
    </div>
    <div class="panel panel-flat">
        <legend class="panel-title text-semibold">ΕΠΑΓΓΕΛΜΑΤΙΚΗ ΠΟΡΕΙΑ</legend>
        <div class="panel-heading">
            <span style="display:none;" class="errorMessage alert alert-danger alert-styled-right alert-bordered">Όλα τα πεδία είναι υποχρεωτικά</span>
        </div>
        <table class="table datatable-basic experience_list list">
            {{ Form::hidden('experience', isset($employee->experience ) ? $employee->experience : '[]') }}
            {{ Form::hidden(null, '[{"column": "experienceDateFrom"}, {"column": "experienceDateTo"}, {"column": "experienceCompany"}, {"column": "experiencePosition"} ]',
            ['class'=> 'tableConfig']) }}
            <thead>
            <tr>
                <th>Από</th>
                <th>Μέχρι</th>
                <th>Εργοδότης/εταιρία</th>
                <th>Θέση</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employee->experience as $experience)
                <tr class="list-data">
                    <td>{{ Carbon\Carbon::parse($experience->experienceDateFrom)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($experience->experienceDateTo)->format('d/m/Y') }}</td>
                    <td>{{$experience->experienceCompany}}</td>
                    <td>{{$experience->experiencePosition}}</td>
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
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_experience" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-plus"></span>
                            ΕΙΣΑΓΩΓΗ
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</fieldset>
