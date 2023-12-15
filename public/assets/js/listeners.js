function initListeners() {
    insuranceListener();
    genderListener();
    ibanListener();
    unemploymentInsuranceListener();
    educationListener();
    languageListener();
    militaryObligationsListeners();
    identityTypeListeners();
    identityPassportTypeListeners();
}

function insuranceListener() {
    $('[name="insurance"]').on('change', function () {
        var registrationNumberIka = $('[name=registrationNumberIka]'),
            powerNumberTsmede = $('[name=powerNumberTsmede]'),
            insuranceOther = $('[name=insuranceOther]'),
            val = $(this).val();

        $.each([registrationNumberIka,powerNumberTsmede,insuranceOther],function() {
            $(this).prop('disabled', true);
            $(this).parent().hide();
        });

        if (val == '1' || val == '2') {
            registrationNumberIka.parent().show();
            registrationNumberIka.prop('disabled', false);
        }

        if (val == '2') {
            powerNumberTsmede.parent().show();
            powerNumberTsmede.prop('disabled', false);
        }

        if (val == '3') {
            insuranceOther.prop('disabled', false);
            insuranceOther.parent().show();
        }

    });
    $('[name="insurance"]').trigger('change');
}

function genderListener() {

    $('input[type=radio][name="gender"]').on('click', function () {
        var milObli = $('[name=militaryObligations]'),
            milObliExpDate = $('[name=militaryObligationsExpiryDate]'),
            milRow = $('.militaryObligationsRow');

        if ($(this).val() == '1')
        {
            milObliExpDate.val(null);
            $("[name=militaryObligations] option:selected").removeAttr('selected');
            $("[name=militaryObligations] option:first").attr('selected', true).change();
            milRow.hide();
        }
        else {
            milRow.show();
        }
    });
    $('input[name="gender"]').trigger('change');
    $('[name=militaryObligations]').trigger('change');
}

function ibanListener() {

    var iban_holder = $('[name=iban_holder]'),
        iban_number = $('[name=iban_number]'),
        iban_number_container = $('.iban_number');

    iban_holder.on('change', function () {
        var val = $(this).val()

            if(val == '1')
            {
                iban_number.prop('disabled', false);
                iban_number_container.show();
            }
            else {
                iban_number.prop('disabled', true);
                iban_number_container.hide();
            }
    });
    iban_holder.trigger('change');
}

function unemploymentInsuranceListener() {

    var unemployment_insurance = $('[name=unemployment_insurance]'),
        unemployment_insurance_service = $('[name=unemployment_insurance_service]'),
        unemployment_insurance_service_container = $('.unemployment_insurance_service');

    unemployment_insurance.on('change', function () {
        var val = $(this).val()

        if(val == '1')
        {
            unemployment_insurance_service.prop('disabled', false);
            unemployment_insurance_service_container.show();
        }
        else {
            unemployment_insurance_service.prop('disabled', true);
            unemployment_insurance_service_container.hide();
        }
    });
    unemployment_insurance.trigger('change');
}

function educationListener() {

    var educationTypeOther = $('[name=educationTypeOther]'),
        educationType = $('[name=educationType]'),
        educationInstitution = $('[name=educationInstitution]'),
        educationDepartment = $('[name=educationDepartment]');

    $('[name="educationTitle"]').on('change', function () {
        var val = $(this).val(),
            id = $(this).find('option:selected').data('id');

            $.each([educationInstitution,educationDepartment,educationType,educationTypeOther],function() {
                $(this).prop('disabled', true);
                $(this).closest('.row').hide();
            });

            if(val != '')
            {
                educationType.val('').trigger("change");
                educationType.prop('disabled', false);
                educationType.closest('.row').show();
            }
    });
    $('[name="educationTitle"]').trigger('change');

    $('[name="educationType"]').on('change', function () {
        var val = $(this).val(),
            id = $(this).find('option:selected').data('id');

        $.each([educationInstitution,educationDepartment,educationTypeOther],function() {
            $(this).prop('disabled', true);
            $(this).closest('.row').hide();
        });

        switch(val) {
            case '1':
            case '2':
                $("[name=educationInstitution] > option").each(function() {
                    var parents = $(this).data('parent').toString();
                    $(this).prop('disabled', (parents.indexOf(id) === -1 && $(this).val() !== '') );
                });
                educationInstitution.val('').trigger("change");
                educationInstitution.select2();
                educationInstitution.prop('disabled', false);
                educationInstitution.closest('.row').show();
                educationDepartment.prop('disabled', false);
                educationDepartment.val('');
                educationDepartment.closest('.row').show();
                break;
            case '3':
            case '4':
            case '6':
                educationTypeOther.prop('disabled', false);
                educationTypeOther.closest('.row').show();
                break;
        }
    });
    $('[name="educationType"]').trigger('change');
}


function languageListener() {

    var languageOther = $('[name=languageOther]'),
        languageLevel = $('[name=languageLevel]'),
        languageInstitution = $('[name=languageInstitution]'),
        languageInstitutionOther = $('[name=languageInstitutionOther]');

    $('[name="language"]').on('change', function () {
        var val = $(this).val(),
            id = $(this).find('option:selected').data('id');

        $.each([languageOther,languageLevel,languageInstitution,languageInstitutionOther],function() {
            $(this).prop('disabled', true);
            $(this).closest('.row').hide();
        });

        if(val != '')
        {
            if( val == '1' || val == '2' || val == '3' || val == '4' || val == '5' )
            {
                languageOther.val('');
                $("[name=languageLevel] > option").each(function() {
                    var parents = $(this).data('parent').toString();
                    $(this).prop('disabled', (parents.indexOf(id) === -1 && $(this).val() !== '') );
                });
                languageLevel.val('').trigger('change');
                languageLevel.select2();
                languageInstitution.val('');
                languageInstitutionOther.val('');
                languageLevel.prop('disabled', false);
                languageLevel.closest('.row').show();
            }
        }

        if( val == '5')
        {
            languageOther.prop('disabled', false);
            languageOther.closest('.row').show();
            languageInstitution.val('');
            languageInstitutionOther.val('');
            languageLevel.prop('disabled', true);
            languageLevel.closest('.row').hide();
        }
    });
    $('[name="language"]').trigger('change');

    $('[name="languageLevel"]').on('change', function () {
        var val = $(this).val(),
            id = $(this).find('option:selected').data('id');

        $.each([languageInstitution,languageInstitutionOther],function() {
            $(this).prop('disabled', true);
            $(this).closest('.row').hide();
        });

        if(val != '' && val != '1')
        {
            $("[name=languageInstitution] > option").each(function() {
                var parents = $(this).data('parent').toString();
                $(this).prop('disabled', (parents.indexOf(id) === -1 && $(this).val() !== '') );
            });
            languageInstitution.val('').trigger('change');
            languageInstitution.select2();
            languageInstitutionOther.val('');
            languageInstitution.prop('disabled', false);
            languageInstitution.closest('.row').show();
        }
    });
    $('[name="languageLevel"]').trigger('change');

    $('[name="languageInstitution"]').on('change', function () {
        var val = $(this).val();

        if(val == '4')
        {
            languageInstitutionOther.prop('disabled', false);
            languageInstitutionOther.closest('.row').show();
        }
    });
    $('[name="languageInstitution"]').trigger('change');
}

function militaryObligationsListeners() {
    $('[name="militaryObligations"]').on('change', function () {
        var militaryObligationsExpiryDate = $('[name=militaryObligationsExpiryDate]'),
            militaryObligationsExpiryDateCol = $('.militaryObligationsExpiryDateCol');
        var val = $(this).val();
        if (val == '2') {
            militaryObligationsExpiryDateCol.show();
        }
        else {
            militaryObligationsExpiryDateCol.hide();
            militaryObligationsExpiryDate.val(null);
        }
    });
    $('[name="militaryObligations"]').trigger('change');
}

function identityTypeListeners() {
    $('[name="identityType"]').on('change', function () {
        var dataInsurance = $('[data-insurance]'),
            val = $(this).val();

        if(val != '')
        {
            if(val == '4')
            {
                val = '3';
            }

            var dataInsuranceSpecific = $('[data-insurance='+val+']');

            dataInsurance.hide();
            if(dataInsuranceSpecific.length == 1)
            {
                dataInsuranceSpecific.show()
            }
        }

    });
    $('[name="identityType"]').trigger('change');

}

function identityPassportTypeListeners() {
    $('[name="identityPassportType"]').on('change', function () {
        var workPemitInfo = $('.workPemitInfo');
        var val = $(this).val();
        if (val == '2') {
            workPemitInfo.show();
        }
        else {
            workPemitInfo.hide();
        }
    });
    $('[name="identityPassportType"]').trigger('change');

}
