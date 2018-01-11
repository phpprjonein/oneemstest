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
    	if($("#file").val() == ""){
        	$("#upload_status").html("<strong>Error!</strong> File input field is required.");
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
});