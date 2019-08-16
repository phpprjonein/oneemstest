$(document).ready(function() {
	$('#edituser').hide();
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#manageusrvars').DataTable( {
		 "aoColumns": [{},{},{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[2, 'asc']],
		 } );
		
		/* $(document).on('click', '.editusrvar', function(event) {
			$('#addusrvar').hide();
			$('#editusrvar').show();
			$('#addUsrvarForm #modalLabelLarge').text('Edit User');
			var userid = $(this).closest('tr').data("user");
			var zones = $(this).closest('tr').data("zones");
			var userlevel = $(this).closest('tr').data("userlevel");
			var status = $(this).closest('tr').data("status");
			var usrvarName = $(this).closest('tr').find("td:eq(2)").text();
			var Value = $(this).closest('tr').find("td:eq(3)").text();
			var DeviceSeries = $(this).closest('tr').find("td:eq(4)").text();
			var Template = $(this).closest('tr').find("td:eq(5)").text();
			$('#addUsrvarForm #usrvarName').val(userName);
			$('#addUsrvarForm #Value').val(Value);
			$('#addUsrvarForm #DeviceSeries').val(DeviceSeries);
			$('#addUsrvarForm #Template').val(Template);
			$('#addUsrvarForm #Status').val(status);
			
			if(userlevel != 1){
				$('#calloutZonewrap').hide();
			}
			
			if(zones == 1){
				$("input[name=zones][value='1']").prop("checked",true);
			}else{
				$("input[name=zones][value='0']").prop("checked",true);
			}
			$('#addUsrvarForm #Status').val(status);
			
			$('#addUsrvarForm #addusrvar').text('Update User');
        	var myModal = $('#addUsrvarForm');
        	myModal.modal('show');
			return false;
		}); */
		
		/* $(document).on('click', '#addUsrvarForm #editusrvar', function(event) {
			var req_err = false;
			$('#addUsrvarForm #status').html('');
			$('#addUsrvarForm #status').css("opacity","");
			$('#addUsrvarForm #status').css("opacity","");  
			if($('#addUsrvarForm #userName').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> User Name field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Value').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Value field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Lastname').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Lastname field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Email').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Email field is required.<br/>");
				req_err = true;
			}
			if(req_err){ 
    			$('#addUsrvarForm #status').show();
    			$('#addUsrvarForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'edit', 
    				'username' : $('#addUsrvarForm #userName').val(),  
    				'value' : $('#addUsrvarForm #Value').val(),
    				'deviceseries' : $('#addUsrvarForm #DeviceSeries').val(),
    				'template' : $('#addUsrvarForm #Template').val(),
    				'id' : $('#addUsrvarForm #userId').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUsrvarForm #status').removeClass('alert-danger');
    					  $('#addUsrvarForm #status').addClass('alert-success');
    					  $('#addUsrvarForm #status').append("<strong>Success!</strong> User Name updated successfully.<br/>"); 
    					  $('#addUsrvarForm #status').show();
    		    		    window.setTimeout(function() {
    		    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		    		            $(this).hide(); 
    		    		        });
    		    		    }, 4000);
    		    		    return false;
    				  }
    			  });	
    			
    		}
		}); */
	
		$(document).on('click', '#addUsrvarForm #addusrvar', function(event) {
			var req_err = false;
			$('#modalLabelLarge').text('Add User Variable');
			$('#addUsrvarForm #status').html('');
			$('#addUsrvarForm #status').css("opacity","");
			if($('#addUsrvarForm #usrvarName').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> User Variable Name field is required.<br/>");
				req_err = true;
			}
			
			if($('#addUsrvarForm #usrvarval').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Value field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #deviceseries').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> DeviceSeries field is required.<br/>");
				req_err = true;
			}
			
			if(req_err){ 
    			$('#addUsrvarForm #status').show();
    			$('#addUsrvarForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Usrvar", 'act' : 'add', 
    				'usrvarname' : $('#addUsrvarForm #usrvarname').val(),  
    				'value' : $('#addUsrvarForm #usrvarval').val(),
    				'deviceseries' : $('#addUsrvarForm #deviceseries').val()
    			})
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUsrvarForm #status').removeClass('alert-danger');
    					  $('#addUsrvarForm #status').addClass('alert-success');
    					  $('#addUsrvarForm #status').append("<strong>Success!</strong> User Variable Name added successfully.<br/>"); 
    					  $('#addUsrvarForm #usrvarName, #addUsrvarForm #Value, #addUsrvarForm #DeviceSeries').val('');
    					  
    					  $('#addUsrvarForm #status').show();
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
		/* $(document).on('click', '#manageusrvars .deleteusrvar', function(event) {
			var usrvarId = $(this).closest('tr').data("usrvarid");
			var userName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#deleteUsrvarForm #usrvarId').val(usrvarId);
			$('#deleteUsrvarForm #usrvarNameDel').text(usrvarName);
        	var myModal = $('#deleteUsrvarForm');
        	myModal.modal('show');
			return false;
			
		}); */
		
		/* $(document).on('click', '#deleteUsrvarForm #deleteusrvar', function(event) {
			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'delete', 'id' : $('#deleteUsrvarForm #usrvarId').val() })
			  .done(function( data ) {
				  if(data == 'success'){
			        	var myModal = $('#deleteUsrvarForm'); 
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
		$('#addUsrvarForm, #deleteUsrvarForm').on('hidden.bs.modal', function () {
			 location.reload();
		});
		  $('#Role').on('change', function(){
			  if(this.value != 1){
				  $('#calloutZonewrap').hide();
			  }else{
				  $('#calloutZonewrap').show();
			  }
		  }); */
});
