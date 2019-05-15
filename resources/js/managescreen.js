$(document).ready(function() {
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#managevendors').DataTable( {
		 "aoColumns": [{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[0, 'asc']],
		 } );
		$(document).on('click', '#addVendorForm #addvendor', function(event) {
			var req_err = false;
			$('#addVendorForm #status').html('');
			$('#addVendorForm #status').css("opacity","");
			$('#addVendorForm #status').css("opacity","");  
			if($('#addVendorForm #vendorName').val() == ""){
				$('#addVendorForm #status').append("<strong>Error!</strong> Vendor Name field is required.<br/>");
				req_err = true;
			};
			if(req_err){ 
    			$('#addVendorForm #status').show();
    			$('#addVendorForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
        	
		});
});
