$(document).ready(function() {
	/*
	$(".col-1 .nav-link").click(function(){
		if($(this).html() == 'Conflicts'){
			$('#export-v-pills-conflict').show();
			$('#search-v-pills-conflict').show();
			$('#export-v-pills-tab1').hide();
			$('#search-v-pills-tab1').hide();
			$('#export-v-pills-tab2').hide();
			$('#search-v-pills-tab2').hide();
			$('#export-v-pills-tab3').hide();
			$('#search-v-pills-tab3').hide();
		}else if($(this).html() == 'Missed'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-tab1').show();
			$('#search-v-pills-tab1').show();
			$('#export-v-pills-tab2').hide();
			$('#search-v-pills-tab2').hide();
			$('#export-v-pills-tab3').hide();
			$('#search-v-pills-tab3').hide();
		}else if($(this).html() == 'New'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-tab1').hide();
			$('#search-v-pills-tab1').hide();
			$('#export-v-pills-tab2').show();
			$('#search-v-pills-tab2').show();
			$('#export-v-pills-tab3').hide();
			$('#search-v-pills-tab3').hide();
		}else if($(this).html() == 'OK'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-tab1').hide();
			$('#search-v-pills-tab1').hide();
			$('#export-v-pills-tab2').hide();
			$('#search-v-pills-tab2').hide();
			$('#export-v-pills-tab3').show();
			$('#search-v-pills-tab3').show();
		}
	}); 

	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	if($('#ip-conflict-table1').length > 0){
		var ipconflicttable =  $('#ip-conflict-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}}], 
		 "order": [[0, 'asc']],
		 } );
		ipconflicttable.buttons().container().appendTo('#export-v-pills-conflict');
	       $('#search-v-pills-conflict input').keyup(function(){
	    	   ipconflicttable.search($(this).val()).draw() ;
	       });
	}
	
	// Missed Tab - 1-11 col, 11 no exp and 12, 13 region, market
	if($('#ip-missed-table').length > 0){
		var ipmissedtable =  $('#ip-missed-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}}], 
		 "order": [[0, 'asc']],
		
		 } );
		ipmissedtable.buttons().container().appendTo('#export-v-pills-tab1');
       $('#search-v-pills-tab1 input').keyup(function(){
    	   ipmissedtable.search($(this).val()).draw() ;
       });
	}
	
	
	
	// New Tab - 1- 8 col, 8 no exp and 9, 10 region, market
	if($('#ip-new-table').length > 0){
		var ipnewtable =  $('#ip-new-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{"bSortable": false},{},{},{},{}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}}], 
		   "order": [[0, 'asc']],
		 } );
		ipnewtable.buttons().container().appendTo('#export-v-pills-tab2');
	       $('#search-v-pills-tab2 input').keyup(function(){
	    	   ipnewtable.search($(this).val()).draw() ;
	       });
	}
	
	// OK Tab - 1- 10 col, 10 no exp and 11, 12 region, market
	if($('#ip-ok-table').length > 0){
		var ipoktable =  $('#ip-ok-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}}], 
		 "order": [[0, 'asc']],
		 } );
        ipoktable.buttons().container().appendTo('#export-v-pills-tab3');
        
       $('#search-v-pills-tab3 input').keyup(function(){
        	ipoktable.search($(this).val()).draw() ;
       });
	}	
	*/
});
