$(document).ready(function() {
	var readOnlyLength = 0;
	$(document).on('change', '#cellsitech-config #file_process input[type="checkbox"]', function(e){
        if($(this).is(':checked')){
        	$('#file_process .form-non-editable-fields').hide();
        }else{
        	$('#file_process .form-non-editable-fields').show();
        }
    });
	$('#edituser').hide();
	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	$('#manageusrvars').DataTable( {
		 "aoColumns": [{},{},{},{},{"bSortable": false}],		
		 "processing": true,
		 "buttons": [{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'excelHtml5',className:'dtexcelbtn dtexcelbtn-cs',exportOptions: {columns: [0, 1, 2]}}],
		 "autoWidth": false,
		 "dom": 'Bfrtip',
		 "pageLength": 20,
		 "searching" : true,
		 "destroy": true,
		 "order": [[2, 'asc']],
		 } );
		
		/* $(document).on('click', '.editusrvar', function(event) {
			$('#addusrvar').hide();
			$('#editusrvar').show();
			$('#addUsrvarForm #modalLabelLarge').text('Edit User');
			var userid = $(this).closest('tr').data("user");
			var zones = $(this).closest('tr').data("zones");
			var userlevel = $(this).closest('tr').data("userlevel");
			var status = $(this).closest('tr').data("status");
			var usrvarName = $(this).closest('tr').find("td:eq(2)").text();
			var Value = $(this).closest('tr').find("td:eq(3)").text();
			var DeviceSeries = $(this).closest('tr').find("td:eq(4)").text();
			var Template = $(this).closest('tr').find("td:eq(5)").text();
			$('#addUsrvarForm #usrvarName').val(userName);
			$('#addUsrvarForm #Value').val(Value);
			$('#addUsrvarForm #DeviceSeries').val(DeviceSeries);
			$('#addUsrvarForm #Template').val(Template);
			$('#addUsrvarForm #Status').val(status);
			
			if(userlevel != 1){
				$('#calloutZonewrap').hide();
			}
			
			if(zones == 1){
				$("input[name=zones][value='1']").prop("checked",true);
			}else{
				$("input[name=zones][value='0']").prop("checked",true);
			}
			$('#addUsrvarForm #Status').val(status);
			
			$('#addUsrvarForm #addusrvar').text('Update User');
        	var myModal = $('#addUsrvarForm');
        	myModal.modal('show');
			return false;
		}); */
		
		/* $(document).on('click', '#addUsrvarForm #editusrvar', function(event) {
			var req_err = false;
			$('#addUsrvarForm #status').html('');
			$('#addUsrvarForm #status').css("opacity","");
			$('#addUsrvarForm #status').css("opacity","");  
			if($('#addUsrvarForm #userName').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> User Name field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Value').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Value field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Lastname').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Lastname field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #Email').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Email field is required.<br/>");
				req_err = true;
			}
			if(req_err){ 
    			$('#addUsrvarForm #status').show();
    			$('#addUsrvarForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'edit', 
    				'username' : $('#addUsrvarForm #userName').val(),  
    				'value' : $('#addUsrvarForm #Value').val(),
    				'deviceseries' : $('#addUsrvarForm #DeviceSeries').val(),
    				'template' : $('#addUsrvarForm #Template').val(),
    				'id' : $('#addUsrvarForm #userId').val() })
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUsrvarForm #status').removeClass('alert-danger');
    					  $('#addUsrvarForm #status').addClass('alert-success');
    					  $('#addUsrvarForm #status').append("<strong>Success!</strong> User Name updated successfully.<br/>"); 
    					  $('#addUsrvarForm #status').show();
    		    		    window.setTimeout(function() {
    		    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		    		            $(this).hide(); 
    		    		        });
    		    		    }, 4000);
    		    		    return false;
    				  }
    			  });	
    			
    		}
		}); */
	
		$(document).on('click', '#addUsrvarForm #addusrvar', function(event) {
			var req_err = false;
			$('#modalLabelLarge').text('Add User Variable');
			$('#addUsrvarForm #status').html('');
			$('#addUsrvarForm #status').css("opacity","");
			if($('#addUsrvarForm #usrvarName').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> User Variable Name field is required.<br/>");
				req_err = true;
			}
			
			if($('#addUsrvarForm #usrvarval').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> Value field is required.<br/>");
				req_err = true;
			}
			if($('#addUsrvarForm #deviceseries').val() == ""){
				$('#addUsrvarForm #status').append("<strong>Error!</strong> DeviceSeries field is required.<br/>");
				req_err = true;
			}
			
			if(req_err){ 
    			$('#addUsrvarForm #status').show();
    			$('#addUsrvarForm #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}else{
    			$.post( "managescreen-process.php", { 'screen': "Usrvar", 'act' : 'add', 
    				'usrvarname' : $('#addUsrvarForm #usrvarname').val(),  
    				'value' : $('#addUsrvarForm #usrvarval').val(),
    				'deviceseries' : $('#addUsrvarForm #deviceseries').val()
    			})
    			  .done(function( data ) {
    				  if(data == 'success'){
    					  $('#addUsrvarForm #status').removeClass('alert-danger');
    					  $('#addUsrvarForm #status').addClass('alert-success');
    					  $('#addUsrvarForm #status').append("<strong>Success!</strong> User Variable Name added successfully.<br/>"); 
    					  $('#addUsrvarForm #usrvarName, #addUsrvarForm #Value, #addUsrvarForm #DeviceSeries').val('');
    					  
    					  $('#addUsrvarForm #status').show();
    		    		    window.setTimeout(function() {
    		    		        $(".alert-popup").fadeTo(500, 0).slideUp(500, function(){
    		    		            $(this).hide(); 
    		    		        });
    		    		    }, 4000);
    		    		    return false;
    				  }
    			  });	
    			
    		}
		});
		
		$(document).on("input", "#template-dropdown #select_device_name", function(event) {
			  refresh_telco_interface();
		  });
		$('select[name="templname"]').change(function(){
			$('.non-bandwidth').not('.panel-heading-lstmgmt').hide();
			var templnamefwd=$(this).val();
			$("#templnamefwd").val(templnamefwd);
			var table = $('#manageusrvars').DataTable();
			table.clear();
			var postval = templnamefwd.split('_');
			var f8val=postval[2];
			if(f8val=='1561S1'){
				f8val='15.6(1)S1'
			}
			
			$("#f7").val(postval[1]);
			$("#f8").val(f8val);
			$.post("ip-mgt-process.php", {
				'calltype': "trigger",
				'tempname': $(this).val(),
				'action': "GetUserVars"
			}).done(function(data) {
				dataarr = data.split(',');
				$(".non-bandwidth input").each(function() {
					if($.inArray($(this).attr('name'),dataarr) != -1){
						$(this).parent("div").show();
					}
				});
				$(".non-bandwidth select").each(function() {
					if($.inArray($(this).attr('name'),dataarr) != -1){
						$(this).parent("div").show();
					}
				});
				var sw;
				var resultdataarr=[];
				if (dataarr.length === 1) {
					$('#error_message').html("Error");
				}
				else{
					$.each(dataarr, function(i, e) {
						if ($.inArray(e, resultdataarr) == -1) resultdataarr.push(e);
					  });
					for (sw = 0; sw < resultdataarr.length; ++sw) {
						if (resultdataarr[sw] != '') { 
							$.post("ip-mgt-process.php", {
								'calltype': "trigger",
								'checkusrvarname': resultdataarr[sw],
								'action': "GetUserVarDetails"
							}).done(function(data1) {	
								var dataarr1={};
								dataarr1 = data1.split(',');
								if (dataarr1.length === 1) {
									$('#error_message').html("Error");
								}
								else{
									dataarr1 = jQuery.unique( dataarr1 );
									for (index = 0; index < dataarr1.length; index=index+5) { 
										table.row.add([dataarr1[index],
														dataarr1[index+1],
														dataarr1[index+2],
														dataarr1[index+3],
														dataarr1[index+4]]).draw();
									}  				
								}
							});
						} 
					}
				}
		
			});
			$.post("ip-mgt-process.php", {
						'calltype': "trigger",
						'getInterface': '1',
						'action': "GetInterfaceUsrVarDetails"
					}).done(function(interface_usrvar_data) {						
						interface_usrvar_dataarr = interface_usrvar_data.split(',');
						if (interface_usrvar_dataarr.length === 1) {
							$('#error_message').html("Error");
						}
						else{
							for (index = 0; index < interface_usrvar_dataarr.length; index=index+5) { 
								table.row.add( [interface_usrvar_dataarr[index],
												interface_usrvar_dataarr[index+1],
												interface_usrvar_dataarr[index+2],
												interface_usrvar_dataarr[index+3],
												interface_usrvar_dataarr[index+4]]).draw();							
							}
						}						
					}); 
			
	  });
		$(document).on('keypress, keydown', '#select_device_name', function(event) {
			var $field = $(this);
			if ((event.which != 37 && (event.which != 39)) &&
			  ((this.selectionStart < readOnlyLength) ||
				((this.selectionStart == readOnlyLength) && (event.which == 8)))) {
			  return false;
			}
		});
		
		$(document).on('change', "#select_switch", function(event) {
			var switchnamefwd = $(this).val();
			$("#f11").val(switchnamefwd);
			if ($(this).val() != "" && $('#template-dropdown #select_script_type').val() == 'BW-Upgrade') {
				  $('#template-dropdown #select_device_name').val($(this).val());
				  $('#f14').val($(this).val());
			  }else{
				  $('#template-dropdown #select_device_name').val('');
				  $('#f14').val('');
			  }
			  if ($('#select_switch').val() != ""){
					$.post("ip-mgt-process.php", {
					  'calltype': "configtrigger",
					  'select_switch' : $('#select_switch').val(),
					  'action': "GenerateScriptDeviceLoad"
					}).done(function(data) {
					  if (data != "") {
							readOnlyLength = data.length;
							$('#select_device_name').val(data);
							$('#f14').val(data);
							refresh_telco_interface();	
					  }
					});
					$.post("ip-mgt-process.php", {
						'calltype': "configtrigger",
						'select_switch' : $('#select_switch').val(),
						'action': "GenerateScriptTimezoneLoad"
					  }).done(function(data) {
						if (data != "") {
								$('#Time-Zone').val(data);
						}
					});
					
					$.post("ip-mgt-process.php", {
						'calltype': "configtrigger",
						'select_switch' : $('#select_switch').val(),
						'action': "GenerateScriptLoadVlanEven",
					  }).done(function(data) {
						if (data != "") {
							$('.VlanEven').html(data);
						}
					});
					$.post("ip-mgt-process.php", {
						'calltype': "configtrigger",
						'select_switch' : $('#select_switch').val(),
						'action': "GenerateScriptLoadVlanOdd",
					  }).done(function(data) {
						if (data != "") {
							$('.VlanOdd').html(data);
						}
					});
					
					
			  }
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
		
		$(document).on('change', "#select_device_name", function(event) {
			readOnlyLength = $('#select_device_name').val().length;
			$('#f14').val($('#select_device_name').val());
			
		});
		
		/* $(document).on('click', '#manageusrvars .deleteusrvar', function(event) {
			var usrvarId = $(this).closest('tr').data("usrvarid");
			var userName = $(this).closest('tr').find("td:eq(2)").text(); 
			$('#deleteUsrvarForm #usrvarId').val(usrvarId);
			$('#deleteUsrvarForm #usrvarNameDel').text(usrvarName);
        	var myModal = $('#deleteUsrvarForm');
        	myModal.modal('show');
			return false;
			
		}); */
		
		/* $(document).on('click', '#deleteUsrvarForm #deleteusrvar', function(event) {
			$.post( "managescreen-process.php", { 'screen': "User", 'act' : 'delete', 'id' : $('#deleteUsrvarForm #usrvarId').val() })
			  .done(function( data ) {
				  if(data == 'success'){
			        	var myModal = $('#deleteUsrvarForm'); 
			        	myModal.modal('hide');
		    		    return false;
				  }
			  });
		});
	    window.setTimeout(function() {
	        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	            $(this).hide(); 
	        });
	    }, 4000);
		$('#addUsrvarForm, #deleteUsrvarForm').on('hidden.bs.modal', function () {
			 location.reload();
		});
		  $('#Role').on('change', function(){
			  if(this.value != 1){
				  $('#calloutZonewrap').hide();
			  }else{
				  $('#calloutZonewrap').show();
			  }
		  }); */
});

function refresh_telco_interface(){
	$.post("ip-mgt-process.php", {
		'calltype': "configtrigger",
		'select_switch' : $('#template-dropdown #select_switch').val(),
		'action': "GenerateScriptTelcoInterfaceLoadEven",
		'select_script_type' : $(".gscript1 #select_script_type").val(),
		'select_device_name' : $('#cellsitech-generate-script #select_device_name').val(),
	  }).done(function(data) {
			if($(".gscript1 #select_script_type").val() == "BW-Upgrade"){
				$('.BW----Telco-Interface-ASR9010-Even').val(data);
			}else{
				$('.Telco-Interface-ASR9010-Even').html(data);
			}
	});
	$.post("ip-mgt-process.php", {
		'calltype': "configtrigger",
		'select_switch' : $('#template-dropdown #select_switch').val(),
		'action': "GenerateScriptTelcoInterfaceLoadOdd",
		'select_script_type' : $(".gscript1 #select_script_type").val(),
		'select_device_name' : $('#template-dropdown #select_device_name').val(),
	  }).done(function(data) {
			if($(".gscript1 #select_script_type").val() == "BW-Upgrade"){
				$('.BW----Telco-Interface-ASR9010-Odd').val(data);
			}else{
				$('.Telco-Interface-ASR9010-Odd').html(data);
			}
	});	
}
