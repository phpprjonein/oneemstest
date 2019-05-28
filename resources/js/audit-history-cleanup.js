$(document).ready(function() {
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#audit-history-cleanup').DataTable( {
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
			if(confirm("Are you sure, want to delete the selected audit history?")){
			 var table = $(this).closest('table').attr('id');
			 var tr = $(this).closest('tr');
			 var batchid = $(this).closest('tr').find("td:eq(0)").text();
			 var auhisid = $(this).closest('tr').data("auhisid");
			 $('#audit-history-cleanup tbody').hide();
			 $.post( "ip-mgt-process.php?act=delete&ntype=auditd", { 'type': "api-ajax", 'batchid':batchid, 'auhisid': auhisid
				}).done(function( data ) {
					$('#audit-history-cleanup tbody').html(data);
					$('#audit-history-cleanup tbody').show();
				}); 
			 
			 $('#audit-history-cleanup').DataTable( {
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
