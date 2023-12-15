function yearValidation(year) {
    var text = /^[0-9]+$/;
    if (year != 0) {
        if ((year != "") && (!text.test(year))) {
            return false;
        }
        if (year.length != 4) {
            return false;
        }
        var current_year = new Date().getFullYear();
        if ((year < 1920) || (year > (current_year + 1))) {
            return false;
        }
        return true;
    }
}
 
function initValidation()
{

    $('#modal_members_form,#modal_language_form,#modal_education_form,#modal_certifications_form,#modal_experience_form').each(function(){
        $(this).validate({
           ignore: ":disabled",
           errorElement: 'span',
           errorClass: 'has-error',
           validClass: 'has-success',
           highlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").addClass(errorClass);
           },
           unhighlight: function (element, errorClass, validClass) {
                $(element).closest(".form-group").removeClass(errorClass);
           },
           errorPlacement: function(error, element) {
               error.addClass('help-block');
               error.appendTo($(element).closest(".form-group"));
           }
       });
   });

   $.validator.addMethod("datewrongformat", function(value, element) {
           varData = value;

       if (varData.split("/").length === 3) {
           var dateSegments = varData.split("/"),
               y = dateSegments[2];

            return (y.length == 4);
       }
       return true;
   }, function(params, element) {
       return 'Μη αποδεκτή ημερομηνία. Δοκιμάστε με φόρμα (ΗΗ/ΜΜ/ΕΕΕΕ)'
    });

    $.validator.addMethod("iban", function(value, element, regexpr) {
        return IBAN.isValid(value);
    }, "Μη αποδεκτό IBAN");

    $.validator.addMethod("dateuntiltoday", function(value, element) {
            varData = value;

        if (varData.split("/").length === 3) {
            var dateSegments = varData.split("/"),
                year = dateSegments[2];

            return yearValidation(year);

        }
    }, function(params, element) {
        return 'Μη αποδεκτή ημερομηνία.'
     });

   $.validator.addClassRules({
       tin: {
           required: true,
           digits: true,
           minlength: 9,
           maxlength: 12
       },
       zip: {
           required: true,
           digits: true,
           minlength: 5,
           maxlength: 5
       },
       phone: {
           required: true,
           digits: true,
           minlength: 10,
           maxlength: 10
       },
       amka: {
           required: true,
           digits: true,
           minlength: 11,
           maxlength: 11
       },
       iban: {
           iban: true
       }
   });

    $(".steps-validation").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        // Different components require proper error label placement
        errorPlacement: function (error, element) {
            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }
            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }
            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }
            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }
            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }
            else {
                error.insertAfter(element);
            }
        },
        rules: {
            email: {
                email: true
            }
        }
    });
}

function initPlugins()
{
    Dropzone.options.dropzoneMultiple = {
        init: function() {
            this.on("sending", function(file) {
                console.log('sending');
                $('#modal_default_upload .upload-close').hide();
            });
            this.on("queuecomplete", function() {
                console.log('queuecomplete');
                $('#modal_default_upload .upload-close').show();
            });
        }
    };

    // Date Picker
    $.fn.datepicker.dates['el'] = {
        days: ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο", "Κυριακή"],
        daysShort: ["Κυρ", "Δευ", "Τρι", "Τετ", "Πεμ", "Παρ", "Σαβ", "Κυρ"],
        daysMin: ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα", "Κυ"],
        months: ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάιος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"],
        monthsShort: ["Ιαν", "Φεβ", "Μαρ", "Απρ", "Μάι", "Ιουν", "Ιουλ", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"],
        today: "Σήμερα"
    };

    $('.datepicker-greek').datepicker({
        todayBtn: "linked",
        language: "el",
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',
        minDate:'01/01/1920',
        maxDate:'01/01/2050'
    });

    $('.datepicker-greek').on('changeDate', function() {

        var elem = $(this).find('input.form-control'),
            varData = elem.val();

        if (varData.split("/").length === 3) {
            var dateSegments = varData.split("/"),
                year = dateSegments[2];

            if (year.length > 4) {
                year = year.substring(0, 4);
                $(this).datepicker("update", "dateSegments[0] + '/' + dateSegments[1] + '/' + year");
            }
        }
    });




    // Select2 selects
    $('.select').select2();

    // Simple select without search
    $('.select-simple').select2({
        minimumResultsForSearch: Infinity
    });

    // Styled checkboxes and radios
    $('.styled').uniform({
        radioClass: 'choice'
    });

    // Styled file input
    $('.file-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });

    $('button.upload-close').click(function(e){

        var table = $('table.uploads > tbody');

        $.ajax({
            type  : 'GET',
            url   : base_url + '/welcome/' + guid + '/attachments' ,
            data  : null,
            cache : false,
            dataType : 'json',
            beforeSend : function() {},
            success : function(data) {
                $.each( JSON.parse(data), function( key, row ) {
                    var table_row = '<tr><td><a href="' + row.path + '" target="_new">' + row.name + '</a></td><td class="text-right"><a href="#" data-url="' + base_url + '/welcome/' + guid + '/delete/file/' + row.id + '" class="btn btn-danger delete_attachment">- ΔΙΑΓΡΑΦΗ</a></td></tr>'
                    table.append(table_row);
                });
            },

            error : function(error) {
                alert('Λυπούμαστε κάτι πήγε στραβά :( .Προσπαθήστε ξανά.');
            }
        });

    })

    $('table.uploads').on('click','a.delete_attachment', function(e){
        e.preventDefault();

        var deleteButton = $(this),
            url = deleteButton.data('url');

        $.ajax({
            type  : 'GET',
            url   : url,
            data  : null,
            cache : false,
            dataType : 'json',
            beforeSend : function() {
            },

            success : function(data) {
                deleteButton.parent().parent().html('');
            },

            error : function(error) {
                alert('Λυπούμαστε κάτι πήγε στραβά :( .Προσπαθήστε ξανά.');
            }
        });

    });

}

function initFormComponent() {

    // Form component
    var form = $(".steps-validation");
    form.save = function (temp) {
        var formData = $(this).serialize() + ((temp) ? '&temp=' + temp : ''); // form data as string
        var formAction = $(this).attr('action'); // form handler url
        var formMethod = $(this).attr('method'); // GET, POST
        var sectionNo = $(this).find('.current[role=tab]').index();
        var updateEntities = constants.getEntitiesBySection(sectionNo);
        if (updateEntities) {
            formData += '&updateSection=' + JSON.stringify(updateEntities)
        }
        $.ajaxSetup({
            headers: {
                'X-XSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });
        return $.ajax({
            type: formMethod,
            url: formAction,
            data: formData,
            cache: false,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (resp) {
            },
            error: function (error) {
                alert('Λυπούμαστε κάτι πήγε στραβά.Προσπαθήστε ξανά.');
            }
        });
    };

    // Wizard component
    $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="number">#index#</span> #title#',
        autoFocus: true,
        labels: {
            next: 'ΕΠΟΜΕΝΟ',
            previous: 'ΠΡΟΗΓΟΥΜΕΝΟ',
            finish: 'ΥΠΟΒΟΛΗ'
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex < newIndex) {

                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                form.validate().settings.ignore = ":disabled,:hidden";

                if (form.valid()) {
                    var prom = form.save(true);
                    prom.done(function (resp) {
                        if (resp) {
                            if (resp.success) {
                                if (currentIndex < newIndex) {
                                    // Needed in some cases if the user went back (clean up)
                                    // To remove error styles
                                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                                }
                                form.validate().settings.ignore = ":disabled,:hidden";
                            } else {
                                $('.bootstrap-dialog-message').html(resp.message);
                                $('#alert-modal').modal('show');
                                form.steps("previous");
                            }
                        }
                    }, this);
                    return true;
                } else {
                    return false;
                }
            } else {
                return form.valid();
            }
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3) {
            //     form.steps("previous");
            // }
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            var prom = form.save(false);
            prom.done(function (resp) {
                if (resp) {
                    if (resp.success) {
                        window.location.href = base_url + '/finish';
                    } else {
                        $('.bootstrap-dialog-message').html(resp.message);
                        $('#alert-modal').modal('show');
                    }
                }
            });
        }
    });
}

function showAlert(table) {
    var alert = $(table).closest('div').find('.errorMessage');
    alert.show();
}

function hideAlert(table) {
    var alert = $(table).closest('div').find('.errorMessage');
    alert.hide();
}

$(function() {

    initFormComponent();
    initValidation();
    initPlugins();
    initListeners();
    initDetails();

});
