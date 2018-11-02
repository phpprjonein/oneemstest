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
	  
	  var table1 = $('#auditinglog').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrltip',
			 "destroy": true,
	          "lengthChange": true,
	          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
              url: 'software-delivery-audit-log-process.php',
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
                  {"data": "aurundate"},
                  {"data": "market"},
                  {"data": "nodeVersion"},
                  {"data": "region"},
                  {"data": "austatus"},
                  {"data": "austatus"},
          ],
			"order": [[5, 'asc']],
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
	            	 if(colIndex == 9){
	            		//if($(this).text().toLowerCase() == 'fail'){
	            		 var region = $(this).closest('tr').find('td:eq(7)').html().toLowerCase();
	            		 var market = $(this).closest('tr').find('td:eq(5)').html();
	            		 var devicename = $(this).closest('tr').find("td:eq(2)").text();
	            		 //$(this).html('<a href="download.php?file=upload/audit/' + $(this).closest('tr').find("td:eq(2)").text() + '.pdf">'+ $(this).closest('tr').find("td:eq(2)").text() +'.pdf</a>');
	            		 	$(this).html('<a href="download.php?file=/usr/apps/oneems/config/bkup/' + region + '/audit/' + market + '/' + devicename + '.txt">' + devicename +'.txt</a>');
	            		 //}else{
	            		 //      $(this).text('');
	            		 //}
	            	 }	 	
	             }); 
	        }
      });
	  table1.buttons().container().appendTo('#export-v-pills-home');
      $('.pagelength').html('');
      // $('#auditinglog_length').appendTo('.pagelength');
	  $('#search-v-pills-home input').keyup(function(){
      	table1.search($(this).val()).draw() ;
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
          var table1 = $('#auditinglog').DataTable({
              "processing": true,
              "serverSide": true,
    			 "dom": 'Bfrltip',
    			 "destroy": true,
    	          "lengthChange": true,
    	          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
    			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
    				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
    				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
    				 ],
              "ajax": {
                  url: 'software-delivery-audit-log-process.php?listname='+listname,
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
                      {"data": "aurundate"},
                      {"data": "market"},
                      {"data": "nodeVersion"},
                      {"data": "region"},
                      {"data": "austatus"},
                      {"data": "austatus"},
              ],
    			"order": [[5, 'asc']],
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
    	            	 if(colIndex == 9){
    	            		//if($(this).text().toLowerCase() == 'fail'){
    	            		 var region = $(this).closest('tr').find('td:eq(7)').html().toLowerCase();
    	            		 var market = $(this).closest('tr').find('td:eq(5)').html();
    	            		 var devicename = $(this).closest('tr').find("td:eq(2)").text();
    	            		 //$(this).html('<a href="download.php?file=upload/audit/' + $(this).closest('tr').find("td:eq(2)").text() + '.pdf">'+ $(this).closest('tr').find("td:eq(2)").text() +'.pdf</a>');
    	            		 	$(this).html('<a href="download.php?file=/usr/apps/oneems/config/bkup/' + region + '/audit/' + market + '/' + devicename + '.txt">' + devicename +'.txt</a>');
    	            		 //}else{
    	            		 //      $(this).text('');
    	            		 //}
    	            	 }	 	
    	             }); 
    	        }
          });
          $('.pagelength').html('');
          // $('#auditinglog_length').appendTo('.pagelength');
          table1.buttons().container().appendTo('#export-v-pills-home');
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
    			  /*if($('#node_version').val() != 'Choose OS Version'){
    				  nodeVersion = $('#node_version').val();	
    			  }
                
				$.ajax({
					type: "POST",
					url: 'getnodeversion.php',
					data: {'dropdownValue': deviceseries},
					success: function(data){
					$('#node_version').html(data);	
					}
				});	*/
				
				$.ajax({
					type: "POST",
					url: 'getfilenames.php',
					data: {'deviceseries': deviceseries, 'nodeVersion' : nodeVersion},
					success: function(data){
					$('#swrp_filename').html(data);
					$('.chosen-select').trigger("chosen:updated");
					}
				});
            	
	          var table = $('#auditinglog').DataTable({
	              "processing": true,
	              "serverSide": true,
	    			 "dom": 'Bfrltip',
	    			 "destroy": true,
	    	          "lengthChange": true,
	    	          "lengthMenu": [ 14, 25, 50, 100, 200, 500 ],
	    			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
	    				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
	    				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
	    				 ],
	              "ajax": {
	                  url: 'software-delivery-audit-log-process.php',
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
	                      {"data": "aurundate"},
	                      {"data": "market"},
	                      {"data": "nodeVersion"},
	                      {"data": "region"},
	                      {"data": "austatus"},
	                      {"data": "austatus"},
	              ],
	    			"order": [[5, 'asc']],
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
	    	            	 if(colIndex == 9){
	    	            		//if($(this).text().toLowerCase() == 'fail'){
	    	            		 var region = $(this).closest('tr').find('td:eq(7)').html().toLowerCase();
	    	            		 var market = $(this).closest('tr').find('td:eq(5)').html();
	    	            		 var devicename = $(this).closest('tr').find("td:eq(2)").text();
	    	            		 //$(this).html('<a href="download.php?file=upload/audit/' + $(this).closest('tr').find("td:eq(2)").text() + '.pdf">'+ $(this).closest('tr').find("td:eq(2)").text() +'.pdf</a>');
	    	            		 	$(this).html('<a href="download.php?file=/usr/apps/oneems/config/bkup/' + region + '/audit/' + market + '/' + devicename + '.txt">' + devicename +'.txt</a>');
	    	            		 //}else{
	    	            		 //      $(this).text('');
	    	            		 //}
	    	            	 }	 	
	    	             }); 
	    	        }
	          });
            });
            })
			$(document).on('click', '#batch-submit', function(event) {
				var req_err = false;
				$('#sw-delivery-devices #status').html('');
				$('#sw-delivery-devices #status').css("opacity","");
				
	        	var allVals = $('#cbvals').val();
	        	/*$('#auditinglog').children().find('input[type=checkbox]:checked').each(function(index){
	        		allVals.push($(this).closest('tr').find("td:eq(1)").text());
	        	});*/
				$('#sw-delivery-devices #status').css("opacity","");  
				/*if($('#sw-delivery-devices #device_series').val() == ""){
					$('#sw-delivery-devices #status').append("<strong>Error!</strong> Device series field is required.<br/>");
					req_err = true;
				};
				if($('#sw-delivery-devices #swrp_filename').val() == null || $('#sw-delivery-devices #swrp_filename').val() == ""){
					$('#sw-delivery-devices #status').append("<strong>Error!</strong> Filename field is required.<br/>");
					req_err = true;
				};
				if($('#sw-delivery-devices #destdrive').val() == ""){
					$('#sw-delivery-devices #status').append("<strong>Error!</strong> Destination path is required.<br/>");
					req_err = true;
				};*/ 
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
			  		  
					  deviceseries = nodeVersion = ''
		        	
		            $.ajax({
		                type:"post",
		                url:"software-delivery-batch-process.php",
		                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'scriptname':$('#swrp_filename').val(), 'deviceseries':deviceseries, 'node_version':'', 'priority':1, 'batchtype':'cusauditinglog', 'destdrive':$('#destdrive').val(), 'batchid':$('#batchid').val(), 'filtercriteria':$('#filtercriteria').val()}, 
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
			
