$(document).ready(function() {
	$('#editvendor').hide();
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#managevendors').DataTable( {
		 "aoColumns": [{},{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[0, 'asc']],
		 } );
		
		$(document).on('click', '.editvendor', function(event) {
			$('#addvendor').hide();
			$('#editvendor').show();
			$('#addVendorForm #modalLabelLarge').text('Edit Vendor');
			var vendorid = $(this).closest('tr').data("vendor");
			var vendorName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#addVendorForm #vendorName').val(vendorName);
			$('#addVendorForm #vendorId').val(vendorid);
			$('#addVendorForm #addvendor').text('Update Vendor');
        	var myModal = $('#addVendorForm');
        	myModal.modal('show');
			return false;
		});
		
		$(document).on('click', '#addVendorForm #editvendor', function(event) {
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
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Vendor", 'act' : 'edit', 'vendorName' : $('#addVendorForm #vendorName').val(), 'id' : $('#addVendorForm #vendorId').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addVendorForm #status').removeClass('alert-danger');
    					  $('#addVendorForm #status').addClass('alert-success');
    					  $('#addVendorForm #status').append("<strong>Success!</strong> Vendor Name updated successfully.<br/>"); 
    					  $('#addVendorForm #status').show();
    		    		    window.setTimeout(function() {
    		    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		    		            $(this).hide(); 
    		    		        });
    		    		    }, 4000);
    		    		    return false;
    				  }
    			  });	
    			
    		}
		});
	
		$(document).on('click', '#addVendorForm #addvendor', function(event) {
			var req_err = false;
			$('#modalLabelLarge').text('Add Vendor');
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
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Vendor", 'act' : 'add', 'vendorName' : $('#addVendorForm #vendorName').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addVendorForm #status').removeClass('alert-danger');
    					  $('#addVendorForm #status').addClass('alert-success');
    					  $('#addVendorForm #status').append("<strong>Success!</strong> Vendor Name added successfully.<br/>"); 
    					  $('#addVendorForm #vendorName').val('');
    					  $('#addVendorForm #status').show();
    		    		    window.setTimeout(function() {
    		    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		    		            $(this).hide(); 
    		    		        });
    		    		    }, 4000);
    		    		    return false;
    				  }
    			  });	
    			
    		}
		});
		$(document).on('click', '#managevendors .deletevendor', function(event) {
			var vendorid = $(this).closest('tr').data("vendor");
			var vendorName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#deleteVendorForm #vendorId').val(vendorid);
			$('#deleteVendorForm #vendorNameDel').text(vendorName);
        	var myModal = $('#deleteVendorForm');
        	myModal.modal('show');
			return false;
			
		});
		
		$(document).on('click', '#deleteVendorForm #deletevendor', function(event) {
			$.post( "managescreen-process.php", { 'screen': "Vendor", 'act' : 'delete', 'id' : $('#deleteVendorForm #vendorId').val() })
			  .done(function( data ) {
				  if(data == 'success'){
			        	var myModal = $('#deleteVendorForm'); 
			        	myModal.modal('hide');
		    		    return false;
				  }
			  });
		});
	    window.setTimeout(function() {
	        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	            $(this).hide(); 
	        });
	    }, 4000);
		$('#addVendorForm, #deleteVendorForm').on('hidden.bs.modal', function () {
			 location.reload();
		});
});
