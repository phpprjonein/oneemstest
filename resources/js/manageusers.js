$(document).ready(function() {
	$('#edituser').hide();
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#manageusers').DataTable( {
		 "aoColumns": [{},{},{},{},{},{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[0, 'asc']],
		 } );
		
		$(document).on('click', '.edituser', function(event) {
			$('#adduser').hide();
			$('#edituser').show();
			$('#addUserForm #modalLabelLarge').text('Edit User');
			var userid = $(this).closest('tr').data("user");
			var userName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#addUserForm #userName').val(userName);
			$('#addUserForm #userId').val(userid);
			$('#addUserForm #adduser').text('Update User');
        	var myModal = $('#addUserForm');
        	myModal.modal('show');
			return false;
		});
		
		$(document).on('click', '#addUserForm #edituser', function(event) {
			var req_err = false;
			$('#addUserForm #status').html('');
			$('#addUserForm #status').css("opacity","");
			$('#addUserForm #status').css("opacity","");  
			if($('#addUserForm #userName').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> User Name field is required.<br/>");
				req_err = true;
			};
			if(req_err){ 
    			$('#addUserForm #status').show();
    			$('#addUserForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'edit', 'userName' : $('#addUserForm #userName').val(), 'id' : $('#addUserForm #userId').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUserForm #status').removeClass('alert-danger');
    					  $('#addUserForm #status').addClass('alert-success');
    					  $('#addUserForm #status').append("<strong>Success!</strong> User Name updated successfully.<br/>"); 
    					  $('#addUserForm #status').show();
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
	
		$(document).on('click', '#addUserForm #adduser', function(event) {
			var req_err = false;
			$('#modalLabelLarge').text('Add User');
			$('#addUserForm #status').html('');
			$('#addUserForm #status').css("opacity","");
			$('#addUserForm #status').css("opacity","");  
			if($('#addUserForm #userName').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> User Name field is required.<br/>");
				req_err = true;
			};
			if(req_err){ 
    			$('#addUserForm #status').show();
    			$('#addUserForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'add', 'userName' : $('#addUserForm #userName').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUserForm #status').removeClass('alert-danger');
    					  $('#addUserForm #status').addClass('alert-success');
    					  $('#addUserForm #status').append("<strong>Success!</strong> User Name added successfully.<br/>"); 
    					  $('#addUserForm #userName').val('');
    					  $('#addUserForm #status').show();
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
		$(document).on('click', '#manageusers .deleteuser', function(event) {
			var userid = $(this).closest('tr').data("user");
			var userName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#deleteUserForm #userId').val(userid);
			$('#deleteUserForm #userNameDel').text(userName);
        	var myModal = $('#deleteUserForm');
        	myModal.modal('show');
			return false;
			
		});
		
		$(document).on('click', '#deleteUserForm #deleteuser', function(event) {
			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'delete', 'id' : $('#deleteUserForm #userId').val() })
			  .done(function( data ) {
				  if(data == 'success'){
			        	var myModal = $('#deleteUserForm'); 
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
		$('#addUserForm, #deleteUserForm').on('hidden.bs.modal', function () {
			 location.reload();
		});
});
