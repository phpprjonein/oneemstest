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
		if($('#devicebatchtrack').length > 0){
		$('#ip-mgt-utils #ajax_loader').show();
		
		var batchtype = '';
		if($('#batchtype-dt-filter .btn').text() == 'Script Execution'){
			batchtype = 'se';
		}else if($('#batchtype-dt-filter .btn').text() == 'Software Delivery'){
			batchtype = 'sd';
		}else if($('#batchtype-dt-filter .btn').text() == 'Change Boot Order'){					
			batchtype = 'bo';
		}else if($('#batchtype-dt-filter .btn').text() == 'Reboot'){					
			batchtype = 'rb';
		}else if($('#batchtype-dt-filter .btn').text() == 'Audit'){					
			batchtype = 'al';
		}else if($('#batchtype-dt-filter .btn').text() == 'Customize Audit'){					
			batchtype = 'cusal';
		}else if($('#batchtype-dt-filter .btn').text() == 'Show Tech'){					
			batchtype = 'st';
		} 
		
         var table =  $('#devicebatchtrack').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"batch-tracking-devices-server.php?batchtype="+batchtype,      
          "pageLength": 25,
          "destroy": true,
          "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}},{extend: 'print',titleAttr:'',className:'dtprintbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}}], 
            "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
          "columns": [
              {  "className":      'details-control-hide',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ''},
            { "data": "batchid" },
            { "data": "scriptname" },
            { "data": "deviceseries" },
			{ "data": "nodeVersion" },
            { "data": "batchcreated" },
            { "data": "batchstatus" },
            { "data": "batchstatus", "orderable": false },
            { "data": "scriptfilemame", "orderable": false  },
            //{ "data": null, "orderable": false,"defaultContent": '<a href="#" id="deletebatch" class="btn"> Cancel </a>' },
        ],
        "order": [[5, 'desc']],
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
				  
				  
           	 if(colIndex == 6 && $(this).html() == 's'){ 
           	   $(this).html('Scheduled');
         	 }else if(colIndex == 6 && $(this).html() == 'd'){ 
           	   $(this).html('Cancelled');
         	 }else if(colIndex == 4 && $(this).html() == ''){
        		   $(this).html('N/A');	
          	 }else if(colIndex == 7){ 
         		 if($(this).html() == 'd' || $(this).html() == 'Completed')
         			 $(this).html('<a href="#" id="deletebatch" class="btn disabled"> Cancel </a>');
         		 else
         			$(this).html('<a href="#" id="deletebatch" class="btn"> Cancel </a>');
         	 }else if(colIndex == 8 && (batchtype == 'se') && $(this).text() != ''){
         		$(this).html('<a href="download.php?file=' + $(this).text() +'" class="downloadbatch  btn"> Download </a>');
         	 }else if(colIndex == 8 && batchtype == 'st' && $(this).closest('tr').find("td:eq(6)").text() != 'Scheduled'){
         		$(this).html('<a href="download.php?tarfile=' + $(this).closest('tr').find("td:eq(1)").text() +'&batchtype=st" class="downloadbatch  btn"> Download </a>');
         	 }
           	 
           	 
            });
       }
      } );
         $("#batch_track_devices .dt-buttons").append('<a class="dt-button buttons-excel buttons-html5 dtexcelbtn dtexcelbtn-cs" tabindex="0" aria-controls="example"><span></span></a>');
	}
		
		$('#devicebatchtrack tbody').on('click', '#deletebatch', function () {
    		if(confirm("Are you sure, do you want to cancel the  batch " + $(this).closest('tr').find("td:eq(1)").text() + " ?")){
    			$.post( "ip-mgt-process.php", {"act": "batch-del", "batchid": $(this).closest('tr').find("td:eq(1)").text()})
      		  .done(function( data ) {
      			 alert("Batch "+ $(this).closest('tr').find("td:eq(1)").text() +" cancelled successfully");
      			 location.reload();
      		  });
    		}
		});
		
	      $('#devicebatchtrack tbody').on('click', 'td.details-control', function () {
				//alert(' reach here');
		       //  Temporarily commented on 31 jan 2018. Needed in future.
	    		var table =  $('#devicebatchtrack').DataTable();
	         var tr = $(this).closest('tr');
	         var row = table.row( tr ); 
	         var current_click_row = row.child.isShown();

	         $('tr.device_row').each(function(){  
	          
	          var orow = table.row(this);
	          // alert(orow.child.isShown());
	          if (orow.child.isShown()){                
	              // This row is already open - close it
	                orow.child.hide();
	                $(this).removeClass('shown');
	          }
	         }); 

	         
	          if ( row.child.isShown() ) {
	              // This row is already open - close it
	              row.child.hide();
	              tr.removeClass();
	          }
	          else {
	                  // Open this row
	                  // alert(tr.attr('id'));
	                  if (!current_click_row ){
	                  row.child( format(tr.attr('id')) ).show();
	                  tr.addClass('shown');

	                  var id = tr.attr('id').replace('row_','');  
	                  
	                  var ajs = $.ajax({
	                    type:"post",
	                    url:"batchtrack-load-table-data.php",					
	                    data: {'batchid':id, 'userid':$('#userid').val()},
	                    beforeSend: function(){
	                        $('#detail_'+id).html('<div class="text-center overlay box-body">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
	                    },
	                    complete: function() {
	                        $('#detail_'+id).addClass('loaded');
	                    },
	                    success: function(resdata){
	                        $('#detail_'+id).html(resdata);
	                    }
	                });
	                  
	                  
	                  
	            }
	          }

	            

	      });
	      		
	          $(document).on('click', '.dtexcelbtn-cs', function(event) {
	      		  var sortInfo = $("#devicebatchtrack").dataTable().fnSettings().aaSorting;
	      		  var batchtype = $("#batchtype-dt-filter .btn").html();
					if(batchtype == 'Script Execution'){
						batchtype = 'se';
					}else if(batchtype == 'Software Delivery'){
						batchtype = 'sd';
					}else if(batchtype == 'Change Boot Order'){					
						batchtype = 'bo';
					}else if(batchtype == 'Reboot'){					
						batchtype = 'rb';
					}else if(batchtype == 'Audit'){					
						batchtype = 'al';
					}else if(batchtype == 'Customize Audit'){					
						batchtype = 'cusal';
					}else if($('#batchtype-dt-filter .btn').text() == 'Show Tech'){					
						batchtype = 'st';
					}  
	      		  location.href = "xls-export-process.php?case=batch-tracking" + "&batchtype=" + batchtype + "&search=" + $('.dataTables_filter input').val() + "&column=" + sortInfo[0][0] + "&dir=" + sortInfo[0][1];
	      		  return false;
	      	  });
	        
	      
	      $("#batchtype-dt-filter a").click(function(){			
	    		/*$("#batchtype-dt-filter .btn").html($(this).text());
	    		var batchtype = '';
				if($(this).text() == 'Script Execution'){
					batchtype = 'se';
				}else{
					batchtype = 'sd';
				} */				 
				
				$("#batchtype-dt-filter .btn").html($(this).text());
	    		var batchtype = '';
				if($(this).text() == 'Script Execution'){
					batchtype = 'se';
				}else if($(this).text() == 'Software Delivery'){
					batchtype = 'sd';
				}else if($(this).text() == 'Change Boot Order'){					
					batchtype = 'bo';
				}else if($(this).text() == 'Reboot'){					
					batchtype = 'rb';
				}else if($('#batchtype-dt-filter .btn').text() == 'Audit'){					
					batchtype = 'al';
				}else if($('#batchtype-dt-filter .btn').text() == 'Customize Audit'){					
					batchtype = 'cusal';
				}else if($('#batchtype-dt-filter .btn').text() == 'Show Tech'){					
					batchtype = 'st';
				}   
		         var table =  $('#devicebatchtrack').DataTable( {
		             "processing": true,
		             "serverSide": true,
		             "destroy": true,
		             "ajax":"batch-tracking-devices-server.php?batchtype="+batchtype,     
		             "pageLength": 25,
		             "dom": 'Bfrtip',
		   	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}},{extend: 'print',titleAttr:'',className:'dtprintbtn',exportOptions: {columns: [1,2, 3, 4, 5, 6]}}], 
		               "language": {
		               "lengthMenu": "Display _MENU_ records per page",
		               "zeroRecords": "No records found",
		               "info": "Showing page _PAGE_ of _PAGES_",
		               "infoEmpty": "",
		               "infoFiltered": ""
		               },
		               "columns": [
		                   {  "className":      'details-control-hide',
		                       "orderable":      false,
		                       "data":           null,
		                       "defaultContent": ''},
		                 { "data": "batchid" },
		                 { "data": "scriptname" },
		                 { "data": "deviceseries" },
		     			{ "data": "nodeVersion" },
		                 { "data": "batchcreated" },
		                 { "data": "batchstatus" },
		                 { "data": "batchstatus", "orderable": 	false },
		                 { "data": "scriptfilemame", "orderable": false  },
		                 //{ "data": null, "orderable": false,"defaultContent": '<a href="#" id="deletebatch" class="btn">Cancel</a>' },
		             ],
		             "order": [[5, 'desc']],
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
		                 if(colIndex == 6 && $(this).html() == 's'){ 
		                	   $(this).html('Scheduled');
		              	 }else if(colIndex == 6 && $(this).html() == 'd'){ 
		                	   $(this).html('Cancelled');
		              	 }else if(colIndex == 2 && $(this).html() == ''){
		              		   $(this).html('N/A');	
		              	 }else if(colIndex == 4 && $(this).html() == ''){
		              		   $(this).html('N/A');	
		              	 }else if(colIndex == 7){ 
		             		 if($(this).html() == 'd' || $(this).html() == 'Completed')
		             			$(this).html('<a href="#" id="deletebatch" class="btn disabled"> Cancel </a>');
		             		 else
		             			$(this).html('<a href="#" id="deletebatch" class="btn"> Cancel </a>');
		             	 }else if(colIndex == 8 && (batchtype == 'se') && $(this).text() != ''){
		              		$(this).html('<a href="download.php?file=' + $(this).text() +'" class="downloadbatch  btn"> Download </a>');
		             	 }else if(colIndex == 8 && batchtype == 'st' && $(this).closest('tr').find("td:eq(6)").text() != 'Scheduled'){
		             		$(this).html('<a href="download.php?tarfile=' + $(this).closest('tr').find("td:eq(1)").text() +'&batchtype=st" class="downloadbatch  btn"> Download </a>');
		             	 }
		                 });
		            }
		         } );
		         $("#batch_track_devices .dt-buttons").append('<a class="dt-button buttons-excel buttons-html5 dtexcelbtn dtexcelbtn-cs" tabindex="0" aria-controls="example"><span></span></a>');
	      });		
	      
	      $(document).on('click', '#batch-rerun-submit', function(event) {
				var req_err = false;
				$('#batch_track_devices #status').html('');
				$('#batch_track_devices #status').css("opacity","");
	        	var allVals = $('#cbvals').val();
	        	$('#batch_track_devices #status').css("opacity","");  
	        	if(allVals.length == 0){
	        		$('#batch_track_devices #status').append("<strong>Error!</strong> Device selection is required");
	            	req_err = true;	
	        	}
				if(req_err){ 
	    			$('#batch_track_devices #status').show();
	    			$('#batch_track_devices #status').addClass('alert-danger');
	    		    window.setTimeout(function() {
	    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	    		            $(this).hide(); 
	    		        });
	    		    }, 4000);
	    			return false;
	    		}
	        	
				if(confirm("Are you sure, do you want to rerun selected batch ?")){
					deviceseries = nodeVersion = ''
		        	
		            $.ajax({
		                type:"post",
		                url:"software-delivery-batch-process.php",
		                data: {'ctype':'BatchTabUPdate', 'category':allVals, 'batchtype':'rerun'}, 
		                success: function(resdata){
		                	alert("Selected batch rescheduled successfully");
		                	location.reload(); 
		                }
		            });
				}
      	return false;
  	}); 
});




function format ( d ) {
     var id = d.replace('row_','');    
     return "<div id='detail_"+id+"'></div>";
  }

  function functionss(d) {
    alert(d);
  }
