<div id="modal_experience" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΕΠΑΓΓΕΛΜΑΤΙΚΗ ΕΞΕΛΙΞΗ</h5>
            </div>
            <div class="modal-body">
                <form id="modal_experience_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Από Ημερομηνία: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                                <div class="input-group date datepicker-greek">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" for="experienceDateFrom" name="experienceDateFrom" class="form-control dateuntiltoday datewrongformat" placeholder="Επιλέξτε ημερομηνία" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Εώς Ημερομηνία: (ηη/μμ/εεεε)<span class="text-danger">*</span></label>
                                <div class="input-group date datepicker-greek">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" for="experienceDateTo" name="experienceDateTo" class="form-control dateuntiltoday datewrongformat" placeholder="Επιλέξτε ημερομηνία" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Εργοδότης/Εταιρεία: <span class="text-danger">*</span></label>
                                <input type="text" name="experienceCompany" for="experienceCompany" class="form-control" required maxlength="60">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Θέση: <span class="text-danger">*</span></label>
                                <input type="text" name="experiencePosition" for="experiencePosition" class="form-control" required maxlength="40">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-add" type="button" data-target="experience_list">
                    <span class="glyphicon glyphicon-plus"></span>
                    ΚΑΤΑΧΩΡΗΣΗ
                </button>
            </div>
        </div>
    </div>
</div>
