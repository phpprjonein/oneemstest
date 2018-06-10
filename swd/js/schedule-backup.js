	$(document).on('click', '#schedbackup_submit', function(event) {
		var req_err = false;
		//alert( 'backupsubmit clicked');
		$('#schedule-backup-devices #status').html('');
			$('#schedule-backup-devices #status').css("opacity","");
			//alert($('#schedule-backup-devices #backup_occur').val()); 
		if($('#schedule-backup-devices #backup_occur').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Occurrence name field is required.<br/>");
				req_err = true;
			}
		if($('#schedule-backup-devices #backup_day').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Day field is required.<br/>");
				req_err = true;
		}
		if($('#schedule-backup-devices #backup_hours').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Hours field is required.<br/>");
				req_err = true;
		}
		if($('#schedule-backup-devices #backup_hours').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Hours field is required.<br/>");
				req_err = true;
		}
		if($('#schedule-backup-devices #backup_minutes').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Minutes field is required.<br/>");
				req_err = true;
		}
		if($('#schedule-backup-devices #backup_timezone').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Timezone field is required.<br/>");
				req_err = true;
		}
		if($('#schedule-backup-devices #backup_market').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Market field is required.<br/>");
				req_err = true;
		} 
		if($('#schedule-backup-devices #schedbackup_type').val() == ""){
				$('#schedule-backup-devices #status').append("<strong>Error!</strong> Market field is required.<br/>");
				req_err = true;
		}
			if(req_err){ 
			    // alert('reach here 100;');
    			$('#schedule-backup-devices #status').show();
    			$('#schedule-backup-devices #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
		     alert('backuptype' + $('#schedbackup_type').val());
    		if(confirm("Are you sure, do you want to save the settings ?")){	        			
	            $.ajax({
	                type:"post",
	                url:"ip-mgt-process.php",					
	                data: {'ctype':'SchedBakupSettings', 'username':$('#username').val(), 'backup_occur':$('#backup_occur').val(),'backup_day':$('#backup_day').val(), 'backup_hours':$('#backup_hours').val(), 'backup_minutes':$('#backup_minutes').val(), 'schedbackup_type': $('#schedbackup_type').val(),'backup_timezone':$('#backup_timezone').val(), 'backup_market':$('#backup_market').val()},
	                success: function(resdata){						
	                	var myModal = $('#schedbackupModal');
	            		myModal.modal('show'); 
	                }
	            });
    		}
            return false;
    	}); 