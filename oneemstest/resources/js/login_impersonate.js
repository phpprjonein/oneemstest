$(document).ready(function() {
	$('#inputName').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
                data: 'type=autocomplete&category=name&query=' + query,            
                dataType: "json",
                type: "POST",
                success: function (data) {
					result($.map(data, function (index, value) {
						return index;
                    }));
                }
            });
        }
    });
	
	$(document).on('click', '#action-http-upload', function(event) {
		if($("#file").val() == ""){
	    	$("#upload_status").append("<strong>Error!</strong> File input field is required.<br/>");
	    	req_err = true;
		}
		if(req_err){ 
			$('#device-file-upload #upload_status').show();
			$('#device-file-upload #upload_status').addClass('alert-danger');
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
	});    
	$(document).on('click', '#device-upload-act', function(event) {
		var req_err = false;
		$('#device-upload #status').html('');
		$('#device-upload #status').css("opacity","");
		
		if($('#device-upload #inputName').val() == ""){
			$('#device-upload #status').append("<strong>Error!</strong> URL field is required.<br/>");
			req_err = true;
		}
		if(req_err){ 
			$('#device-upload #status').show();
			$('#device-upload #status').addClass('alert-danger');
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
	});
});    