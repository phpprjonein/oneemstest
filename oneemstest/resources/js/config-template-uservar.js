	$(document).on('click', '#configtemplusrvar_submit', function(event) {
		var req_err = false;
		//alert( 'backupsubmit clicked');
		$('#config-template-uservar #status').html('');
			$('#config-template-uservar #status').css("opacity","");
			//alert($('#schedule-backup-devices #backup_occur').val()); 
		if($('#config-template-uservar #usrvarname').val() == ""){
				$('#config-template-uservar #status').append("<strong>Error!</strong> Variable name is required.<br/>");
				req_err = true;
			}
		if($('#config-template-uservar #usrvarval').val() == ""){
				$('#config-template-uservar #status').append("<strong>Error!</strong> Variable value is required.<br/>");
				req_err = true;
		}
		if($('#config-template-uservar #deviceseries').val() == ""){
				$('#config-template-uservar #status').append("<strong>Error!</strong> Device Series is required.<br/>");
				req_err = true;
		}
		if($('#config-template-uservar #templname').val() == ""){
				$('#config-template-uservar #status').append("<strong>Error!</strong> Template Name is required.<br/>");
				req_err = true;
		} 
		
			if(req_err){ 
			    // alert('reach here 100;');
    			$('#config-template-uservar #status').show();
    			$('#config-template-uservar #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
		   //  alert('backuptype' + $('#schedbackup_type').val());
    		if(confirm("Are you sure, do you want to save the settings ?")){	        			
	            $.ajax({
	                type:"post",
	                url:"ip-mgt-process.php",
	                data: {'ctype':'configtempluservar', 'usrvarname':$('#usrvarname').val(), 'usrvarval':$('#usrvarval').val(),'deviceseries':$('#deviceseries').val(), 'templname':$('#templname').val()},
	                success: function(resdata){						
	                	var myModal = $('#configtemplusrvalModal');
	            		myModal.modal('show'); 
	                }
	            });
    		}
            return false;
    	}); 