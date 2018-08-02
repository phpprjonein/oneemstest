$(document).ready(function() {
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
              {  "className":      'details-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": ''},
            { "data": "batchid" },
            { "data": "scriptname" },
            { "data": "deviceseries" },
			{ "data": "nodeVersion" },
            { "data": "batchcreated" },
            { "data": "batchstatus" },
            { "data": "batchstatus", "orderable": false }
            //{ "data": null, "orderable": false,"defaultContent": '<a href="#" id="deletebatch" class="btn"> Cancel </a>' },
        ],
        "order": [[4, 'asc']],
        "createdRow": function (row, data, rowIndex) {
            $(row).addClass('device_row');
			  $.each($('td', row), function (colIndex) {
           	 if(colIndex == 6 && $(this).html() == 's'){ 
           	   $(this).html('Scheduled');
         	 }else if(colIndex == 6 && $(this).html() == 'd'){ 
           	   $(this).html('Cancelled');
         	 }else if(colIndex == 4 && $(this).html() == ''){
        		   $(this).html('N/A');	
          	 }else if(colIndex == 7){ 
         		 if($(this).html() == 'd')
         			 $(this).html('<a href="#" id="deletebatch" class="btn disabled"> Cancel </a>');
         		 else
         			$(this).html('<a href="#" id="deletebatch" class="btn"> Cancel </a>');
         	 }
            });
       }
      } );
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
		                   {  "className":      'details-control',
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
		                 //{ "data": null, "orderable": false,"defaultContent": '<a href="#" id="deletebatch" class="btn">Cancel</a>' },
		             ],
		             "order": [[4, 'asc']],
		             "createdRow": function (row, data, rowIndex) {
		                 $(row).addClass('device_row');
		     			  $.each($('td', row), function (colIndex) {
		                 if(colIndex == 6 && $(this).html() == 's'){ 
		                	   $(this).html('Scheduled');
		              	 }else if(colIndex == 6 && $(this).html() == 'd'){ 
		                	   $(this).html('Cancelled');
		              	 }else if(colIndex == 2 && $(this).html() == ''){
		              		   $(this).html('N/A');	
		              	 }else if(colIndex == 4 && $(this).html() == ''){
		              		   $(this).html('N/A');	
		              	 }else if(colIndex == 7){ 
		             		 if($(this).html() == 'd')
		             			$(this).html('<a href="#" id="deletebatch" class="btn disabled"> Cancel </a>');
		             		 else
		             			$(this).html('<a href="#" id="deletebatch" class="btn"> Cancel </a>');
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
