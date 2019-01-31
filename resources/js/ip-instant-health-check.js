$(document).ready(function() {
	$(document).on('click', ".instant-health-check #sync-password-ip-health-check", function(event) {
		var req_err = false;
		$('.instant-health-check #status').html('');
		$('.instant-health-check #status').css("opacity","");
		if($('.instant-health-check #syncPassInputDeviceIPaddress').val() == ""){
			$('.instant-health-check #status').html("<strong>Error!</strong> Sync Password field is required.<br/>");
			$('.instant-health-check #status').addClass('alert-danger');
			$('.instant-health-check #status').show();
			req_err = true;
		}
		if(req_err){
			window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
		$.ajax({
            type:"post",
            url:"ip-mgt-process.php",					
            data: {'ctype':'Sync Password','syncpass_ipaddress':$('#syncPassInputDeviceIPaddress').val()},
            success: function(resdata){	
            	var myModal = $('#Modal_Health_Checks');
            	$('#Modal_Health_Checks .modal-title').html('Sync Password');
            	$('#Modal_Health_Checks .modal-body').html(resdata);
            	myModal.modal('show');
            	return false;
            }
        });
		return false;
	});
	$(document).on('click', ".instant-health-check #sync-cyberark-sync-password-ip-health-check", function(event) {
		var req_err = false;
		$('.instant-health-check #status').html('');
		$('.instant-health-check #status').css("opacity","");
		if($('.instant-health-check #synccyberarkpass_ipaddress').val() == ""){
			$('.instant-health-check #status').html("<strong>Error!</strong> Check CyberArk Synchronization field is required.<br/>");
			$('.instant-health-check #status').addClass('alert-danger');
			$('.instant-health-check #status').show();
			req_err = true;
		}
		if(req_err){
			window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
		$.ajax({
            type:"post",
            url:"ip-mgt-process.php",					
            data: {'ctype':'SyncCyberArk','syncpass_ipaddress':$('#synccyberarkpass_ipaddress').val()},
            success: function(resdata){	
            	var myModal = $('#Modal_Health_Checks');
            	$('#Modal_Health_Checks .modal-title').html('Check CyberArk Synchronization Status');
            	$('#Modal_Health_Checks .modal-body').html(resdata);
            	myModal.modal('show');
            	return false;
            }
        });
		return false;
	});
	
    $(document).on('click', ".instant-health-check #ssh-PuTTY-ip-health-check", function(event) {
    	var req_err = false;
		$('.instant-health-check #status').html('');
		$('.instant-health-check #status').css("opacity","");
		if($('.instant-health-check #sshPuTTYInputIPv6').val() == ""){
			$('.instant-health-check #status').html("<strong>Error!</strong> Show PuTTY CmdLine field is required.<br/>");
			$('.instant-health-check #status').addClass('alert-danger');
			$('.instant-health-check #status').show();
			req_err = true;
		}
		if(req_err){ 
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
    	var myModal = $('#Modal_Health_Checks');
    	$('#Modal_Health_Checks .modal-title').html('Show Putty Command Line');
    	var sshPuTTYInputIPv6 = $('.instant-health-check #sshPuTTYInputIPv6').val().replace(/\:/g, '-');
    	//var command = 'putty.exe -load &quot;PAMsession&quot; -ssh -l ' + $('#username').val() + '@PAMadmin@' + sshPuTTYInputIPv6 + ' -loghost PAMadmin@' + sshPuTTYInputIPv6;
    	var command = 'putty.exe -load "PAMsession" -ssh -l ' + $('#username').val() + '@PAMadmin@' + sshPuTTYInputIPv6 + ' -loghost PAMadmin@' + sshPuTTYInputIPv6;
		$('#Modal_Health_Checks .modal-body').html('<input type="text" class="form-control" size="100" name="textbox" id="textboxp1" readonly value="' + command + '" ><button class="btn btn-default" onclick=\"copyToClipboard()\">Copy</button>');
    	myModal.modal('show');
    	return false;
    });	
    
	$(document).on('click', '#sshcmdoutputcpy', function(event) {
       var copyText = document.getElementById("sshcmdoutput");
       copyText.select();
       document.execCommand("copy");
       // alert("Copied the text: " + copyText.value); 
        });
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
function copyToClipboard() {
 	  /* Get the text field */
	  var copyText = document.getElementById("textboxp1");
	  /* Select the text field */
	  copyText.select();
	  /* Copy the text inside the text field */
	  document.execCommand("copy");

	  /* Alert the copied text */
	  alert("Copied the text: " + copyText.value);
}
	
