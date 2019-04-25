$(document).ready(function() {
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
		$('#ipcase1-table, #ipcase2-table, #ipcase3-table, #ipcase4-table').DataTable( {
		 "processing": true,
		 "autoWidth": false,
		 "pageLength": 20,
		 "searching" : false,
		 "order": [[0, 'asc']],
		 } );
});
