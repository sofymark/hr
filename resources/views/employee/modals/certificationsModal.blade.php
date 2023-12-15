<div id="modal_certifications" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΠΙΣΤΟΠΟΙΗΣΕΙΣ</h5>
            </div>
            <div class="modal-body">
                <form id="modal_certifications_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Τίτλος πιστοποίησης: <span class="text-danger">*</span></label>
                                <input type="text" for="certificationTitle" name="certificationTitle" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Φορέας: <span class="text-danger">*</span></label>
                                <input type="text" for="certificationInstitution" name="certificationInstitution" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Έτος: <span class="text-danger">*</span></label>
                                <input type="text" for="certificationYear" name="certificationYear" class="form-control" maxlength="4" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-add" type="button" data-target="certifications_list">
                    <span class="glyphicon glyphicon-plus"></span>
                    ΚΑΤΑΧΩΡΗΣΗ
                </button>
            </div>
        </div>
    </div>
</div>
