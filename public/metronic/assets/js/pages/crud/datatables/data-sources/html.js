"use strict";
var KTDatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
		table.DataTable({
			responsive: true,
			bLengthChange: false,

			columnDefs: [

			],
		});

	};

	var initTable2 = function() {
		var table2 = $('#kt_datatable2');

		// begin first table
		table2.DataTable({
			responsive: true,
			bLengthChange: false,

			columnDefs: [

			],
		});

	};

	var initTable3 = function() {
		var table3 = $('#kt_datatable3');

		// begin first table
		table3.DataTable({
			responsive: true,
			bLengthChange: false,
			columnDefs: [

			],
		});

	};



	var initTable4 = function() {
		var table4 = $('#kt_datatable_button');
		// begin first table
		table4.DataTable({
			bLengthChange: false,
			scrollX: true,
			dom: 'Bfrtip',
			buttons: [
				{
					extend: 'print',
                    text: 'print',
					customize: function ( win ) {
						$(win.document.body)
							.css( 'direction', 'rtl' );
					}
				},
				{
					extend: 'excel',
					customize: function ( win ) {
						$(win.document)
							.css( 'direction', 'rtl' );
					}
				},
			],
			columnDefs: [

			],
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
			initTable2();
			initTable3();
			initTable4();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceHtml.init();
});
