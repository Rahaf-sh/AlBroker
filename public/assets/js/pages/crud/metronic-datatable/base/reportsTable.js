"use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#yearSearch'),
            },
            pagination: true,
        });

        // $('#yearSearch').on('change', function() {
        //     datatable.search($(this).val().toLowerCase(), 'Year');
        // });

        $('#kt_form_month').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Month');
        });
        $('#kt_form_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });
        $('#kt_form_invices_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_form_status,#kt_form_month,#kt_form_type,#kt_form_invices_status').selectpicker();

    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableHtmlTableDemo.init();
});