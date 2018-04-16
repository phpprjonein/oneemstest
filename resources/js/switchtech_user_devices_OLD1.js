$(document).ready(function() {
    $('body').on('click', '.run_all_checks', function(){
    	$thisdiv = $(this);
        $thidiv = $('.mydevicebox_' + $(this).data('deviceid')); 
          $.ajax({
              type:"get",
              url:"healthchk-switchtech.php",
              data: {deviceid:$(this).data('deviceid'), userid:$(this).data('userid')},
              beforeSend: function(){
            	  $('#detail_' + $thisdiv.data('deviceid') + ' div').html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes...<div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
              },
              complete: function() {
                  $thisdiv.addClass('loaded');
              },
              success: function(resdata){
            	  $('#detail_' + $thisdiv.data('deviceid') + ' div').html(resdata);     
              }
          });
      }); 
    
         var table =  $('#example').DataTable( {
          "processing": true,
          "serverSide": true, 
          "ajax":"swt-server-process.php?listid="+$('#example').data('listid'),
          "pageLength": 25,
          //"dom": 'lBfrtip',
          "dom": 'Bfrtip',
          //"buttons": [{extend: 'collection',text: 'Export', buttons: ['excel','pdf','print']}],
         /* "buttons": [ 'excel','pdf','print'],
            "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
*/
          "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}],  
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
            { "data": "id" , "visible": false},
			{ "data": "csr_site_id" },
            { "data": "csr_site_name" },
            { "data": "devicename" },
            { "data": "market" },
            { "data": "deviceseries" },
            { "data": "nodeVersion" },
            { "data": "status", "className": "d-none" },
            { "data": "lastpolled" },
        ],
        "order": [[1, 'asc']],
            // Per-row function to iterate cells
        "createdRow": function (row, data, rowIndex) {
             $(row).addClass('device_row');
             var status = ''; 
			  $.each($('td', row), function (colIndex) {
            	/* if(colIndex == 0)
            	   $(this).attr('title', 'Click here for health check');
			   */  // Temporarily not needed. Needed in future.
				  
				  if(colIndex == 7){
					  status = $(this).text();
					  $(this).attr('class', 'd-none');
				  }
				  if(colIndex == 8 && status == 0){
							  $(this).attr('class', 'device-red');
						  }  
				  
				  
             });
        }

      } );

      $('#example tbody').on('click', 'td.details-control', function () {

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
                      type:"get",
                      url:"healthchk-load-table-data.php",
                      data: {deviceid:id, userid:$('#userid').val()},
                      beforeSend: function(){
                          $('#detail_'+id).html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
                      },
                      complete: function() {
                          $('#detail_'+id).addClass('loaded');
                      },
                      success: function(resdata){
                          $('#detail_'+id).html(resdata);
                      }
                  });
                  /*ajs = $.ajax({
                      type:"get",
                      url:"healthchk-switchtech.php",
                      data: {deviceid:id, userid:$('#userid').val()},
                      beforeSend: function(){
                          $('#detail_'+id).html('<div class="text-center overlay box-body">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
                      },
                      complete: function() {
                          $('#detail_'+id).addClass('loaded');
                      },
                      success: function(resdata){
                          $('#detail_'+id).html(resdata);
                      }
                  });*/ 
            }
          } 
      });
	  
	  		if($('#backuprestore').length > 0){
		//$('#ip-mgt-utils div').hide(); 
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#backuprestore').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"switchtech-server-backuprestoreprocess.php",      
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
            {  "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''},
			{ "data": "devicename" },
            { "data": "csr_site_id" },
            { "data": "csr_site_name" },            
			{ "data": "region" },
            { "data": "market" },
            { "data": "deviceseries" },
            { "data": "nodeVersion" },
	        {
            "className":      'center',
            "data":           null,
            "orderable":      false,
            "defaultContent": "<button type='button' id = 'backupbtn' class='btn btn-primary' data-toggle='modal' data-target='#backupModal' data-remote='remote-page.html'>Backup </button>"
			// "defaultContent":   "<input id='btnDetails' class='btn btn-success' width='25px' value='Get Details' />"
			} 
        ],
        "order": [[1, 'asc']],
        "createdRow": function (row, data, rowIndex) {
             $(row).addClass('device_row');
			  $.each($('td', row), function (colIndex) {
            	 if(colIndex == 0)
            	   $(this).attr('title', 'Click here for health check');
             }); 
        }
      } );
	}
	  		
	    	$('#myModal').on('hidden.bs.modal', function () {
	    		 location.reload();
	    	})
	  		
	  		
	  		$("#backup-restore-list-dt-filter a").click(function(){			
	    		$("#backup-restore-list-dt-filter .btn").html($(this).text());
	    		var listname = '';
	    		if($(this).text() != 'My routers'){
	    			listname = $(this).text();
	    		}
	    		
	            var table =  $('#backuprestore').DataTable( {
	                "processing": true,
	                "serverSide": true,
	                "ajax":"switchtech-server-backuprestoreprocess.php?listname="+listname,      
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
	                  {  "className":      'details-control',
	                      "orderable":      false,
	                      "data":           null,
	                      "defaultContent": ''},
	      			{ "data": "devicename" },
	                  { "data": "csr_site_id" },
	                  { "data": "csr_site_name" },            
	      			{ "data": "region" },
	                  { "data": "market" },
	                  { "data": "deviceseries" },
	                  { "data": "nodeVersion" },
	      	        {
	                  "className":      'center',
	                  "data":           null,
	                  "orderable":      false,
	                  "defaultContent": "<button type='button' id = 'backupbtn' class='btn btn-primary' data-toggle='modal' data-target='#backupModal' data-remote='remote-page.html'>Backup </button>"
	      			} 
	              ],
	              "order": [[1, 'asc']],
	              "createdRow": function (row, data, rowIndex) {
	                   $(row).addClass('device_row');
	      			  $.each($('td', row), function (colIndex) {
	                  	 if(colIndex == 0)
	                  	   $(this).attr('title', 'Click here for health check');
	                   }); 
	              }
	            } );
	      });  		
	  		
			  $(document).on('click', '#back_res #viewbtn', function(event) {
				  $('#myModal #copybtn').hide();
			  //alert('Restore button is clicked');
			  	$('#myModal .modal-title').html('File Contents ' + $(this).closest('tr').find("td:eq(0)").text());
		    	$.post( "restore-api-test.php?act=view", { 'type': "api-ajax", 'filename':$(this).closest('tr').find("td:eq(0)").text(), 'region':$('tr.shown').find("td:eq(4)").text() 
				}).done(function( data ) {
					$('#myModal .modal-body').html(data);
					$('#myModal #copybtn').show();
					$('#cp1').html(data);
				}); 
		  });
	  		
			  $(document).on('click', '#back_res #restorebtn', function(event) {
				  //alert('Restore button is clicked');
				  $('#myModal #copybtn').hide();
				  	$('#myModal #bkup-fileid').html($(this).closest('tr').find("td:eq(0)").text() + '<br/><h6><b><span id ="restoremoddet"> Taken at: ' + $(this).closest('tr').find("td:eq(1)").text() + ', Type: ' + $(this).closest('tr').find("td:eq(2)").text() + '</span><b></h6>');
			    	$.post( "restore-api-test.php", { type: "api-ajax"
					}).done(function( data ) {
						$('#myModal .modal-body').html(data);
					}); 
				  	
				  	//alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
			  });
			  
			  $(document).on('click', '#copybtn', function(event) {
					copyToClipboard("#cp1");
					alert("Content Copied into Clipboard");
		  });
			  
			  $(document).on('click', '#backupbtn', function(event) {
				  $('#backupModal .modal-body').html('');
			    	$('#backupModal #bkup-deviceid').html('<br/><h6> <b><span id ="backupmoddet"> Device Name:' + $(this).closest('tr').find("td:eq(1)").text() + '</span><b></h6>');
				  	//$('#backupModal #bkup-deviceid').html('Device Id:'); 
		 	    	$.post( "backup-api-process.php", { type: "api-ajax", deviceid: $(this).closest('tr').attr('id').replace('row_','')
					}).done(function( data ) {
						$('#backupModal .modal-body').html(data);
					}); 
				  	
				  	//alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
			  });	 
	  		
	  	  
	  		$(document).on('click', '#backuprestore tbody td.details-control', function(event) {
	  	        
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
	  	                    type:"get",
	  	                    url:"backuprestore-cellsitetech.php",					
	  	                  data: {'deviceid':id, 'userid':$('#userid').val(), 'devicename': $(this).closest('tr').find("td:eq(1)").text(), 'region': $(this).closest('tr').find("td:eq(4)").text(), 'market' : $(this).closest('tr').find("td:eq(5)").text()},
	  	                    beforeSend: function(){
	  	                        $('#detail_'+id).html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
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
});
function copyToClipboard(element) {
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
}

$(document).keydown(function(event) { 
    if (event.keyCode == 27) {  
        $('#mycmdModal').find('button.close').trigger('click');
        
    }
});

function format ( d ) {
     var id = d.replace('row_','');
     return "<div id='detail_"+id+"'></div>";
} 
