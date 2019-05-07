$(document).ready(function() {
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#ipcase1-table, #ipcase2-table, #ipcase3-table, #ipcase4-table').DataTable( {
		 "aoColumns": [{},{},{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[0, 'asc']],
		 } );
		$(document).on('click', 'td a.del-device', function(event) {
			if(confirm("Are you sure, want to delete the selected device?")){
			 var table = $(this).closest('table').attr('id');
			 var tr = $(this).closest('tr');
			 var id = $(this).closest('tr').find("td:eq(0)").text();
			 $('#' + table + ' tbody').hide();
			 $.post( "ip-mgt-process.php?act=delete&ntype=admind", { 'type': "api-ajax", 'id':id, 'tab': table
				}).done(function( data ) {
					$('#' + table + ' tbody').html(data);
					$('#' + table + ' tbody').show();
				}); 
			 
			 $('#'+table).DataTable( {
				 "aoColumns": [{},{},{},{},{"bSortable": false}],		
				 "processing": true,
				 "autoWidth": false,
				 "dom": 'Bfrtip',
				 "pageLength": 20,
				 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3]}}],
				 "searching" : true,
				 "destroy": true,
				 "order": [[0, 'asc']],
				 } );
			}
		});
});
