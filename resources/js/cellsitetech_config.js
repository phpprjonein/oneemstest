$(document).ready(function() {
    $(document).on('change', '#cellsitech-config #file_process input[type="checkbox"]', function(e){
        if($(this).is(':checked')){
        	$('#file_process *').filter(':input').filter(':text').each(function(){
        		if($(this).attr('readonly') == 'readonly'){
        			$(this).hide();
        		}
        	});
        }else{
        	$('#file_process *').filter(':input').filter(':text').each(function(){
        		$(this).show_hide_readonly();
        	})
        }
    });
});