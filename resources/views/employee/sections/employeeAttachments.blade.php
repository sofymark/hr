<h6>Έγγραφα</h6>
<fieldset>
   <div class="panel-heading">
      <h6 class="panel-title">Επιλέξτε από την ακόλουθη λίστα τα έντυπα που θα επισυνάψετε και κατόπιν <strong>Ανέβασμα Αρχείων</strong>. Μπορείτε να να ανεβάσετε αρχεία word,excel,pdf,zip. Όλα τα έντυπα είναι υποχρεωτικά εφόσον υπάρχουν τα σχετικά δημόσια έγγραφα. Κατόπιν επιλέξτε το πεδίο <strong>Δηλώνω Υπεύθυνα</strong> αφού διαβάσετε τους όρους.</h6>
   </div>
   <div class="row">
      <div class="col-md-3">
         <div class="form-group pt-15">
            <div class="checkbox">
               <label>
               {{ Form::checkbox('cvDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->cvDocument == 1)? true : false,
               ['class' => 'styled']) }}
               CV
               </label>
            </div>
            <div class="checkbox">
               <label>
               {{ Form::checkbox('tinDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tinDocument == 1)? true : false,
               ['class' => 'styled']) }}
               ΑΦΜ
               </label>
            </div>
            <div class="checkbox">
               <label>
               {{ Form::checkbox('maritalStatusDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->maritalStatusDocument == 1)? true : false,
               ['class' => 'styled']) }}
               Βεβαίωση οικογενειακής κατάστασης
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group pt-15">
            <div class="checkbox">
               <label>
               {{ Form::checkbox('identityDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->identityDocument == 1)? true : false,
               ['class' => 'styled']) }}
               Δελτίο ταυτότητας (2 όψεις)
               </label>
            </div>
            <div class="checkbox">
               <label>
                  {{ Form::checkbox('insuranceDocument', 1,
                  (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->insuranceDocument == 1)? true : false,
                  ['class' => 'styled']) }}
                  ΑΜ ΙΚΑ - ΑΜΚΑ/Ένσημα
               </label>
            </div>
            <div class="checkbox">
               <label>
                  {{ Form::checkbox('iban_holder', 1,
                  (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->iban_holder == 1)? true : false,
                  ['class' => 'styled']) }}
                  IBAN
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group pt-15">
            <div class="checkbox">
               <label>
               {{ Form::checkbox('passDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->passDocument == 1)? true : false,
               ['class' => 'styled']) }}
               Διαβατήριο
               </label>
            </div>
            <div class="checkbox">
               <label>
               {{ Form::checkbox('tsmedeDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->tsmedeDocument == 1)? true : false,
               ['class' => 'styled']) }}
               ΑΜ ΤΣΜΕΔΕ
               </label>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="form-group pt-15">
            <div class="checkbox">
               <label>
               {{ Form::checkbox('workPermitDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->workPermitDocument == 1)? true : false,
               ['class' => 'styled']) }}
               Άδεια εργασίας-διαμονής
               </label>
            </div>
            <div class="checkbox">
               <label>
               {{ Form::checkbox('certificationDocument', 1,
               (isset($employee->employeePersonalInfo ) && $employee->employeePersonalInfo->certificationDocument == 1)? true : false,
               ['class' => 'styled']) }}
               Πτυχία/πιστοποιήσεις
               </label>
            </div>
         </div>
      </div>
   </div>
   <div style="margin-bottom:20px;">
   </div>
   <div class="row">
      <div class="col-md-12 text-center">
         <div class="form-group pt-15">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_default_upload" data-backdrop="static" data-keyboard="false">ΑΝΕΒΑΣΜΑ ΑΡΧΕΙΩΝ <i class="icon-play3 position-right"></i></button>
         </div>
      </div>
   </div>
   <div style="margin-bottom:20px;">
   </div>
   <div class="row">
       <div class="col-md-12">
          <table class="table uploads">
               <tbody>
               @foreach ($attachments as $attachment)
                <tr>
                    <td><a target="_new" href="{{ $attachment->path }}">{{ $attachment->original_name }}</a></td>
                    <td class="text-right">
                        <a href="#" data-url="{{ url('welcome/' . $employee->guid . '/delete/file/' . $attachment->id) }}" class="btn btn-danger delete_attachment">- ΔΙΑΓΡΑΦΗ</a>
                    </td>
                </tr>
               @endforeach
               </tbody>
           </table>
       </div>
   </div>
   <div style="margin-bottom:20px;">
   </div>
   <div class="row">
       <div class="col-md-12 text-center">
           <div class="form-group pt-15">
              <div class="col-md-2 col-md-offset-4">
                  <div class="checkbox">
                     <label>
                     <input name="agreeLegal" type="checkbox" class="styled required">
                     Δηλώνω υπεύθυνα ότι:
                     </label>
                  </div>
              </div>
              <div class="col-md-2">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_default_legal" data-backdrop="static" data-keyboard="false">ΔΙΑΒΑΣΤΕ ΤΟΥΣ ΟΡΟΥΣ <i class="icon-play3 position-right"></i></button>
              </div>
           </div>
       </div>
   </div>
   <div style="margin-bottom:40px;">
   </div>
   <div class="row">
      <div class="text-center">
         <h4 class="content-group">
            <small class="display-block">
            Παρακαλούμε ελέγξετε τις καταχωρήσεις σας και πατήστε <strong>ΥΠΟΒΟΛΗ</strong> για την αποστολή των στοιχείων σας.
            </small>
            <small class="display-block">
            <b>ΠΡΟΣΟΧΗ</b> μετά την υποβολή δεν είναι δυνατή η τροποποίηση των στοιχείων σας.
            </small>
         </h4>
      </div>
   </div>
</fieldset>
