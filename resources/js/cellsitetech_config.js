$(document).ready(function() { var iCnt=0;
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
    		//'switch_name': $('#configt_load_switch_name').val(),
		}).done(function( data ) {
			$('#val_' + selid).html( data );
		});
    });
	
	var tmp = [];
	$('#append-interface-section').click( function(event){iCnt=iCnt+1;
		event.preventDefault();
		var lastID='';
		var myUpdate=[];
		var name1=parseInt($('#last-element').val(),10);
		var name2=name1+1;
		//var name1='loop[looper_" + $('#last-element').val() + "][1]';
		//var section='<span class="form-non-editable-fields"><label class="readonly">interface GigabitEthernet#XXXXX#<br>description eNB - MacroNodeID - #XXXXXX#<br>mtu 1956<br>no ip address<br>load-interval 30<br>media-type sfp<br>negotiation auto<br>service-policy input METER-IN<br>service-policy output METER-OUT<br>no shut<br>!<br>service instance 300 ethernet<br>description CELL_MGMT eNB OAM<br>encapsulation dot1q 101<br>rewrite ingress tag pop 1 symmetric<br>bridge-domain 300<br>!<br>service instance 400 ethernet<br>description LTE VLAN<br>encapsulation dot1q 100<br>rewrite ingress tag pop 1 symmetric<br>bridge-domain 400<br>!</label></span>';
		
		var section={0:'interface GigabitEthernet',1:'description eNB - MacroNodeID - ',
		2:'mtu 1956',3:'no ip address',4:'load-interval 30',5:'media-type sfp',6:'negotiation auto',
		7:'service-policy input METER-IN',8:'service-policy output METER-OUT',9:'no shut',10:'!',
		11:'service instance 300 ethernet',12:'description CELL_MGMT eNB OAM',13:'encapsulation dot1q 101',
		14:'rewrite ingress tag pop 1 symmetric',15:'bridge-domain 300',16:'!',17:'service instance 400 ethernet',
		18:'description LTE VLAN',19:'encapsulation dot1q 100',20:'rewrite ingress tag pop 1 symmetric',
		21:'bridge-domain 400',22:'!'};
		//var s=0;
		var s=$('#last-element').val();
		$.each( section, function( key, value ) {
		  $('.form-editable-fields-to-append').append("<input type='text' style='display:none !important;' id='new-field"+iCnt+s+"' size='' name='loop[looper_" + iCnt + s + "][0]' class='form-editable-fields form-control cellsitech-configtxtinp border border-dark' value='"+value+"'>");
		  s++;
		});
		$('.form-editable-fields-to-append').append("<br><span class='form-editable-fields'><label class='readonly' id='fields-"+iCnt+"'>interface GigabitEthernet<input type='text' class='form-control' name='loop[looper_" +iCnt+ name1 + "][1]'><a href='#' id='remove-interface-section-"+iCnt+"'style='padding-left : 87px'><font size='25'>-</font></a><br>description eNB - MacroNodeID - <input type='text' class='form-control' name='loop[looper_" +iCnt+ name2 + "][1]'><br>mtu 1956<br>no ip address<br>load-interval 30<br>media-type sfp<br>negotiation auto<br>service-policy input METER-IN<br>service-policy output METER-OUT<br>no shut<br>!<br>service instance 300 ethernet<br>description CELL_MGMT eNB OAM<br>encapsulation dot1q 101<br>rewrite ingress tag pop 1 symmetric<br>bridge-domain 300<br>!<br>service instance 400 ethernet<br>description LTE VLAN<br>encapsulation dot1q 100<br>rewrite ingress tag pop 1 symmetric<br>bridge-domain 400<br>!</label></span>");
		/* var searchIDs = $("input:checkbox:checked").map(function(){
			tmp.push($(this).attr("id"));
		  return $(this).attr("id");
		}).get(); // <----
		var biggest = Math.max.apply( null, searchIDs );
		var maxlen=tmp.length;
		//console.log(tmp+' : '+tmp.length+' : '+biggest);
		$.each( searchIDs, function( key, value ) {
			$.ajax({
				url:"managescreen-process.php",
				method: "POST",
				success: function(data) {
					var myData=$('#addsamefieldval_'+value).text();	
					//console.log(myData);
					$('#copyfield_'+searchIDs[searchIDs.length-1]).append("<br><input type='hidden' name='loop[looper_"+(maxlen+value+1)+"][0]' value='"+myData+"'><span class='form-editable-fields'><label>"+myData+"</label><input type='text' id='new-field' size='' name='loop[looper_" + (maxlen+value+1) + "][1]' class='form-control cellsitech-configtxtinp border border-dark' value='"+data+"'></span><input type='hidden' name='edit[looper_"+(maxlen+value+1)+"][]' value='1'>");
					lastID = value;
					
				}
			});
			
		});		 */	
		console.log('test');
	});	
	
});
var section={0:'interface GigabitEthernet',1:'description eNB - MacroNodeID - ',
		2:'mtu 1956',3:'no ip address',4:'load-interval 30',5:'media-type sfp',6:'negotiation auto',
		7:'service-policy input METER-IN',8:'service-policy output METER-OUT',9:'no shut',10:'!',
		11:'service instance 300 ethernet',12:'description CELL_MGMT eNB OAM',13:'encapsulation dot1q 101',
		14:'rewrite ingress tag pop 1 symmetric',15:'bridge-domain 300',16:'!',17:'service instance 400 ethernet',
		18:'description LTE VLAN',19:'encapsulation dot1q 100',20:'rewrite ingress tag pop 1 symmetric',
		21:'bridge-domain 400',22:'!'};
$(document).delegate('#remove-interface-section-1', 'click', function(){
	$('#fields-1').remove();
	$('#remove-interface-section-1').remove();
	var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field1'+p).remove();
			p++;
	});
    
}); 
$(document).delegate('#remove-interface-section-2', 'click', function(){
	$('#fields-2').remove();
    $('#remove-interface-section-2').remove();
	var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field2'+p).remove();
			p++;
	});
}); 
$(document).delegate('#remove-interface-section-3', 'click', function(){
	$('#fields-3').remove();
	$('#remove-interface-section-3').remove();
    var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field3'+p).remove();
			p++;
	});
}); 
$(document).delegate('#remove-interface-section-4', 'click', function(){
	$('#fields-4').remove();
    $('#remove-interface-section-4').remove();
	var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field4'+p).remove();
			p++;
	});
}); 
$(document).delegate('#remove-interface-section-5', 'click', function(){
	$('#fields-5').remove();
    $('#remove-interface-section-5').remove();
	var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field5'+p).remove();
			p++;
	});
}); 
$(document).delegate('#remove-interface-section-6', 'click', function(){
	$('#fields-6').remove();
    $('#remove-interface-section-6').remove();
	var p=$('#last-element').val();
	$.each( section, function( key, value ) {
			$('#new-field6'+p).remove();
			p++;
	});
}); 
