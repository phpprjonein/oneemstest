$(document).ready(function() {
	  	var allVals = [];	  
	  	$(document).on('change', '.selector', function(event) {
		  var tr = $(this).closest('tr');
		  var id = tr.attr('id').replace('row_',''); 
		  if($(this).is(':checked')){
			  if(jQuery.inArray(id, allVals ) == -1){ 
			  		allVals.push(id);
			  }
		  }else{
			  	allVals.splice($.inArray(id, allVals), 1);
		  }	
	      $('#cbvals').val(allVals);
	    });
		
	
		if($('#batchpro').length > 0){
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#batchpro').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"batch-process.php",      
          "pageLength": 25,
          "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
            "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
          "columns": [
            {  "className":      'batch-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},
			{ "data": "deviceIpAddr" },
            { "data": "devicename" },
			{ "data": "deviceseries" },
            { "data": "market" },
            { "data": "nodeVersion" },
        ],
        "order": [[4, 'asc']],
        "createdRow": function (row, data, rowIndex) {
            $(row).addClass('device_row');
			  $.each($('td', row), function (colIndex) {
           	 if(colIndex == 0){
           		 if(jQuery.inArray($(this).closest('tr').attr('id').replace('row_',''), allVals ) == -1){
           			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>");
           		 }else{
           			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal' checked='checked'>");
           		 }
           	 }
            }); 
       }
      } );
	}
		

    	
    	
    	$('#batchModal').on('hidden.bs.modal', function () {
    		 window.location.href = 'batch-tracking-devices.php';
    		 //location.reload();
    	})
    	
    	$(document).on('click', '#batch-submit', function(event) {
			var req_err = false;
			$('#batch-page #status').html('');
			$('#batch-page #status').css("opacity","");
			
        	var allVals = $('#cbvals').val();
        	if(allVals.length == 0){
        		$('#batch-page #status').append("<strong>Error!</strong> Device selection is required");
            	req_err = true;	
        	}
        	if($('#scriptname').val().indexOf('BW-Upgrade') != -1){
            	if(allVals.split(',').length > 1){
            		$('#batch-page #status').append("<strong>Error!</strong> BW-Upgrade only one Device selection is allowed");
                	req_err = true;	
            	}
        	}
        	
			if(req_err){ 
    			$('#batch-page #status').show();
    			$('#batch-page #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
        	
			if($('#scriptname').val().indexOf('BW-Upgrade') != -1){
				$('#bwcategory').val(allVals);
				$('#bwbatchid').val($('#batchid').val());
				$('#bwdeviceseries').val($('#deviceseries').val());
				$('#bwdeviceos').val($('#deviceos').val());
				$('#bwsel-priority').val($('#sel-priority').val());
				$('#bwrefmop').val($('#refmop').val());
				$('#bwswitch_type').val($('#switch_type').val());
				
				var bwfilenames = $('#bwfilenames').val();
				var bwfilenames_arr = bwfilenames.split(',');

	            $.ajax({
	                type:"post",
	                url:"ip-mgt-process.php",
	                data: {'ctype':'BWBatchTabShow','bwswitch_type':$('#bwswitch_type').val(),'ip-address':$('#row_'+allVals).find('td:eq(1)').html(), 'category':allVals, 'batchid':$('#batchid').val(), 'scriptname':$('#bwfilenames').val(), 'deviceseries':$('#deviceseries').val(), 'deviceos':$('#deviceos').val(), 'priority':$('#sel-priority').val(), 'refmop':$('#refmop').val()}, 
	                success: function(resdata){
	                	$('#batchpreModal .modal-body').html(resdata);
	                	var myModal = $('#batchpreModal');
	            		myModal.modal('show'); 
	                }
	            });
				
				return false;
			}else{	
	    		if(confirm("Are you sure, do you want to create a batch ?")){
		            $.ajax({
		                type:"post",
		                url:"ip-mgt-process.php",
		                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'batchid':$('#batchid').val(), 'scriptname':$('#scriptname').val(), 'deviceseries':$('#deviceseries').val(), 'deviceos':$('#deviceos').val(), 'priority':$('#sel-priority').val(), 'refmop':$('#refmop').val()}, 
		                success: function(resdata){
		                	var myModal = $('#batchModal');
		            		myModal.modal('show'); 
		                }
		            });
	    		}
	            return false;
			}
    	}); 

      
      $(document).on('click', '#bwcreatebatch', function(event) {	
	  		if(confirm("Are you sure, do you want to create a batch ?")){
	  			var myModal = $('#batchpreModal');
    			myModal.modal('hide');
    			
	            $.ajax({
	                type:"post",
	                url:"ip-mgt-process.php",
	                data: {'ctype':'BWBatchTabUPdate','bwswitch_type':$('#bwswitch_type').val(),'ip-address':$('#row_'+allVals).find('td:eq(1)').html(), 'category':allVals, 'batchid':$('#batchid').val(), 'scriptname':$('#bwfilenames').val(), 'deviceseries':$('#deviceseries').val(), 'deviceos':$('#deviceos').val(), 'priority':$('#sel-priority').val(), 'refmop':$('#refmop').val()},
	                success: function(resdata){
	                	var myModal = $('#batchModal');
	            		myModal.modal('show'); 
	                }
	            });
			}
	        return false;
      });
      
	  $("#backup-restore-list-dt-filter a").click(function(){
    	  	allVals = [];	 
    	  	$('#cbvals').val('');
    		$("#backup-restore-list-dt-filter .btn").html($(this).text());
    		var listname = $(this).text();
			if($(this).text() == 'My routers'){
				listname = 0;
			}
    		
            var table =  $('#batchpro').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":"batch-process.php?listname="+listname,      
                "pageLength": 25,
                "dom": 'Bfrtip',
                "destroy": true,
      	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
                  "language": {
                  "lengthMenu": "Display _MENU_ records per page",
                  "zeroRecords": "No records found",
                  "info": "Showing page _PAGE_ of _PAGES_",
                  "infoEmpty": "",
                  "infoFiltered": ""
                  },
                "columns": [
                    {  "className":      'batch-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},
        			{ "data": "deviceIpAddr" },
                    { "data": "devicename" },
        			{ "data": "deviceseries" },
                    { "data": "market" },
                    { "data": "nodeVersion" },
              ],
              "order": [[4, 'asc']],
              "createdRow": function (row, data, rowIndex) {
                  $(row).addClass('device_row');
      			  $.each($('td', row), function (colIndex) {
                 	 if(colIndex == 0){
                 		 if(jQuery.inArray($(this).closest('tr').attr('id').replace('row_',''), allVals ) == -1){
                 			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>");
                 		 }else{
                 			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal' checked='checked'>");
                 		 }
                 	 }
                  }); 
             }
            } );
      });
});




function format ( d ) {
     var id = d.replace('row_','');
    
     return "<div id='detail_"+id+"'></div>";
     
  }

  function functionss(d) {
    alert(d);
  }
