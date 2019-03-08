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
      $('#swdelvrybatchpro').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrtip',
			 "destroy": true,
			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
			  url: 'bootorder-delivery-process.php',
              type: 'GET'
          },
          "columns": [ 		
              {  "className":      'batch-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},	 
              {"data": "id"},
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
      $("#backup-restore-list-dt-filter a").click(function(){
    	  allVals = [];	 
    	  $('#cbvals').val('');
  		$("#backup-restore-list-dt-filter .btn").html($(this).text());
  		var listname = $(this).text().trim();
			if($(this).text() == 'My routers'){
				listname = 0;
			}
			var deviceseries = '';
			var nodeVersion = '';
		  if($('#device_series').val() != 'Choose Device Series'){ 	
			  deviceseries = $('#device_series').val();
		  }	  
		  if($('#node_version').val() != 'Choose OS Version'){
			  nodeVersion = $('#node_version').val();	
		  }
          var table = $('#swdelvrybatchpro').DataTable({
              "processing": true,
              "serverSide": true,
    			 "dom": 'Bfrtip',
    			 "destroy": true,
    			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
    				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
    				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
    				 ],
              "ajax": {
                  url: 'software-delivery-process.php?listname='+listname+'&deviceseries='+deviceseries+'&nodeVersion='+nodeVersion,
                  type: 'GET'
              },
              "columns": [ 		
                  {  "className":      'batch-control',
                      "orderable":      false,
                      "data":           null,
                      "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},	 
                  {"data": "id"},
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
          });;
    });
      
            $('#device_series').change(function(){
          	    allVals = [];	 
          	    $('#cbvals').val('');
    			var deviceseries = '';
    			var nodeVersion = '';
    	  		var listname = $("#backup-restore-list-dt-filter .btn").text().trim();
    				if(listname == 'My routers'){
    					listname = 0;
    				}

    			  if($('#device_series').val() != 'Choose Device Series'){ 	
    				  deviceseries = $('#device_series').val();
    			  }	  
    			  if($('#node_version').val() != 'Choose OS Version'){
    				  nodeVersion = $('#node_version').val();	
    			  }
                
				$.ajax({
					type: "POST",
					url: 'getnodeversion.php',
					data: {'dropdownValue': deviceseries},
					success: function(data){
					$('#node_version').html(data);	
					}
				});	
				
				$.ajax({
					type: "POST",
					url: 'getfilenames.php',
					data: {'deviceseries': deviceseries, 'nodeVersion' : nodeVersion},
					success: function(data){
					$('#swrp_filename').html(data);
					$('.chosen-select').trigger("chosen:updated");
					}
				});
            	
	          var table = $('#swdelvrybatchpro').DataTable({
	              "processing": true,
	              "serverSide": true,
	    			 "dom": 'Bfrtip',
	    			 "destroy": true,
	    			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
	    				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
	    				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
	    				 ],
	              "ajax": {
	                  url: 'bootorder-delivery-process.php?listname='+listname+'&deviceseries='+deviceseries,
	                  type: 'GET'
	              },
	              "columns": [ 		
	                  {  "className":      'batch-control',
	                      "orderable":      false,
	                      "data":           null,
	                      "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},	 
	                  {"data": "id"},
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
	          });;
            });
            })
			$(document).on('click', '#batch-submit', function(event) {
				var req_err = false;
				$('#sw-delivery-devices #status').html('');
				$('#sw-delivery-devices #status').css("opacity","");
				
	        	var allVals = $('#cbvals').val();
	        	/*$('#swdelvrybatchpro').children().find('input[type=checkbox]:checked').each(function(index){
	        		allVals.push($(this).closest('tr').find("td:eq(1)").text());
	        	});*/
	        	if(allVals.length == 0){
	        		$('#sw-delivery-devices #status').append("<strong>Error!</strong> Device selection is required");
	            	req_err = true;	
	        	}
				if(req_err){ 
	    			$('#sw-delivery-devices #status').show();
	    			$('#sw-delivery-devices #status').addClass('alert-danger');
	    		    window.setTimeout(function() {
	    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	    		            $(this).hide(); 
	    		        });
	    		    }, 4000);
	    			return false;
	    		}
	        	
				if(confirm("Are you sure, do you want to create a batch ?")){
			  		  if($('#device_series').val() == 'Choose Device Series'){ 	
						  deviceseries = '';
					  }else{
						  deviceseries = $('#device_series').val();
					  }	  
					  if($('#node_version').val() == 'Choose OS Version'){
						  nodeVersion = '';	
					  }else{
						  nodeVersion = $('#node_version').val();
					  }
		        	
		            $.ajax({
		                type:"post",
		                url:"software-delivery-batch-process.php",
		                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'scriptname':$('#swrp_filename').val(), 'deviceseries':deviceseries, 'priority':$('#sw_selpriority').val(), 'batchtype':'bootorder', 'batchid':$('#batchid').val()}, 
		                success: function(resdata){
		                	var myModal = $('#batchModal');
		            		myModal.modal('show'); 
		                }
		            });
				}
        	return false;
    	}); 

	
$(document).ready(function() {

	$('#batchModal').on('hidden.bs.modal', function () {
		 //location.reload();
		 window.location.href = 'batch-tracking-devices.php';
	})
});		
			
