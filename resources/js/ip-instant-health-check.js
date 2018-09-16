$(document).ready(function() {
	$('#slectchktype input[type=radio][name=optradio]').change(function() {
		if(this.value == 'ipaddress'){
			$('#inputDeviceName').hide();
			$('#inputDeviceIPaddress').show();
			$('#inputDeviceName').val('');
		}else{
			$('#inputDeviceIPaddress').hide();
			$('#inputDeviceName').show();
			$('#inputDeviceIPaddress').val('');
		}
	});
	$(document).on('click', '#ip-health-check', function(event) {
		var req_err = false;
		//alert( 'backupsubmit clicked');
		$('#instant-health-check #status').html('');
		$('#instant-health-check #status').css("opacity","");
		
		if($('#instant-health-check #inputDeviceIPaddress').val() == "" && $('#instant-health-check #inputDeviceName').val() == ""){
			$('#instant-health-check #status').append("<strong>Error!</strong> IP Address/Device Name field is required.<br/>");
			$('#instant-health-check #status').addClass('alert-danger');
			req_err = true;
			if(req_err){ 
				$('#instant-health-check .panel-body-wrap').html('');
    			$('#instant-health-check #status').show();
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
		}
		
		if($('#instant-health-check #inputDeviceIPaddress').val() != ''){
			$.post( "ip-mgt-process.php", { calltype: "trigger", action: "HC-IP-Validate-Disc", type: 'IPv4ORIPv6', 'ipaddress':$('#instant-health-check #inputDeviceIPaddress').val()})
			  .done(function( data ) {
				  if(data != 'success'){
		    			$('#instant-health-check #status').append("<strong>Error!</strong> Device IP Address is not valid.<br/>");
		    			$('#instant-health-check #status').addClass('alert-danger');
		    			req_err = true;
		        		if(req_err){ 
		        			$('#instant-health-check .panel-body-wrap').html('');
		        			$('#instant-health-check #status').show();
		        		    window.setTimeout(function() {
		        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		        		            $(this).hide(); 
		        		        });
		        		    }, 4000);
		        			return false;
		        		}
				  }else{
	                var ajs = $.ajax({
	                    type:"get",
	                    url:"deviceip-healthchk-instant-check-data.php",
	                    data: {'deviceip':$('#inputDeviceIPaddress').val(), 'userid':$('#userid').val()},
	                    beforeSend: function(){
			            	  $('#instant-health-check .panel-body-wrap').html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
			            },
	                    success: function(resdata){
	                        $('#instant-health-check .panel-body-wrap').html(resdata);
	                        var table =  $('#example').DataTable({"paging": false, "searching": false,"ordering": false,"info": false, "oLanguage": {
	                            "sEmptyTable":     "Device does not exist"
	                        }});
	                    }
	                });
	      		}
			 });
			 
	}
	
	if($('#instant-health-check #inputDeviceName').val() != ''){
                var ajs = $.ajax({
                    type:"get",
                    url:"deviceip-healthchk-instant-check-data.php",
                    data: {'devicename':$('#inputDeviceName').val(), 'userid':$('#userid').val()},
                    beforeSend: function(){
		            	  $('#instant-health-check .panel-body-wrap').html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
		            },
                    success: function(resdata){
                        $('#instant-health-check .panel-body-wrap').html(resdata);
                        var table =  $('#example').DataTable({"paging": false, "searching": false,"ordering": false,"info": false, "oLanguage": {
                            "sEmptyTable":     "Device does not exist"
                        }});
                    }
                });
      		}
	return false;
	});
});
			
	