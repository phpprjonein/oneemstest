  $(document).ready(function () {
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
              url: 'software-delivery-process-new.php',
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
			"order": [[4, 'asc']]
      });
      $("#backup-restore-list-dt-filter a").click(function(){			
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
                  url: 'software-delivery-process-new.php?listname='+listname+'&deviceseries='+deviceseries+'&nodeVersion='+nodeVersion,
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
    			"order": [[4, 'asc']]
          });;
    });
      
      
  });	
  
  
 $(document).ready(function(){
            $('#device_series').change(function(){
                //Selected value
                var deviceseries = $(this).val();
                //alert("value in js "+deviceseries); 
				$.ajax({
						type: "POST",
						url: 'getnodeversion.php',
						data: {dropdownValue: deviceseries},
						success: function(data){
						//alert(data);
						// $('#node_version').remove();
						$('#node_version').children('option:not(:first)').remove();
						$('#node_version').append(data);	
						}
					});	
                
            	
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
	                  url: 'software-delivery-process-new.php?listname='+listname+'&deviceseries='+deviceseries+'&nodeVersion='+nodeVersion,
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
	    			"order": [[4, 'asc']]
	          });;
            });
            })
$(document).ready(function(){
            $('#node_version').change(function(){
                //Selected value
                var deviceseries = $(device_series).val();
				var nodeversion = $(this).val();
                //alert("value in" + deviceseries + nodeversion); 
               $.ajax({
						type: "POST",
						url: 'getswrepofilenames.php',
						data: {deviceseries:deviceseries,nodeversion: nodeversion},
						success: function(data){
						//alert(data);
						$('#swrp_filename').children('option:not(:first)').remove();
						$('#swrp_filename').append(data);	
						}
					});	
               
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
	                  url: 'software-delivery-process-new.php?listname='+listname+'&deviceseries='+deviceseries+'&nodeVersion='+nodeVersion,
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
	    			"order": [[4, 'asc']]
	          });; 
               
               
                });
            
            	
            
            }) 
			$(document).on('click', '#batch-submit', function(event) {
        	var allVals = [];
        	$('#swdelvrybatchpro').children().find('input[type=checkbox]:checked').each(function(index){
        		allVals.push($(this).closest('tr').find("td:eq(1)").text());
        	});

        	if(allVals.length == 0){
            	alert('Error! Device selection is required');
            	return false;	
        	}
        	
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
                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'scriptname':$('#swrp_filename').val(), 'deviceseries':deviceseries, 'node_version':nodeVersion, 'priority':$('#sw_selpriority').val()}, 
                success: function(resdata){
                	var myModal = $('#batchModal');
            		myModal.modal('show'); 
                }
            });
        	return false;
    	}); 

	
$(document).ready(function() {

	$('#batchModal').on('hidden.bs.modal', function () {
		 //location.reload();
		window.location.href = 'batch-tracking-devices.php';
	})
});		
			
