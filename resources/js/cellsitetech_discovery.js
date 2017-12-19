$(document).ready(function() {
	if($('#ip-ok-table').length > 0){

        var table1 =  $('#ip-ok-table').DataTable( {
        "aoColumns": [
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": true },
        	{ "bSortable": false },
        	],	
         "processing": true,
         "pageLength": 5,
         "dom": 'Bfrtip',
	     "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}},{extend: 'print',titleAttr:'',className:'dtprintbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}}], 
           "language": {
           "lengthMenu": "Display _MENU_ records per page",
           "zeroRecords": "No records found",
           "info": "Showing page _PAGE_ of _PAGES_",
           "infoEmpty": "",
           "infoFiltered": ""
           },
       "order": [[0, 'asc']],

     } );
        table1.buttons().container().appendTo('#export-v-pills-ok');
        /*$('#search-v-pills-home input').keyup(function(){
        	table1.search($(this).val()).draw() ;
      })*/
	}
	
	
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
    		$.post( "ip-mgt-process.php", { calltype: "trigger", region: $(this).text() })
    		  .done(function( data ) {
    			  $("#discovery-market button").text("SELECT MARKET");
    			  $("#discovery-market .dropdown-menu").html(data);
    		  });
    	});
    	
    	$(document).on('click', '#discovery-market a', function(event) {
    		$("#discovery-market .btn").html($(this).text());
    	});
});
