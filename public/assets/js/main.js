(function($) {
    'use strict';

    var Admin = function() {
        this.VERSION = "1.0.0";
        this.AUTHOR = "SingularLogic";
        this.SUPPORT = "info@singularlogic.eu";

        this.pageScrollElement = 'html, body';
        this.$body = $('body');

    }

    Admin.prototype.initDates = function() {
        $('.datepicker-greek').datepicker({
            todayBtn: "linked",
            language: "el",
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });
    }

    /** @function initBulkActions
     * @description Initialize bulk actions in a table list
     */
    Admin.prototype.initBulkActions = function() {

        $('form[data-task="bulk"] .bulk-action.select').on('click', function(e)
        {
            e.preventDefault();
            $('input[name="selected[]"]:checkbox').prop('checked', 'checked');
        });

        $('form[data-task="bulk"] .bulk-action.deselect').on('click', function(e)
        {
            e.preventDefault();
            $('input[name="selected[]"]:checkbox').prop('checked', '');
        });

        $('form[data-task="bulk"] .bulk-action.delete').on('click', function(e)
        {
            e.preventDefault();
            var selectedElements = $('input[name="selected[]"]:checked');

            if ( selectedElements.length )
            {
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to undo this action!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#FF7043",
                        confirmButtonText: "Yes, delete them!"
                    },
                    function(result) {
                        if (result === true) {
                            var values = selectedElements.map(function(){return $(this).val();}).get().join();
                            if(values.length)
                            {
                                $('input[name="_bulkIds"]').val(values);
                                $('input[name="_bulkMethod"]').val('DELETE');
                                $('form[data-task="bulk"]').submit();
                            }
                        }

                    });

            }
        });

        $('form[data-task="bulk"] .bulk-action.activate').on('click', function(e)
        {
            e.preventDefault();

            var selectedElements = $('input[name="selected[]"]:checked');

            if ( selectedElements.length && confirm('Activate the selected items ?') )
            {
                var values = selectedElements.map(function(){return $(this).val();}).get().join();

                if(values.length)
                {
                    $('input[name="_bulkIds"]').val(values);
                    $('input[name="_bulkMethod"]').val('ACTIVATE');
                    $('form[data-task="bulk"]').submit();
                }

            }

        });

        $('form[data-task="bulk"] .bulk-action.deactivate').on('click', function(e)
        {
            e.preventDefault();

            var selectedElements = $('input[name="selected[]"]:checked');

            if ( selectedElements.length && confirm('Deactivate the selected items ?') )
            {
                var values = selectedElements.map(function(){return $(this).val();}).get().join();

                if(values.length)
                {
                    $('input[name="_bulkIds"]').val(values);
                    $('input[name="_bulkMethod"]').val('DEACTIVATE');
                    $('form[data-task="bulk"]').submit();
                }

            }

        });

    }

    /** @function initTableRowActions
     * @description Initialize actions per row in a table list
     */
    Admin.prototype.initTableRowActions = function() {

        $('a[data-task="destroy"]').on('click', function(e)
        {
            e.preventDefault();

            var anchor = $(this);
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to undo this action!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#FF7043",
                    confirmButtonText: "Yes, delete it!"
                },
                function(result) {
                    if (result === true) {
                        anchor.siblings('form[data-task="delete"]').submit();
                    }
                });

        });

    }

    Admin.prototype.initSelect2 = function() {

        $('select.select').select2({
            minimumResultsForSearch: -1
        });

    }

    Admin.prototype.initMaterialButtons = function() {
        // Add bottom spacing if reached bottom,
        // to avoid footer overlapping
        // -------------------------

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() > $(document).height() - 40) {
                $('.fab-menu-bottom-left, .fab-menu-bottom-right').addClass('reached-bottom');
            }
            else {
                $('.fab-menu-bottom-left, .fab-menu-bottom-right').removeClass('reached-bottom');
            }
        });


        // Affix
        // -------------------------

        // Left alignment
        $('#fab-menu-affixed-demo-left').affix({
            offset: {
                top: $('#fab-menu-affixed-demo-left').offset().top - 20
            }
        });

        // Right alignment
        $('#fab-menu-affixed-demo-right').affix({
            offset: {
                top: $('#fab-menu-affixed-demo-right').offset().top - 20
            }
        });

    }

    /** @function initTableRowActions
     * @description Initialize actions per row in a table list
     */
    Admin.prototype.initTableSearch = function() {

        $('button#submitSearch').on('click', function(e)
        {
            e.preventDefault();
            var elements = $('*[data-input="true"]');

            $.each(elements, function(index, element) {
                $('#'+$(element).attr('name')).val($(element).val());
            });
            $('table tr.filter form').submit();
        });

        $('button#submitReset').on('click', function(e)
        {
            e.preventDefault();
            var elements = $('*[data-input="true"]');

            $.each(elements, function(index, element) {
                $('#'+$(element).attr('name')).val('');
            });
            $('table tr.filter form').submit();
        });

        $('*[data-input="true"]').on('keypress', function(e)
        {
            if(e.which == 13)
            {
                $('button#submitSearch').trigger('click');
            }
        });

    }

    /** @function initSwitch
     * @description Switchery
     */
    Admin.prototype.initSwitch = function() {
        // Switchery
        // ------------------------------

        // Initialize multiple switches
        if (Array.prototype.forEach) {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html);
            });
        }
        else {
            var elems = document.querySelectorAll('.switchery');
            for (var i = 0; i < elems.length; i++) {
                var switchery = new Switchery(elems[i]);
            }
        }

        // Colored switches
        var primary = document.querySelector('.switchery-primary');
        var switchery = new Switchery(primary, { color: '#2196F3' });

        var danger = document.querySelector('.switchery-danger');
        var switchery = new Switchery(danger, { color: '#EF5350' });

        var warning = document.querySelector('.switchery-warning');
        var switchery = new Switchery(warning, { color: '#FF7043' });

        var info = document.querySelector('.switchery-info');
        var switchery = new Switchery(info, { color: '#00BCD4'});



        // Checkboxes/radios (Uniform)
        // ------------------------------

        // Default initialization
        $(".styled, .multiselect-container input").uniform({
            radioClass: 'choice'
        });

        // File input
        $(".file-styled").uniform({
            wrapperClass: 'bg-blue',
            fileButtonHtml: '<i class="icon-file-plus"></i>'
        });


        //
        // Contextual colors
        //

        // Primary
        $(".control-primary").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-primary-600 text-primary-800'
        });

        // Danger
        $(".control-danger").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-danger-600 text-danger-800'
        });

        // Success
        $(".control-success").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-success-600 text-success-800'
        });

        // Warning
        $(".control-warning").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-warning-600 text-warning-800'
        });

        // Info
        $(".control-info").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-info-600 text-info-800'
        });

        // Custom color
        $(".control-custom").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-indigo-600 text-indigo-800'
        });

    }

    /** @function initTableResponsive
     * @description Initialize responsive table
     */
    Admin.prototype.initTableResponsive = function() {
        $('.table-togglable').footable();
    }

    /** @function initModelLanguage
     * @description Switch model's language
     */
    Admin.prototype.initModelLanguage = function() {

        if($('ul.switch-locales').length){

            var langCode = $('ul.switch-locales li a.active').attr('data-language');
            if($('.right-image .thumb').length){
                $('.right-image .thumb').not('.thumb-'+langCode).hide();
                if($('.right-image .thumb-'+langCode).length){
                    $('.right-image .dropzone').hide();
                }
            }
            if($('.right-file .thumb').length){
                $('.right-file .thumb').not('.thumb-'+langCode).hide();
                if($('.right-file .thumb-'+langCode).length){
                    $('.right-file .dropzone').hide();
                }
            }
            $('a#switch').on('click', function(e)
            {
                e.preventDefault();
                $('ul.switch-locales li a').removeClass('active');
                $('span.current-language').text($(this).text());
                $(this).addClass('active');
                var langCode = $(this).attr('data-language');
                $('.form-group-translation').hide();
                $('.form-group-translation.group-'+langCode).show();;
                $('td.transtd').addClass('hide');
                $('td.transtd.'+langCode).removeClass('hide');
                if($('.right-image .thumb-'+langCode).length){
                    $('.right-image .thumb').hide();
                    $('.right-image .thumb-'+langCode).show();
                    $('.right-image .dropzone').hide();
                }else{
                    $('.right-image .thumb').hide();
                    $('.right-image .dropzone').show();
                }
                if($('.right-file .thumb-'+langCode).length){
                    $('.right-file .thumb').hide();
                    $('.right-file .thumb-'+langCode).show();
                    $('.right-file .dropzone').hide();
                }else{
                    $('.right-file .thumb').hide();
                    $('.right-file .dropzone').show();
                }
                if($("#attachmentForm input[name='locale']").length){
                    $("#attachmentForm input[name='locale']").val(langCode);
                }
            });
        }

    }


    /** @function initDualList
     * @description Switch model's language
     */
    Admin.prototype.initDualList = function() {
        $('.listbox-tall').bootstrapDualListbox({
            selectorMinimalHeight: 400,
            nonSelectedListLabel: 'Non-selected Items',
            selectedListLabel: 'Selected Items',
        });
    }

    /** @function init
     * @description Inintialize all core components.
     */
    Admin.prototype.init = function() {
        // init layout
        this.initSelect2();
        this.initDates();
        this.initBulkActions();
        this.initTableRowActions();
        this.initTableSearch();
        //this.initMaterialButtons();
        this.initTableResponsive();
        //this.initSwitch();
        this.initModelLanguage();
        this.initDualList();
    }

    $.Admin = new Admin();
    $.Admin.Constructor = Admin;

})(window.jQuery);

(function($) {
    'use strict';
    // Initialize layouts and plugins
    (typeof angular === 'undefined') && $.Admin.init();
})(window.jQuery);
