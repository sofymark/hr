<div id="modal_language" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΓΛΩΣΣΕΣ</h5>
            </div>
            <div class="modal-body">
                <form id="modal_language_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Γλώσσα</label>
                                <select name="language" for="language" class="select" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε γλώσσα</option>
                                    @foreach($selects['language'] as $option)
                                        <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Προσδιορίστε</label>
                                <input type="text" for="languageOther" name="languageOther" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Επίπεδο</label>
                                <select for="languageLevel" class="select" name="languageLevel" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε επίπεδο</option>
                                    @foreach($selects['languageLevel'] as $option)
                                        <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ινστιτούτο</label>
                                <select for="languageInstitution" class="select" name="languageInstitution" required>
                                    <option value="" data-parent="0" data-id="0">Επιλέξτε ινστιτούτο</option>
                                    @foreach($selects['languageInstitution'] as $option)
                                        <option value="{{$option->code}}" data-parent="{{$option->parentId}}" data-id="{{$option->id}}">{{$option->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Προσδιορίστε</label>
                                <input type="text" for="languageInstitutionOther" name="languageInstitutionOther" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-add" type="button" data-target="language_list">
                    <span class="glyphicon glyphicon-plus"></span>
                    ΚΑΤΑΧΩΡΗΣΗ
                </button>
            </div>
        </div>
    </div>
</div>
