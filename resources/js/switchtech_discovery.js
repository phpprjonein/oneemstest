$(document).ready(function() {
	$(".col-1 .nav-link").click(function(){
		if($(this).html() == 'Conflicts'){
			$('#export-v-pills-conflict').show();
			$('#search-v-pills-conflict').show();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'Missed'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').show();
			$('#search-v-pills-missed').show();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'New'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').show();
			$('#search-v-pills-new').show();
			$('#export-v-pills-ok').hide();
			$('#search-v-pills-ok').hide();
		}else if($(this).html() == 'OK'){
			$('#export-v-pills-conflict').hide();
			$('#search-v-pills-conflict').hide();
			$('#export-v-pills-missed').hide();
			$('#search-v-pills-missed').hide();
			$('#export-v-pills-new').hide();
			$('#search-v-pills-new').hide();
			$('#export-v-pills-ok').show();
			$('#search-v-pills-ok').show();
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

	// Conflict Tab - 1-11 col, 11 no exp and 12, 13 region, market
	if($('#ip-conflict-table1').length > 0){
		var ipconflicttable =  $('#ip-conflict-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}}], 
		 "order": [[0, 'asc']],
		 } );
		ipconflicttable.buttons().container().appendTo('#export-v-pills-conflict');
	       $('#search-v-pills-conflict input').keyup(function(){
	    	   ipconflicttable.search($(this).val()).draw() ;
	       });
	}
	
	// Missed Tab - 1-11 col, 11 no exp and 12, 13 region, market
	if($('#ip-missed-table').length > 0){
		var ipmissedtable =  $('#ip-missed-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]}}], 
		 "order": [[0, 'asc']],
		
		 } );
		ipmissedtable.buttons().container().appendTo('#export-v-pills-missed');
       $('#search-v-pills-missed input').keyup(function(){
    	   ipmissedtable.search($(this).val()).draw() ;
       });
	}
	
	
	
	// New Tab - 1- 8 col, 8 no exp and 9, 10 region, market
	if($('#ip-new-table').length > 0){
		var ipnewtable =  $('#ip-new-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{"bSortable": false},{},{},{},{}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7]}}], 
		   "order": [[0, 'asc']],
		 } );
		ipnewtable.buttons().container().appendTo('#export-v-pills-new');
	       $('#search-v-pills-new input').keyup(function(){
	    	   ipnewtable.search($(this).val()).draw() ;
	       });
	}
	
	// OK Tab - 1- 10 col, 10 no exp and 11, 12 region, market
	if($('#ip-ok-table').length > 0){
		var ipoktable =  $('#ip-ok-table').DataTable( {
		"aoColumns": [{},{},{},{},{},{},{},{},{},{"bSortable": false},{"bVisible": false},{"bVisible": false}],	
		 "processing": true,
		 "pageLength": 20,
		 "searching" : false,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]}}], 
		 "order": [[0, 'asc']],
		 } );
        ipoktable.buttons().container().appendTo('#export-v-pills-ok');
        
       $('#search-v-pills-ok input').keyup(function(){
        	ipoktable.search($(this).val()).draw() ;
       });
	}	
	
	//Action JS
	$(document).on('click', '#ip-ok-table #inlineCheckbox1', function(event) {
		$.post( "ip-mgt-process.php", { calltype: "trigger", 'id':$(this).val(), 'action' : 'Disc-OK' })
		  .done(function( data ) {
			  alert("Status Updated Successfully");
			  location.reload();
		  });
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
    	
    	
    	$.post( "api-test.php", { type: "api-ajax"
		}).done(function( data ) {
			var obj = jQuery.parseJSON( data );
			$('#Modal_Missed_Update').modal('hide');
			if(obj.result == true){
				myModal.find('.modal-body #response-txt h6').html('Device Ping - Successful.');
				myModal.find('.modal-body #button-action #ip-ok').show();
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
});
