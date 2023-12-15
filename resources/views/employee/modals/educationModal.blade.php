<div id="modal_education" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΣΠΟΥΔΕΣ</h5>
            </div>
            <div class="modal-body">
                <form id="modal_education_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Τίτλος</label>
                                <select for="educationTitle" name="educationTitle" class="select" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε τίτλο</option>
                                    @foreach($selects['educationTitle'] as $option)
                                        <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Βαθμίδα</label>
                                <select for="educationType" name="educationType" class="select" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε βαθμίδα</option>
                                    @foreach($selects['educationType'] as $option)
                                        <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Προσδιορίστε</label>
                            <div class="form-group">
                                <input type="text" for="educationTypeOther" name="educationTypeOther" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Eκπαιδευτικό Ίδρυμα</label>
                                <select for="educationInstitution" name="educationInstitution" class="select" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε εκπαιδευτικό ίδρυμα</option>
                                    @foreach($selects['educationInstitution'] as $option)
                                       <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Τμήμα</label>
                                <input type="text" for="educationDepartment" name="educationDepartment" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-add" type="button" data-target="education_list">
                    <span class="glyphicon glyphicon-plus"></span>
                    ΚΑΤΑΧΩΡΗΣΗ
                </button>
            </div>
        </div>
    </div>
</div>
