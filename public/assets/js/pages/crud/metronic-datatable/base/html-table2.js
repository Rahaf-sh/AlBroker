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
				input: $('#generalSearch'),
			},
			columns: [
				{
					field: 'Value',
					type: 'number',
				},
				{
					field: 'InvoiceDate',
					type: 'date',
					format: 'YYYY-MM',
				}, {
					field: 'Status',
					title: 'Status',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							0: {'title': 'Pending', 'class': 'kt-badge--danger'},
							1: {'title': 'On-Hold', 'class': ' kt-badge--warning'},
							2: {'title': 'Paid', 'class': ' kt-badge--success'},
						};
						return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill status">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Type',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							2: {'title': 'Reseller', 'state': 'primary'},
							3: {'title': 'Publisher', 'state': 'success'},
						};
						return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +status[row.Type].state + '">' +	status[row.Type].title + '</span>';
					},
				},
			],
		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();

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