"use strict";
var KTDatatableHtmlTableDemo = function () {
    // Private functions

    // demo initializer
    var demo = function () {

        var datatable = $('.kt-datatable').KTDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#generalSearch'),
            },
            pagination: true,
            overflow: 'visible',
            autoHide: false,
            rows:
                {
                    overflow: 'visible',
                    autoHide: false,
                }
        });

        $('#kt_form_status').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'created_at');
        });
        $('#kt_form_publsiher').on('change', function () {
            datatable.search($(this).val().toLowerCase(), 'Owner');
        });
        $('#kt_form_status,#kt_form_type,#kt_form_category').selectpicker();

    };

    return {
        // Public functions
        init: function () {
            // init dmeo
            demo();
        },
    };
}();
jQuery(document).ready(function () {
    $('.generalSelect').select2();

    KTDatatableHtmlTableDemo.init();

    function refreshCards() {
        /*
            $.ajax({
            headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
            url: $('#base_url').val() + '/api/get/admin/information',
            type: 'get',
            dataType: 'json',

            success: function (response) {
            $('#count_website_active').html(response.data.active_websites);
            $('#count_website_pending').html(response.data.pending_websites);
            $('#count_website_disable').html(response.data.disable_websites);
        }
        });
        */
    }

    setInterval(refreshCards, 5000);
});




