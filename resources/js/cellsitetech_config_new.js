$(document).ready(function() {
	$(document).on('change', "#cellsitech-generate-script select", function(event) {
		$("#cellsitech-generate-script select").each(function()
		{
					if($(this).val() !=''){
						$(this).removeClass('required');
					}
		});
		return false;
	});
	
	$(document).on('click', "#cellsitech-generate-script .generate-script-submit", function(event) {
    	var req_err = false;
    	$("#cellsitech-generate-script select").each(function(){
			if($(this).val() ==''){
				$(this).addClass('required');
				req_err = true;
			}else{
				$(this).removeClass('required');
			}
		});
    	if(req_err){
    		$("#status").html("<strong>Error!</strong> 	 select fields are required.<br/>");
    	}

        if(req_err){
        	$('#status').css("opacity","");
        	$("#status").addClass('alert-danger');
        	$("#status").show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
        	return false;
        }
        return true;
    });

	
	
	$(document).on('change', "#cellsitech-config select", function(event) {
				var filename = 'Golden_'; sep = '';
				$("#cellsitech-config select").each(function()
				{
					if($(this).val() !=''){
					filename = filename + sep + $(this).val();
					sep = '_';	
					$(this).removeClass('required');
					}
				});
				filename = filename.replace(/[^a-z0-9_-]/gi,'');
				if(filename != 'Golden_'){
					$('#template_info').removeClass('d-none');
					$('#cellsitech-config #template_info #filename').html(filename);
					$('#cellsitech-config #upload_filename').val(filename);
				}else{
					$('#template_info').addClass('d-none');
				}
		return false;
	});
	
    $(document).on('click', "#cellsitech-config .config-submit", function(event) {
    	var req_err = false;
    	$("#cellsitech-config select").each(function(){
			if($(this).val() ==''){
				$(this).addClass('required');
				req_err = true;
			}else{
				$(this).removeClass('required');
			}
		});
    	if(req_err){
    		$("#status").html("<strong>Error!</strong> Template category select fields are required.<br/>");
    	}
    	if($("#file").val() == ""){
        	$("#status").append("<strong>Error!</strong> File input field is required.<br/>");
        	req_err = true;
    	}else{
	        var allowedFiles = [".txt"];
	        var uploadfile = $("#file");
	        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
	        if (!regex.test(uploadfile.val().toLowerCase())) {
	        	req_err = true;
	        	$("#status").append("<strong>Error!</strong> Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.<br/>");
	        }
    	}
        if(req_err){
        	$('#status').css("opacity","");
        	$("#status").addClass('alert-danger');
        	$("#status").show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
        	return false;
        }
        return true;
    });
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	$(document).on('change', '#cellsitech-config #file_process input[type="checkbox"]', function(e){
        if($(this).is(':checked')){
        	$('#file_process .form-non-editable-fields').hide();
        }else{
        	$('#file_process .form-non-editable-fields').show();
        }
    });
    $(document).on('click', "#config_file_uploader #config-submit", function(event) {
    	$('#main-status').hide();
    	var req_err = false;
    	if($("#file").val() == ""){
        	$("#status").html("<strong>Error!</strong> File input field is required.");
        	req_err = true;
    	}else{
	        var allowedFiles = [".txt"];
	        var uploadfile = $("#file");
	        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
	        if (!regex.test(uploadfile.val().toLowerCase())) {
	        	req_err = true;
	        	$("#status").html("<strong>Error!</strong> Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
	        }
    	}
        if(req_err){
        	$('#status').css("opacity","");
        	$("#status").addClass('alert-danger');
        	$("#status").show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
        	return false;
        }
        
        return true;
    });
	*/
	
});