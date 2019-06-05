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
		 "order": [[2, 'asc']],
		 } );
		
		$(document).on('click', '.edituser', function(event) {
			$('#adduser').hide();
			$('#edituser').show();
			$('#addUserForm #modalLabelLarge').text('Edit User');
			var userid = $(this).closest('tr').data("user");
			var zones = $(this).closest('tr').data("zones");
			var userlevel = $(this).closest('tr').data("userlevel");
			var status = $(this).closest('tr').data("status");
			var userName = $(this).closest('tr').find("td:eq(2)").text();
			var Firstname = $(this).closest('tr').find("td:eq(3)").text();
			var Lastname = $(this).closest('tr').find("td:eq(4)").text();
			var Email = $(this).closest('tr').find("td:eq(5)").text();
			var Phone = $(this).closest('tr').find("td:eq(6)").text();
			$('#addUserForm #userName').val(userName);
			$('#addUserForm #userId').val(userid);
			$('#addUserForm #Firstname').val(Firstname);
			$('#addUserForm #Lastname').val(Lastname);
			$('#addUserForm #Email').val(Email);
			$('#addUserForm #Phone').val(Phone);
			$('#addUserForm #Role').val(userlevel);
			$('#addUserForm #Status').val(status);
			if(zones == 1){
				$("input[name=zones][value='1']").prop("checked",true);
			}else{
				$("input[name=zones][value='0']").prop("checked",true);
			}
			$('#addUserForm #Status').val(status);
			
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
			}
			if($('#addUserForm #Firstname').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Firstname field is required.<br/>");
				req_err = true;
			}
			if($('#addUserForm #Lastname').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Lastname field is required.<br/>");
				req_err = true;
			}
			if($('#addUserForm #Email').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Email field is required.<br/>");
				req_err = true;
			}
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
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'edit', 
    				'username' : $('#addUserForm #userName').val(),  
    				'password' : $('#addUserForm #Password').val(),
    				'fname' : $('#addUserForm #Firstname').val(),
    				'lname' : $('#addUserForm #Lastname').val(),
    				'email' : $('#addUserForm #Email').val(),
    				'phone' : $('#addUserForm #Phone').val(),
    				'role' : $('#addUserForm #Role').val(),
    				'status' : $('#addUserForm #Status').val(),
    				'zones' : $("input[name=zones]:checked").val(),
    				'id' : $('#addUserForm #userId').val() })
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
			}
			if($('#addUserForm #Password').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Password field is required.<br/>");
				req_err = true;
			}
			if($('#addUserForm #Firstname').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Firstname field is required.<br/>");
				req_err = true;
			}
			if($('#addUserForm #Lastname').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Lastname field is required.<br/>");
				req_err = true;
			}
			if($('#addUserForm #Email').val() == ""){
				$('#addUserForm #status').append("<strong>Error!</strong> Email field is required.<br/>");
				req_err = true;
			}
			
			
			
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
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'add', 
    				'username' : $('#addUserForm #userName').val(),  
    				'password' : $('#addUserForm #Password').val(),
    				'fname' : $('#addUserForm #Firstname').val(),
    				'lname' : $('#addUserForm #Lastname').val(),
    				'email' : $('#addUserForm #Email').val(),
    				'phone' : $('#addUserForm #Phone').val(),
    				'role' : $('#addUserForm #Role').val(),
    				'zones' : $("input[name=zones]:checked").val(),
    				'status' : $('#addUserForm #Status').val(),
    			})
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUserForm #status').removeClass('alert-danger');
    					  $('#addUserForm #status').addClass('alert-success');
    					  $('#addUserForm #status').append("<strong>Success!</strong> User Name added successfully.<br/>"); 
    					  $('#addUserForm #userName, #addUserForm #Password, #addUserForm #Firstname, #addUserForm #Lastname, #addUserForm #Email, #addUserForm #Phone').val('');
    					  
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
