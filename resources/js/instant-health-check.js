$(document).ready(function() {
    $('body').on('click', '.run_all_checks', function(){
    	
    	var myModal = $('#instant-health-check');

    	  $.ajax({
              type:"get",
              url:"healthchk-cellsitetech.php",
              data: {'deviceip':$('#inputDeviceIPaddress').val(), userid:$(this).data('userid')},
              success: function(resdata){
            	  $('#instant-health-check .modal-body').html(resdata);     
              }
          });
    	  myModal.modal('show'); 
      }); 
    
    $('body').on('click', '#health-chk-div-wrap .run_custom_checks', function(){
    	
    	var myModal = $('#instant-health-check');
    	
    	var allVals = [];
    	$(this).parents('table:first').children().find('input[type=checkbox]:checked').each(function(index){
    		 allVals.push($(this).val());
    	});		
        $.ajax({
            type:"get",
            url:"healthchk-cellsitetech-custom.php",
            data: {'deviceip':$('#inputDeviceIPaddress').val(), userid:$(this).data('userid'), 'category':allVals}, 
            success: function(resdata){
            	$('#instant-health-check .modal-body').html(resdata);     
            }
        });
    });	
    $('.modal').on('show.bs.modal', function(event) {
        var idx = $('.modal:visible').length;
        $(this).css('z-index', 1040 + (10 * idx));
    });
    $('.modal').on('shown.bs.modal', function(event) {
        var idx = ($('.modal:visible').length) -1; // raise backdrop after animation.
        $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
        $('.modal-backdrop').not('.stacked').addClass('stacked');
    });

	  $(document).on('click', '.auditLog', function(event) {
		  var myModal = $('#healthpageModel');
		  $('#healthpage .modal-body').html('');
		  var sel = $(this).attr('id');
		$.post( "api-test.php", { type: "api-ajax"
			}).done(function( data ) {
				$('#' + sel).removeClass('btn');
				$('#' + sel).removeClass('btn-danger');
				$('#' + sel).removeClass('btn-success');
				var obj = jQuery.parseJSON( data );
				if(obj.result == true){
					myModal.find('.modal-body').html('<h3>Successful</h3>');
					$('#' + sel).addClass('btn-success');
				}else{
					myModal.find('.modal-body').html('<h3>Failed</h3>');
					$('#' + sel).addClass('btn-danger');
				}
				$('#healthpageModel').modal('show');
		});
		
		return false;
	  });
    
    
	$(document).on('click', '#ip-health-check', function(event) {
		var req_err = false;
		//alert( 'backupsubmit clicked');
		$('#instant-health-check #status').html('');
		$('#instant-health-check #status').css("opacity","");
		
		if($('#instant-health-check #inputDeviceIPaddress').val() == ""){
			$('#instant-health-check #status').append("<strong>Error!</strong> IP Address field is required.<br/>");
			$('#instant-health-check #status').addClass('alert-danger');
			req_err = true;
			if(req_err){ 
    			$('#instant-health-check #status').show();
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
		}
		
		$.post( "ip-mgt-process.php", { calltype: "trigger", action: "IP-Validate-Disc", type: 'IPv4ORIPv6', 'ipaddress':$('#instant-health-check #inputDeviceIPaddress').val()})
		  .done(function( data ) {
			  if(data != 'success'){
	    			$('#instant-health-check #status').append("<strong>Error!</strong> Device IP Address is not valid.<br/>");
	    			$('#instant-health-check #status').addClass('alert-danger');
	    			req_err = true;
	        		if(req_err){ 
	        			$('#instant-health-check #status').show();
	        		    window.setTimeout(function() {
	        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        		            $(this).hide(); 
	        		        });
	        		    }, 4000);
	        			return false;
	        		}
			  }else{
				var myModal = $('#instant-health-check');
				$('#instant-health-check #instant-health-checks-ip ').html($('#inputDeviceIPaddress').val());
                var ajs = $.ajax({
                    type:"get",
                    url:"ip-healthchk-load-table-data.php",
                    data: {'deviceip':$('#inputDeviceIPaddress').val(), 'userid':$('#userid').val()},
                    success: function(resdata){
                        $('#instant-health-check .modal-body').html(resdata);
                    }
                });
      	    	myModal.modal('show'); 
      	    	
      		}
		 });
		return false;
	}); 
});
			
	