$(document).ready(function() {
	//Common JS block
	$('#export-v-pills-conflict').show();
	$('#search-v-pills-conflict').show();
	$('#export-v-pills-missed').hide();
	$('#search-v-pills-missed').hide();
	$('#export-v-pills-new').hide();
	$('#search-v-pills-new').hide();
	$('#export-v-pills-ok').hide();
	$('#search-v-pills-ok').hide();
	$(".col-1 .nav-link").click(function(){
		if($(this).html() == 'Conflicts'){
			$('#export-v-pills-conflict').show();
			$('#search-v-pills-conflict').show();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'Missed'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').show();
			$('#search-v-pills-missed').show();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'New'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').show();
			$('#search-v-pills-new').show();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'OK'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').show();
			$('#search-v-pills-ok').show();
		}
	}); 
	
	$("#discovery-region a").click(function(){
		$("#discovery-region .btn").html($(this).text());
		$.post( "ip-mgt-process.php", { calltype: "trigger", region: $(this).text(), 'page-id':'discovery' })
		  .done(function( data ) {
			  $("#discovery-market button").text("SELECT MARKET");
			  $("#discovery-market .dropdown-menu").html(data);
		  });
	});
	$(document).on('click', '#discovery-market a', function(event) {
		$("#discovery-market .btn").html($(this).text());
	});
	
	
	$("#discovery-region a").click(function(){
		var ipconflicttable =  $('#ip-conflict-table').DataTable();
		var ipmissedtable =  $('#ip-missed-table').DataTable();
		var ipnewtable =  $('#ip-new-table').DataTable();
		var ipoktable =  $('#ip-ok-table').DataTable();
		
		if($(this).text() != 'SELECT REGION'){
			ipconflicttable.columns(11).search('^'+$(this).text()+'$', true, false).draw();
			ipmissedtable.columns(12).search('^'+$(this).text()+'$', true, false).draw();
			ipnewtable.columns(8).search('^'+$(this).text()+'$', true, false).draw();
			ipoktable.columns(10).search('^'+$(this).text()+'$', true, false).draw();
		}else{
			ipconflicttable.columns(11).search('').draw();
			ipmissedtable.columns(12).search('').draw();
			ipnewtable.columns(8).search('').draw();
			ipoktable.columns(10).search('').draw();
		}
	});
	$(document).on('click', '#discovery-market a', function(event) {
		var ipconflicttable =  $('#ip-conflict-table').DataTable();
		var ipmissedtable =  $('#ip-missed-table').DataTable();
		var ipnewtable =  $('#ip-new-table').DataTable();
		var ipoktable =  $('#ip-ok-table').DataTable();
		
		if($(this).text() != 'SELECT MARKET'){
			ipconflicttable.columns(12).search('^'+$(this).text()+'$', true, false).draw();
			ipmissedtable.columns(13).search('^'+$(this).text()+'$', true, false).draw();
			ipnewtable.columns(9).search('^'+$(this).text()+'$', true, false).draw();
			ipoktable.columns(11).search('^'+$(this).text()+'$', true, false).draw();
		}else{
			ipconflicttable.columns(12).search('').draw();
			ipmissedtable.columns(13).search('').draw();
			ipnewtable.columns(9).search('').draw();
			ipoktable.columns(11).search('').draw();
		}
	});

	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	if($('#ip-conflict-table').length > 0){
		var ipconflicttable =  $('#ip-conflict-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 5,
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
		"aoColumns": [{},{},{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 5,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}}], 
		 "order": [[0, 'asc']],
		
		 } );
		ipmissedtable.buttons().container().appendTo('#export-v-pills-missed');
       $('#search-v-pills-missed input').keyup(function(){
    	   ipmissedtable.search($(this).val()).draw() ;
       });
	}
	
	
	
	// New Tab - 1- 8 col, 8 no exp and 9, 10 region, market
	if($('#ip-new-table').length > 0){
		var ipnewtable =  $('#ip-new-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 5,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}}], 
		   "order": [[0, 'asc']],
		 } );
		ipnewtable.buttons().container().appendTo('#export-v-pills-new');
	       $('#search-v-pills-new input').keyup(function(){
	    	   ipnewtable.search($(this).val()).draw() ;
	       });
	}
	
	// OK Tab - 1- 10 col, 10 no exp and 11, 12 region, market
	if($('#ip-ok-table').length > 0){
		var ipoktable =  $('#ip-ok-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 5,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}}], 
		 "order": [[0, 'asc']],
		 } );
        ipoktable.buttons().container().appendTo('#export-v-pills-ok');
        
       $('#search-v-pills-ok input').keyup(function(){
        	ipoktable.search($(this).val()).draw() ;
       });
	}	
	
	//Action JS
	$("#ip-ok-table #inlineCheckbox1").click(function(){
		$.post( "ip-mgt-process.php", { calltype: "trigger", 'id':$(this).val(), 'action' : 'Disc-OK' })
		  .done(function( data ) {
			  alert("Status Updated Successfully");
			  location.reload();
		  });
	});
});
