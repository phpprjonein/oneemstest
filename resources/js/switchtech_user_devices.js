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
    
    $('body').on('click', '#health-chk-div-wrap .run_custom_checks', function(){
    	var allVals = [];
    	$(this).parents('table:first').children().find('input[type=checkbox]:checked').each(function(index){
    		 allVals.push($(this).val());
    	});		
    	$thisdiv = $(this);
        $.ajax({
            type:"get",
            url:"healthchk-cellsitetech-custom.php",
            data: {deviceid:$(this).data('deviceid'), userid:$(this).data('userid'), 'category':allVals}, 
            beforeSend: function(){
          	  $('#detail_' + $thisdiv.data('deviceid') + ' div').html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
            },
            complete: function() {
                $thisdiv.addClass('loaded');
            },
            success: function(resdata){
          	  $('#detail_' + $thisdiv.data('deviceid') + ' div').html(resdata);     
            }
        });
    });
    
    $('body').on('click', '#health-chk-div-wrap .run_preventive_checks', function(){
    	$thisdiv = $(this);
        $.ajax({
            type:"get",
            url:"healthchk-cellsitetech-preventive.php",
            data: {deviceid:$(this).data('deviceid'), userid:$(this).data('userid')}, 
            beforeSend: function(){
          	  $('#detail_' + $thisdiv.data('deviceid') + ' div').html('<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
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
          "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn',exportOptions: {columns: [2, 3, 4, 5, 6, 7, 8, 10]}},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn',exportOptions: {columns: [2, 3, 4, 5, 6, 7, 8, 10]}},{extend: 'print',titleAttr:'',className:'dtprintbtn',exportOptions: {columns: [2, 3, 4, 5, 6, 7, 8, 10]}}],  
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
            { "data": "deviceIpAddr" },
            { "data": "market" },
            { "data": "deviceseries" },
            { "data": "nodeVersion" },
            { "data": "status", "className": "d-none" },
            { "data": "lastpolled" },
            { "className":      'center',
            	"orderable":      false,
            	"data":           null,
            	"defaultContent": "<button type='button' class='btn btn-sm auditLog' data-toggle='modal'>Audit Log</button>",
            } 

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
				  
				  if(colIndex == 8){
					  status = $(this).text();
					  $(this).attr('class', 'd-none');
				  }
				  if(colIndex == 9 && status == 0){
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
	  
	  		if($('#backuprestoredt').length > 0){
		//$('#ip-mgt-utils div').hide(); 
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#backuprestoredt').DataTable( {
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
	    		
	            var table =  $('#backuprestoredt').DataTable( {
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
	  		
			  
			  $(document).on('click', '#copybtn', function(event) {
					copyToClipboard("#cp1");
					alert("Content Copied into Clipboard");
		  });
			  
			  $(document).on('click', '#backupbtn', function(event) {
				  $('#backupModal .modal-body').html('');
			    	$('#backupModal #bkup-deviceid').html('<br/><h6> <b><span id ="backupmoddet"> Device Name:' + $(this).closest('tr').find("td:eq(1)").text() + '</span><b></h6>');
				  	//$('#backupModal #bkup-deviceid').html('Device Id:'); 
			    	var myModal = $('#backupModal');
		            myModal.find('.modal-body').html('<div id="ajax_loader" style="position: absolute; left: 40%; top: 10%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
		 	    	$.post( "backup-api-process.php", { type: "api-ajax", deviceid: $(this).closest('tr').attr('id').replace('row_','')
					}).done(function( data ) {
						$('#backupModal .modal-body').html(data);
					}); 
				  	
				  	//alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
			  });	 
			  	 
			  $(document).on('click', '#restorebtn', function(event) {
				    $('#restoreModal .modal-body').html('');
				    //$('#restoreModal #bkup-deviceid').html('Restoring the below file : <br>' + $(this).closest('tr').find("td:eq(0)").text() + '<br/><h6><b><span id ="restoremoddet"> Taken at: ' + $(this).closest('tr').find("td:eq(1)").text() + ', Type: ' + $(this).closest('tr').find("td:eq(2)").text() + '</span><b></h6>');
					$('#restoreModal #bkup-deviceid').html('Restoring the below file : <br>' + $(this).closest('tr').find("td:eq(0)").text() + '<br/><h6><b><span id ="restoremoddet"> Taken at: ' + $(this).closest('tr').find("td:eq(1)").text());
				  	//$('#backupModal #bkup-deviceid').html('Device Id:'); 
			    	var myModal = $('#restoreModal');
		          myModal.find('.modal-body').html('<div id="ajax_loader" style="position: absolute; left: 40%; top: 10%; display: start;"><img src="resources/img/ajax-loader.gif"></img></div>');
		          var rowid = $('.shown').attr('id');
		          $.post( "restore-api-test.php?act=restore", { 'type': "api-ajax", 'region': $('#'+rowid).find("td:eq(4)").text(), 'device_series': $('#'+rowid).find("td:eq(6)").text(), 'device_id': rowid.replace('row_',''), 'filename':$(this).closest('tr').find("td:eq(0)").text(),
					}).done(function( data ) {
						$('#restoreModal .modal-body').html(data);
					});
		          /*	
		          alert("Region " + $('#'+rowid).find("td:eq(4)").text() + "Region " + $('#'+rowid).find("td:eq(6)").text() + "device ID " +  rowid.replace('row_',''));
		          alert($(this).closest('tr').find("td:eq(0)").text());
		          return false;
				  */	
			  });		  
			  	 
			  	 
			  $(document).on('click', '.auditLog', function(event) {
				  var myModal = $('#healthpageModel');
				  $('#healthpage .modal-body').html('');
				  var sel = $(this).closest('tr').attr('id');
				$.post( "api-test.php", { type: "api-ajax"
					}).done(function( data ) {
						$('#' + sel + " button").removeClass('btn');
						$('#' + sel + " button").removeClass('btn-danger');
						$('#' + sel + " button").removeClass('btn-success');
						var obj = jQuery.parseJSON( data );
						if(obj.result == true){
							myModal.find('.modal-body').html('<h3>Successful</h3>');
							$('#' + sel + " button").addClass('btn-success');
						}else{
							myModal.find('.modal-body').html('<h3>Failed</h3>');
							$('#' + sel + " button").addClass('btn-danger');
						}
						$('#healthpage #healthpageModel').modal('show');
				});
				
				return false;
				  
		 	    	/*$.post( "backup-api-process.php", { type: "api-ajax", deviceid: $(this).closest('tr').attr('id').replace('row_','')
					}).done(function( data ) {
						$('#backupModal .modal-body').html(data);
					}); 
				  	*/
				  	//alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
			  });
			  
	  	  
	  		$(document).on('click', '#backuprestoredt tbody td.details-control', function(event) {
				//alert(' reach here');
	 	       //  Temporarily commented on 31 jan 2018. Needed in future.
	     		var table =  $('#backuprestoredt').DataTable();
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
