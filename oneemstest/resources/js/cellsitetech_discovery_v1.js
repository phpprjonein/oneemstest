$(document).ready(function() {
		  $('body').keypress(function(e){
		    if(e.which == 13 && $("#v-pills-tab .active").text() == 'Manual Discovery') {
		    	e.preventDefault();
		    	$("#manual-disc-utils #manual-discovery").trigger('click');
		    }
		  });
	$(".col-1 .nav-link").click(function(){
		if($(this).html() == 'Missed'){
			var ipmissedtable = $('#ip-missed-table').DataTable({
		          "processing": true,
		          "serverSide": true,
					 "dom": 'Bfrltip',
					 "destroy": true,
			          "lengthChange": true,
			          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
					 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
						 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
						 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
						 ],
		          "ajax": {
		              url: 'cellsitetech-discovery-process.php?class=m',
		              type: 'GET'
		          },
		          "columns": [ 		
		                  {"data": "deviceIpAddr"},
		                  {"data": "devicename"},
		                  {"data": "csr_site_id"},
		                  {"data": "csr_site_name"},
		                  {"data": "deviceseries"},
		                  {"data": "deviceos"},
		                  {"data": "nodeVersion"},
		                  {"data": "timepolled"},
		                  {"data": "timepolled", "sorting": false},
		                  {"data": "region", "className": "d-none"},
		                  {"data": "market", "className": "d-none"}
		          ],
					"order": [[3, 'asc']],
			        "createdRow": function (row, data, rowIndex) {
			             $(row).addClass('device_row');
						  $.each($('td', row), function (colIndex) {
			            	 if(colIndex == 8){
			            			 $(this).html('<button type="button" data-toggle="modal" class="btn btn-danger missed_update">UPDATE</button>');
			            	 }	
			             });
			        }
		      });
		}else if($(this).html() == 'New'){
			var ipnewtable = $('#ip-new-table').DataTable({
		          "processing": true,
		          "serverSide": true,
					 "dom": 'Bfrltip',
					 "destroy": true,
			          "lengthChange": true,
			          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
					 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
						 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
						 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
						 ],
		          "ajax": {
		              url: 'cellsitetech-discovery-process.php?class=n',
		              type: 'GET'
		          },
		          "columns": [ 		
		                  {"data": "deviceIpAddr"},
		                  {"data": "devicename"},
		                  {"data": "deviceseries"},
		                  {"data": "deviceos"},
		                  {"data": "nodeVersion"},
		                  {"data": "timepolled"},
		                  {"data": "region", "className": "d-none"},
		                  {"data": "market", "className": "d-none"},
		                  {"data": "upsince", "className": "d-none"},
		                  {"data": "csr_site_id", "className": "d-none"},
		                  
		          ],
		          language: {
		              lengthMenu: "Display _MENU_ records per page",
		              zeroRecords: "No records found",
		              info: "Showing page _PAGE_ of _PAGES_",
		              infoEmpty: "",
		              infoFiltered: ""
		            },
					"order": [[3, 'asc']],
		      });
		}else if($(this).html() == 'OK'){
			var ipoktable =  $('#ip-ok-table').DataTable( {
		          "processing": true,
		          "serverSide": true,
					 "dom": 'Bfrltip',
					 "destroy": true,
			          "lengthChange": true,
			          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
					 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
						 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
						 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
						 ],
		          "ajax": {
		              url: 'cellsitetech-discovery-process.php?class=k',
		              type: 'GET'
		          },
		          "columns": [ 		
		                  {"data": "deviceIpAddr"},
		                  {"data": "devicename"},
		                  {"data": "csr_site_id"},
		                  {"data": "csr_site_name"},
		                  {"data": "deviceseries"},
		                  {"data": "deviceos"},
		                  {"data": "nodeVersion"},
		                  {"data": "timepolled"},
		                  {"data": "region", "className": "d-none"},
		                  {"data": "market", "className": "d-none"},
		                  
		          ],
		          language: {
		              lengthMenu: "Display _MENU_ records per page",
		              zeroRecords: "No records found",
		              info: "Showing page _PAGE_ of _PAGES_",
		              infoEmpty: "",
		              infoFiltered: ""
		            },
					"order": [[3, 'asc']],
		      });
		}
	}); 
	
	$("#discovery-region a").click(function(){
		$("#discovery-region .btn").html($(this).text());
		$.post( "ip-mgt-process.php", { calltype: "trigger", region: $(this).text(), 'page-id':'discovery' })
		  .done(function( data ) {
			  $("#discovery-market button").text("SELECT MARKET");
			  $("#discovery-market .dropdown-menu").html(data);
		  });
	});
	$(document).on('click', '#discovery-market a', function(event) {
		$("#discovery-market .btn").html($(this).text());
	});
	
	
	$("#discovery-region a").click(function(){
		var ipconflicttable =  $('#ip-conflict-table').DataTable();
		var ipmissedtable =  $('#ip-missed-table').DataTable();
		var ipnewtable =  $('#ip-new-table').DataTable();
		var ipoktable =  $('#ip-ok-table').DataTable();
		
		if($(this).text() != 'SELECT REGION'){
			ipconflicttable.columns(11).search('^'+$(this).text()+'$', true, false).draw();
			ipmissedtable.columns(10).search('^'+$(this).text()+'$', true, false).draw();
			ipnewtable.columns(8).search('^'+$(this).text()+'$', true, false).draw();
			ipoktable.columns(10).search('^'+$(this).text()+'$', true, false).draw();
		}else{
			ipconflicttable.columns(11).search('').draw();
			ipmissedtable.columns(10).search('').draw();
			ipnewtable.columns(8).search('').draw();
			ipoktable.columns(10).search('').draw();
		}
	});
	$(document).on('click', '#discovery-market a', function(event) {
		var ipconflicttable =  $('#ip-conflict-table').DataTable();
		var ipmissedtable =  $('#ip-missed-table').DataTable();
		var ipnewtable =  $('#ip-new-table').DataTable();
		var ipoktable =  $('#ip-ok-table').DataTable();
		
		if($(this).text() != 'SELECT MARKET'){
			ipconflicttable.columns(12).search('^'+$(this).text()+'$', true, false).draw();
			ipmissedtable.columns(11).search('^'+$(this).text()+'$', true, false).draw();
			ipnewtable.columns(9).search('^'+$(this).text()+'$', true, false).draw();
			ipoktable.columns(11).search('^'+$(this).text()+'$', true, false).draw();
		}else{
			ipconflicttable.columns(12).search('').draw();
			ipmissedtable.columns(11).search('').draw();
			ipnewtable.columns(9).search('').draw();
			ipoktable.columns(11).search('').draw();
		}
	});
	
	// Missed Tab - 1-11 col, 11 no exp and 12, 13 region, market
		var ipmissedtable = $('#ip-missed-table').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrltip',
			 "destroy": true,
	          "lengthChange": true,
	          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
              url: 'cellsitetech-discovery-process.php?class=m',
              type: 'GET'
          },
          "columns": [ 		
                  {"data": "deviceIpAddr"},
                  {"data": "devicename"},
                  {"data": "csr_site_id"},
                  {"data": "csr_site_name"},
                  {"data": "deviceseries"},
                  {"data": "deviceos"},
                  {"data": "nodeVersion"},
                  {"data": "timepolled"},
                  {"data": "timepolled", "sorting": false},
                  {"data": "region", "className": "d-none"},
                  {"data": "market", "className": "d-none"}
          ],
			"order": [[3, 'asc']],
	        "createdRow": function (row, data, rowIndex) {
	             $(row).addClass('device_row');
				  $.each($('td', row), function (colIndex) {
	            	 if(colIndex == 8){
	            			 $(this).html('<button type="button" data-toggle="modal" class="btn btn-danger missed_update">UPDATE</button>');
	            	 }	
	             });
	        }
      });
	
	

	
	//Action JS
	$(document).on('click', '#ip-ok-table #inlineCheckbox1', function(event) {
		$.post( "ip-mgt-process.php", { calltype: "trigger", 'id':$(this).val(), 'action' : 'Disc-OK' })
		  .done(function( data ) {
			  alert("Status Updated Successfully");
			  location.reload();
		  });
	});
	
	$('#myModal').on('hidden.bs.modal', function () {
		 location.reload();
	});
	
	ok_all_item = function() {
        var confirmation = confirm('Are you sure you want to proceed?');
        if (confirmation) {
    		$.post( "ip-mgt-process.php", { calltype: "trigger", 'id':0, 'action' : 'Disc-OK' })
  		  	.done(function( data ) {
  			  alert("Status Updated Successfully");
  			  location.reload();
  		  });
        }
    };
    
    $(document).on('click', "#ip-missed-table .missed_update", function(event) {
    	var myModal = $('#Modal_Missed_Update');
    	myModal.find('.modal-body #ajax_loader').show();
    	myModal.modal('show');
    	
    	if($(this).closest('tr').find('td:eq(0)').html() == ""){
    		$('#missedDeviceIPaddress').val($(this).closest('tr').find('td:eq(1)').html());
    	}else{
    		$('#missedDeviceIPaddress').val($(this).closest('tr').find('td:eq(0)').html());
    	}
    	
    	
    	$.post( "ip-mgt-process.php", { 'type': "api-ajax",'page':'device-disc','missedDeviceIPaddress':$('#missedDeviceIPaddress').val()
    		}).done(function( data ) {
			var obj = jQuery.parseJSON( data );
			$('#Modal_Missed_Update').modal('hide');
			if(obj.result == true){
				myModal.find('.modal-body #response-txt h6').html('Device Update - Successful.');
				myModal.find('.modal-body #button-action #ip-ok').hide();
				myModal.find('.modal-body #button-action #ip-ignore').hide();
				myModal.find('.modal-body #button-action #ip-remove').hide();
			}else{
				myModal.find('.modal-body #response-txt h6').html('Device Ping - Failed.');
				myModal.find('.modal-body #button-action #ip-ok').show();
				myModal.find('.modal-body #button-action #ip-ignore').show();
				myModal.find('.modal-body #button-action #ip-remove').show();
			}
			myModal.find('.modal-body #ajax_loader').hide();
			myModal.find('.modal-body #discovery-missed-ip').show();
			$('#Modal_Missed_Update').modal('show');
		});
    	return false;
    });
    
    $(document).on('click', "#discovery-missed-ip #button-action button", function(event) {
    	$("#Modal_Missed_Update #button-action button").attr("disabled", "disabled");
    	var myModal = $('#Modal_Missed_Update');
    	if(this.value == 'Ignore'){
    		myModal.modal('hide');
    	}else{
    		$.post( "ip-mgt-process.php", { 'calltype': "trigger", 'action' : 'IP-Miss-Process', 'IP-address' : $("#missedDeviceIPaddress").val(), 'process' : this.value })
  		  	.done(function( data ) {
  				$('#Modal_Missed_Update #status').css("opacity","");
				$('#Modal_Missed_Update #status').html("<strong>Success!</strong> Status Updated Successfully<br/>");
				$('#Modal_Missed_Update #status').addClass('alert-success');
				$('#Modal_Missed_Update #status').show();
			    window.setTimeout(function() {
			        $(".alert").fadeTo(500, 0).slideUp(500, function(){
			            $(this).hide(); 
			            $("#Modal_Missed_Update #button-action button").removeAttr("disabled");  
			            location.reload();
			        });
			    }, 4000);
  		  	});
    	}
    	return false;
    });
    
    
    $(document).on('click', "#ip-new-table .addDeviceModal", function(event) {	
    	$('#inputRegion').val($(this).closest('tr').find('td:eq(8)').html());
    	$('#inputMarket').val($(this).closest('tr').find('td:eq(9)').html());
    	$('#inputDevicename').val($(this).closest('tr').find('td:eq(2)').html());
    	$('#inputSysName').val($(this).closest('tr').find('td:eq(2)').html() + "ABC");
    	
    	if($(this).closest('tr').find('td:eq(0)').html() == ""){
    		$('#inputDeviceIPaddress').val($(this).closest('tr').find('td:eq(1)').html());
    	}else{
    		$('#inputDeviceIPaddress').val($(this).closest('tr').find('td:eq(0)').html());
    	}
    	$('#inputDeviceSeries').val($(this).closest('tr').find('td:eq(3)').html());
    	
    	var deviceseries = $(this).closest('tr').find('td:eq(3)').html();
    	/*Populate Node Category*/
    	if(deviceseries.search("Router") >=0 ){
    		$('#inputNodeCatID').val('Routers');
    	}else if(deviceseries.search("Switch") >=0 ){
    		$('#inputNodeCatID').val('Switches');
    	}
    	/*Populate Node Vendor*/
    	if(deviceseries.search("Cisco") >=0 ){
    		$('#inputVendorID').val('Cisco');
    	}else if(deviceseries.search("Nokia") >=0 ){
    		$('#inputVendorID').val('Nokia');
    	}else if(deviceseries.search("Juniper") >=0 ){
    		$('#inputVendorID').val('Juniper');
    	}
    	
    	
    	$('#inputDeviceOS').val($(this).closest('tr').find('td:eq(4)').html());
    	$('#inputNodeVersion').val($(this).closest('tr').find('td:eq(4)').html());
    	$('#inputUpSince').val($(this).closest('tr').find('td:eq(10)').html());
    	$('#inputLastPolled').val($(this).closest('tr').find('td:eq(6)').html());
       	$('#addDeviceModal').modal('show');
    	return false;
    });
    
   
    $('#addDeviceModal #tech-details input:radio').change(function() {
    	var selected = $("#addDeviceModal #tech-details input[name='added-details']:checked").val();
    	if(selected == 1){
    		$('#addDeviceModal .site-name-exist').show();
    		$('#addDeviceModal .site-name-new').hide();
    	}else{
    		$('#addDeviceModal .site-name-exist').hide();
    		$('#addDeviceModal .site-name-new').show();
    	}
     });
    /*
    $(document).on('change', "#addDeviceModal #inputCSRTechID", function(event) {
		$.post( "ip-mgt-process.php", { calltype: "trigger", 
			'csrsitetechid':this.value, 
			'action':'Tech Manager ID'
		}).done(function( data ) {
			$('#inputCSRMgrID').html(data);	
		});
		$.post( "ip-mgt-process.php", { calltype: "trigger", 
			'csrsitetechid':this.value, 
			'action':'Site Name'
		}).done(function( data ) {
			$('#inputCSRSiteName').html(data);	
		});
    });
    */
    
    
    $('#inputCSRSiteTechName').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
                data: 'type=autocomplete&category=site-tech-name&query=' + query,            
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
    $("#addDeviceModal #inputCSRSiteTechName").on("change", function(event) {
		$.post( "ip-mgt-process.php", { type: "loadauto", 
			'csr_tech_name':this.value, 
		}).done(function( data ) {
			var obj = jQuery.parseJSON( data );
			$("#addDeviceModal #inputCSRSiteTechMgrName").val(obj.csr_site_tech_mgr_name);
		});
    });

    $('#inputCSRSiteTechNameID').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
				data: 'type=autocomplete&category=site-tech-name&query=' + query,            
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
    
    $('#inputCSRSiteName').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
				data: 'type=autocomplete&category=site-name&query=' + query + "&region=" + $("#inputRegion").val() +"&market=" + $("#inputMarket").val(),            
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
    
   $("#addDeviceModal #inputCSRSiteName").on("change", function(event) {
	   $("#addDeviceModal #inputCSRSiteID").val(this.value);
	});
	
	
    $("#addDeviceModal #inputCSRSiteTechNameID").on("change", function(event) {
		$("#addDeviceModal #inputCSRSiteTechName").val(this.value);		
		$.post( "ip-mgt-process.php", { type: "loadauto", 
			'csr_tech_name':this.value, 
		}).done(function( data ) {
			var obj = jQuery.parseJSON( data );
			$("#addDeviceModal #inputCSRSiteTechMgrNameID").val(obj.csr_site_tech_mgr_name);
			$("#addDeviceModal #inputCSRSiteTechNameIDVal").val(obj.csr_site_tech_id);
			$("#addDeviceModal #inputCSRSiteTechMgrNameIDVal").val(obj.csr_site_tech_mgr_id);
			$("#addDeviceModal #inputCSRSiteTechMgrName").val(obj.csr_site_tech_mgr_name);
			
			
		});
    });
    
    $('#inputCSRTechID').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
				data: 'type=autocomplete&query=' + query,            
                dataType: "json",
                type: "POST",
                success: function (data) {
					result($.map(data, function (index, value) {
						return value;
                    }));
                }
            });
        }
    });
    
    $("#addDeviceModal #inputCSRTechID").on("change", function(event) {
		$.post( "ip-mgt-process.php", { type: "loadauto", 
			'csr_tech_id':this.value, 
		}).done(function( data ) {
			$("#addDeviceModal #inputCSRMgrID").val(data);
		});
		$.post( "ip-mgt-process.php", { calltype: "trigger", 
			'csrsitetechid':this.value, 
			'action':'Site Name'
		}).done(function( data ) {
			$('#inputCSRSiteName').html(data);	
		});
    });
    
	$(document).on('click', '#manual-disc-utils #manual-disc-market a', function(event) {
		$("#manual-disc-market .btn").html($(this).text());
	});
	
	$("#manual-disc-utils #manual-discovery").click(function(e){
		var req_err = false;
		$('#v-pills-manual #status').html('');
		$('#v-pills-manual #status').css("opacity","");
		if($('#v-pills-manual #inputDeviceIPaddress').val() == ""){
			$('#v-pills-manual #status').html("<strong>Error!</strong> Device IP Address field is required.<br/>");
			$('#v-pills-manual #status').addClass('alert-danger');
			$('#v-pills-manual #status').show();
			req_err = true;
		}else{
			e.preventDefault();
			$.post( "ip-mgt-process.php", { calltype: "trigger", action: "IP-Validate-Disc", type: 'IPv4ORIPv6', 'ipaddress':$('#v-pills-manual #inputDeviceIPaddress').val()})
			  .done(function( data ) {
				  if(data == 'invalid-ip'){
		    			$('#v-pills-manual #status').append("<strong>Error!</strong> Device IP Address is not valid.<br/>");
		    			$('#v-pills-manual #status').addClass('alert-danger');
		    			req_err = true;
		        		if(req_err){ 
		        			$('#v-pills-manual #status').show();
		        		    window.setTimeout(function() {
		        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		        		            $(this).hide(); 
		        		        });
		        		    }, 4000);
		        			return false;
		        		}
				  }/*else if(data == 'ip-exist'){
		    			$('#v-pills-manual #status').append("<strong>Error!</strong> Device IP Address already exist.<br/>");
		    			$('#v-pills-manual #status').addClass('alert-danger');
		    			req_err = true;
		        		if(req_err){ 
		        			$('#v-pills-manual #status').show();
		        		    window.setTimeout(function() {
		        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		        		            $(this).hide(); 
		        		        });
		        		    }, 4000);
		        			return false;
		        		}
			  	  }*/else{
	        			var myModal = $('#myModal');
	        			myModal.find('.modal-body').css('min-height','150px');
	        			myModal.find('.modal-body').html('<div id="ajax_loader" style="position: absolute; left: 50%; top: 50%; display: start;">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
	        			myModal.modal('show'); 
	        			$.post( "api-test-manual-device-disc.php", { type: "api-ajax",'ip-address':$('#v-pills-manual #inputDeviceIPaddress').val(),  
	        			}).done(function( data ) {
	        				$('#myModal .modal-body').html(data);	
	        			}); 
	        		}
			 });
		}
		/*
		if(($("#v-pills-manual #manual-disc-market .btn").html().trim() == "SELECT MARKET")){
			$('#v-pills-manual #status').append("<strong>Error!</strong> Select Market field is required.<br/>");
			$('#v-pills-manual #status').addClass('alert-danger');
			$('#v-pills-manual #status').show();
			req_err = true;
		} */
		if(req_err){ 
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
		

	});
    
	$("#discovery-new-ip #add-new-ip").click(function(){
		var req_err = false;
		$('#addDeviceModal #status').html('');
		$('#addDeviceModal #status').css("opacity","");
		
		if($('#inputCSRSiteTechNameID').val() == ""){
			$('#addDeviceModal #status').html("<strong>Error!</strong> Tech Name field is required.<br/>");
			$('#addDeviceModal #status').addClass('alert-danger');
			$('#addDeviceModal #status').show();
			req_err = true;
		}
		if(($('#inputCSRSiteName').val() == "") && ($('#inputCSRSiteNameNew').val() == "")){
			$('#addDeviceModal #status').append("<strong>Error!</strong> Site Name field is required.<br/>");
			$('#addDeviceModal #status').addClass('alert-danger');
			$('#addDeviceModal #status').show();
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
		var selected = $("#addDeviceModal #tech-details input[name='added-details']:checked").val();
		if(selected == 1){
			var inputCSRSiteName = $('#inputCSRSiteName').val();
    	}else{
    		var inputCSRSiteName = $('#inputCSRSiteNameNew').val();	
    	}
		$.post( "ip-mgt-process.php", { calltype: "trigger", 
			'region':	$('#inputRegion').val(),
			'market':	$('#inputMarket').val(),
			'devicename':$('#inputDevicename').val(),
			'deviceIpAddr':	$('#inputDeviceIPaddress').val(),
			'nodeAddedBy':	$('#inputNodeAddedBy').val(),
			'nodeCatId':	$('#inputNodeCatID').val(),
			'vendorId':$('#inputVendorID').val(),
			'deviceseries':	$('#inputDeviceSeries').val(),
			'status':1,
			'csr_site_tech_name':	$('#inputCSRSiteTechName').val(),
			'csr_site_tech_mgr_name':	$('#inputCSRSiteTechMgrName').val(),
			'csr_site_id':	$('#inputCSRSiteID').val(),
			'systemname':	$('#inputSysName').val(),
			'deviceos':	$('#inputDeviceOS').val(),	
			'csr_site_tech_id':	$('#inputCSRSiteTechNameIDVal').val(),
			'csr_site_tech_mgr_id':	$('#inputCSRSiteTechMgrNameIDVal').val(),
			'csr_site_name': inputCSRSiteName,		//need dynamic calculation
			'nodeVersion':	$('#inputDeviceOS').val(),
			'lastpolled': $('#inputLastPolled').val(),
			'deviceDateAdded': $('#inputDeviceDateAdded').val(),
			'deviceLastUpdated':$('#inputDeviceLastUpdated').val(),
			'upsince':	$('#inputUpSince').val(),
			'switch_name':	$('#inputSwitchName').val(),
			'action' : 'Add New'
			
		}).done(function( data ) {
			$('#addDeviceModal #status').html("<strong>Success!</strong> Device Added Successfully<br/>");
			$('#addDeviceModal #status').addClass('alert-success');
			$('#addDeviceModal #status').show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		            location.reload();
		        });
		    }, 4000);	
		  });	
	});
	$("#mandiscsubmit").click(function(e){
		var req_err = false;
		$('#manual-disc-utils-pop #status').html('');
		$('#manual-disc-utils-pop #status').css("opacity","");
		if($('#manual-disc-utils-pop #inputDeviceIPaddress').val() == ""){
			$('#manual-disc-utils-pop #status').html("<strong>Error!</strong> Device IP Address field is required.<br/>");
			$('#manual-disc-utils-pop #status').addClass('alert-danger');
			$('#manual-disc-utils-pop #status').show();
			req_err = true;
		}else{
			e.preventDefault();
			$.post( "ip-mgt-process.php", { calltype: "trigger", action: "IP-Validate-Disc", type: 'IPv4ORIPv6', 'ipaddress':$(' #inputDeviceIPaddress').val()})
			  .done(function( data ) {
				  if(data == 'invalid-ip'){
		    			$('#manual-disc-utils-pop #status').append("<strong>Error!</strong> Device IP Address is not valid.<br/>");
		    			$('#manual-disc-utils-pop #status').addClass('alert-danger');
		    			req_err = true;
		        		if(req_err){ 
		        			$('#manual-disc-utils-pop #status').show();
		        		    window.setTimeout(function() {
		        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		        		            $(this).hide(); 
		        		        });
		        		    }, 4000);
		        			return false;
		        		}
				  }else if(data == 'ip-exist'){
		    			$('#manual-disc-utils-pop #status').append("<strong>Error!</strong> Device IP Address already exist.<br/>");
		    			$('#manual-disc-utils-pop #status').addClass('alert-danger');
		    			req_err = true;
		        		if(req_err){ 
		        			$('#manual-disc-utils-pop #status').show();
		        		    window.setTimeout(function() {
		        		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		        		            $(this).hide(); 
		        		        });
		        		    }, 4000);
		        			return false;
		        		}
			  	  }else{
						$.ajax({
			                type:"post",
			                url:"ip-mgt-process.php",					
			                data: {'ctype':'manualdisc', 'devnameval':$('#devnameval').text(), 'devosval':$('#devosval').text(), 'devseriesval':$('#devseriesval').text(),'devstatusval':$('#devstatusval').text(), 'lastpollval':$('#lastpollval').text(), 'modelval':$('#modelval').text(), 'nodeverval': $('#nodeverval').text(),'statval':$('#statval').text(), 'sysconval':$('#sysconval').text(), 'syslocval' : $('#syslocval').text(), 'upsinceval' : $('#upsinceval').text(), 'switchnameval' : $('#switchnameval').text(), 'mktval' : $('#mktval').text(), 'rgnval' : $('#rgnval').text(), 'ip-address' : $('#ip-address').val()},
			                success: function(resdata){					
			                	$('#mandiscsubmit').hide();
			                	$('#myModal .modal-body').html('Device added Successfully');
			                }
			            });
			  	  }
			 });
		}
		if(req_err){ 
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
	});
	$('#Modal_Missed_Update').on('hidden.bs.modal', function () {
			 //location.reload();
			 window.location.href = 'cellsitetech-discovery-v1.php';
	})
});
