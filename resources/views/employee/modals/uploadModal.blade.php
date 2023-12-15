<div id="modal_default_upload" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close upload-close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">ΑΝΕΒΑΣΜΑ ΑΡΧΕΙΩΝ</h5>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => url('welcome/' . $employee->guid .'/upload/file'), 'class' => 'dropzone','id' => 'dropzoneMultiple']) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link upload-close" data-dismiss="modal">ΚΛΕΙΣΙΜΟ</button>
            </div>
        </div>
    </div>
</div>
