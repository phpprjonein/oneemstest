$(document).ready(function() {
	$('#edituserlevel').hide();
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#manageuserlevels').DataTable( {
		 "aoColumns": [{},{},{},{}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[2, 'asc']],
		 } );
		
		$(document).on('click', '.edituserlevel', function(event) {
			$('#adduserlevel').hide();
			$('#edituserlevel').show();
			$('#addUserLevelForm #modalLabelLarge').text('Edit User Level');
			var userlevel = $(this).closest('tr').data("userlevel");
			var userlevelid = $(this).closest('tr').find("td:eq(1)").text();
			var userlevelName = $(this).closest('tr').find("td:eq(2)").text();
			
			$('#addUserLevelForm #userlevelName').val(userlevelName);
			$('#addUserLevelForm #userlevelId').val(userlevelid);
			
			if(userlevel != 1){
				$('#calloutZonewrap').hide();
			}
			
			$('#addUserLevelForm #adduserlevel').text('Update User Level');
        	var myModal = $('#addUserLevelForm');
        	myModal.modal('show');
			return false;
		});
		
		$(document).on('click', '#addUserLevelForm #edituserlevel', function(event) {
			var req_err = false;
			$('#addUserLevelForm #status').html('');
			$('#addUserLevelForm #status').css("opacity","");  
			if($('#addUserLevelForm #userName').val() == ""){
				$('#addUserLevelForm #status').append("<strong>Error!</strong> User Level Name field is required.<br/>");
				req_err = true;
			}
		
			if(req_err){ 
    			$('#addUserLevelForm #status').show();
    			$('#addUserLevelForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Userlevel", 'act' : 'edit',      				
    				'id' : $('#addUserLevelForm #userlevelId').val(), 
    				'userlevelname' : $('#addUserLevelForm #userlevelName').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUserLevelForm #status').removeClass('alert-danger');
    					  $('#addUserLevelForm #status').addClass('alert-success');
    					  $('#addUserLevelForm #status').append("<strong>Success!</strong> User Level Name updated successfully.<br/>"); 
    					  $('#addUserLevelForm #status').show();
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
	
		$(document).on('click', '#addUserLevelForm #adduserlevel', function(event) {
			var req_err = false;
			$('#modalLabelLarge').text('Add User');
			$('#addUserLevelForm #status').html('');
			$('#addUserLevelForm #status').css("opacity","");
			$('#addUserLevelForm #status').css("opacity","");  
			if($('#addUserLevelForm #userlevelName').val() == ""){
				$('#addUserLevelForm #status').append("<strong>Error!</strong> User Level Name field is required.<br/>");
				req_err = true;
			}
			
			if(req_err){ 
    			$('#addUserLevelForm #status').show();
    			$('#addUserLevelForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Userlevel", 'act' : 'add', 
    				'userlevel' : $('#addUserLevelForm #userlevelName').val(),
    			})
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUserLevelForm #status').removeClass('alert-danger');
    					  $('#addUserLevelForm #status').addClass('alert-success');
    					  $('#addUserLevelForm #status').append("<strong>Success!</strong> User Level Name added successfully.<br/>"); 
    					  $('#addUserLevelForm #userlevelName').val('');
    					  
    					  $('#addUserLevelForm #status').show();
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
		$(document).on('click', '#manageuserlevels .deleteuserlevel', function(event) {
			var userlevelid = $(this).closest('tr').find("td:eq(1)").text(); 
			var userlevelName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#deleteUserLevelForm #userlevelId').val(userlevelid);
			$('#deleteUserLevelForm #userLevelNameDel').text(userlevelName);
			$('#deleteUserLevelForm #userlevelDel').text(userlevelName);
			
			
        	var myModal = $('#deleteUserLevelForm');
        	myModal.modal('show');
			return false;
			
		});
		
		$(document).on('click', '#deleteUserLevelForm #deleteuserlevel', function(event) {
			$.post( "managescreen-process.php", { 'screen': "Userlevel", 'act' : 'delete', 'id' : $('#deleteUserLevelForm #userlevelId').val() })
			  .done(function( data ) {
				  if(data == 'success'){
			        	var myModal = $('#deleteUserLevelForm'); 
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
		$('#addUserLevelForm, #deleteUserLevelForm').on('hidden.bs.modal', function () {
			 location.reload();
		});
		  $('#Role').on('change', function(){
			  if(this.value != 1){
				  $('#calloutZonewrap').hide();
			  }else{
				  $('#calloutZonewrap').show();
			  }
		  });
});
