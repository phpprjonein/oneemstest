$(document).ready(function() {
    $(document).on('change', '#cellsitech-config #file_process input[type="checkbox"]', function(e){
        if($(this).is(':checked')){
        	$('#file_process .form-non-editable-fields').hide();
        }else{
        	$('#file_process .form-non-editable-fields').show();
        }
    });
    $(document).on('click', "#config_file_uploader #config-submit", function(event) {
    	/*File required validation*/
    	$('#main-status').hide();
    	var req_err = false;
    	if($("#file").val() == ""){
        	$("#upload_status").html("<strong>Error!</strong> File input field is required.");
        	req_err = true;
    	}else{
	    	/*File type txt validation*/
	        var allowedFiles = [".txt"];
	        var uploadfile = $("#file");
	        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
	        if (!regex.test(uploadfile.val().toLowerCase())) {
	        	req_err = true;
	        	$("#upload_status").html("<strong>Error!</strong> Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
	        }
    	}
        if(req_err){
        	$('#upload_status').css("opacity","");
        	$("#upload_status").addClass('alert-danger');
        	$("#upload_status").show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
        	return false;
        }
        
        return true;
    });
    
    $(document).on('change', "#file_process .elementvalref", function(event) {
    	var selid = $(this).attr('id');
    	$.post( "cellsite-config-process.php", { 
    		'action': "LoadTableData", 
    		'loadTab' : $('#' + selid).val(),
    		'switch_name': $('#configt_load_switch_name').val(),
		}).done(function( data ) {
			$('#val_' + selid).html( data );
		});
    });
});