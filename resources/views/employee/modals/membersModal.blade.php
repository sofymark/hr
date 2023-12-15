<div id="modal_members" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΣΤΟΙΧΕΙΑ ΜΕΛΟΥΣ</h5>
            </div>
            <div class="modal-body">
                <form id="modal_members_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Επώνυμο: <span class="text-danger">*</span></label>
                                <input type="text" for="protectedMemberLastName" name="protectedMemberLastName" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Όνομα: <span class="text-danger">*</span></label>
                                <input type="text" for="protectedMemberFirstName" name="protectedMemberFirstName" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ημερομηνία Γέννησης: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                                <div class="input-group date datepicker-greek">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" for="protectedMemberBirthDate" name="protectedMemberBirthDate" class="form-control dateuntiltoday datewrongformat" required placeholder="Επιλέξτε ημερομηνία">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Σχέση: <span class="text-danger">*</span></label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="protectedMemberRelation"
                                               for="protectedMemberRelation"
                                               value="1" class="styled" checked="checked">
                                        Σύζυγος
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="protectedMemberRelation"
                                               for="protectedMemberRelation"
                                               value="0" class="styled warning">
                                        Τέκνο
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-add" type="button" data-target="members_list">
                    <span class="glyphicon glyphicon-plus"></span>
                    ΚΑΤΑΧΩΡΗΣΗ
                </button>
            </div>
        </div>
    </div>
</div>
