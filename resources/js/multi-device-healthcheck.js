  $(document).ready(function () {
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
	  
      $('#multidevhc').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrtip',
			 "destroy": true,
			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
              url: 'multi-device-hc-process.php?loadtype=datatable&deviceseries=' + $("#device_series option:first").val()+'&vendorId='+$("#vendorId option:first").val(),
              type: 'GET'
          },
          "columns": [ 		
              {  "className":      'batch-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>"},	 
              {"data": "deviceIpAddr"},
              {"data": "devicename"},
              {"data": "deviceseries"},
              {"data": "market"},
              {"data": "nodeVersion"}
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
      });
      $("#devhc .dt-buttons").append('<a class="dt-button buttons-excel buttons-html5 dtexcelbtn dtexcelbtn-cs" tabindex="0" aria-controls="example"><span></span></a>');
            $('#device_series, #vendorId').change(function(){
            	alert('in ');
          	    allVals = [];	 
          	    $('#cbvals').val('');
    			var deviceseries = '';
    			var nodeVersion = '';
	          var table = $('#multidevhc').DataTable({
	              "processing": true,
	              "serverSide": true,
	    			 "dom": 'Bfrtip',
	    			 "destroy": true,
	    			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
	    				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
	    				 {extend: 'print',text: '',titleAttr:'Copy',className:'dtprintbtn'}
	    				 ],
	              "ajax": {
	            	  url: 'multi-device-hc-process.php?loadtype=datatable&deviceseries=' + $("#device_series option:selected").val()+'&vendorId='+$("#vendorId option:selected").val(),
	                  type: 'GET'
	              },
	              "columns": [ 		
	                  {  "className":      'batch-control',
	                      "orderable":      false,
	                      "data":           null,
	                      "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>"},	 
	                  {"data": "deviceIpAddr"},
	                  {"data": "devicename"},
	                  {"data": "deviceseries"},
	                  {"data": "market"},
	                  {"data": "nodeVersion"}
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
	          });
	          $("#devhc .dt-buttons").append('<a class="dt-button buttons-excel buttons-html5 dtexcelbtn dtexcelbtn-cs" tabindex="0" aria-controls="example"><span></span></a>');
            });
            })
      
      $(document).on('click', '.dtexcelbtn-cs', function(event) {
		  var sortInfo = $("#multidevhc").dataTable().fnSettings().aaSorting;
		  if($('#device_series').val() != 'Choose Device Series'){ 	
			  deviceseries = $('#device_series').val();
		  }
		  location.href = "xls-export-process.php?case=devhc&userid=" + $('#userid').val() + "&deviceseries=" + deviceseries +"&listname=" + listname + "&search=" + $('.dataTables_filter input').val() + "&column=" + sortInfo[0][0] + "&dir=" + sortInfo[0][1];
		  return false;
	  });
  
  
			$(document).on('click', '#multi-device-healthcheck', function(event) {
				var req_err = false;
				$('#multidevicehc #status').html('');
				$('#multidevicehc #status').css("opacity","");
	        	var allVals = $('#cbvals').val();
	        	if(allVals.length == 0){
	        		$('#multidevicehc #status').append("<strong>Error!</strong> Device selection is required");
	            	req_err = true;	
	        	}
				if(req_err){ 
	    			$('#multidevicehc #status').show();
	    			$('#multidevicehc #status').addClass('alert-danger');
	    		    window.setTimeout(function() {
	    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	    		            $(this).hide(); 
	    		        });
	    		    }, 4000);
	    			return false;
	    		}

				//if(confirm("Are you sure, do you want to do healthcheck of selected devices ?")){
				
				$.ajax({
	                type:"post",
	                url:"multi-device-hc-process.php?loadtype=healthcheck",
	                data: {'loadtype':'healthcheck', 'devices':allVals}, 
	                success: function(resdata){
	                	var obj = jQuery.parseJSON( resdata );
	                	$('#multihcModel .modal-body').html(obj.result);
	                	var myModal = $('#multihcModel');
	            		myModal.modal('show'); 
	                }
	            });
				

				//}
        	return false;
    	}); 

	
$(document).ready(function() {
	$('#multihcModel').on('hidden.bs.modal', function () {
		 location.reload();
	})
});		
			
