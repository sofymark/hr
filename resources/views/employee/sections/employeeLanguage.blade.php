<h6>Γλώσσες</h6>
<fieldset>
    <div class="spacer-down">
    </div>
    <div class="panel panel-flat">
        <legend class="panel-title text-semibold">ΓΛΩΣΣΕΣ</legend>
        <div class="panel-heading">
            <span style="display:none;" class="errorMessage alert alert-danger alert-styled-right alert-bordered">Όλα τα πεδία είναι υποχρεωτικά</span>
        </div>
        <table class="table datatable-basic list language_list">
            {{ Form::hidden('language', isset($employee->language ) ? $employee->language : '[]') }}
            {{ Form::hidden(null, '[{"column": "vAttr_language"}, {"column": "languageOther"}, {"column": "vAttr_languageLevel"}, {"column": "vAttr_languageInstitution"}, {"column": "languageInstitutionOther"} ]',
            ['class'=> 'tableConfig']) }}
            <thead>
            <tr>
                <th>Γλώσσα</th>
                <th>Άλλη Γλώσσα</th>
                <th>Επίπεδο</th>
                <th>Εκπαιδευτικό ίδρυμα</th>
                <th>Παρακαλώ προσδιορίστε</th>
                <th></th>
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
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_language" data-backdrop="static" data-keyboard="false">
                            <span class="glyphicon glyphicon-plus"></span>
                            ΕΙΣΑΓΩΓΗ
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="panel-footer">
            <h7 class="panel-title">Σημείωση: Για την καταχώρηση γλώσσας εκτός Αγγλικών και Γαλλικών επιλέξτε <strong>Άλλη, παρακαλώ προσδιορίστε</strong> και συμπληρώστε τη γλώσσα, τον τίτλο που έχετε λάβει και το Εκπαιδευτικό Ίδρυμα πχ Ισπανικά, Superior, Dele.</h7>
        </div>
    </div>
</fieldset>
