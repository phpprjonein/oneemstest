$(document).ready(function() {
	if($('#example').length > 0){
		//$('#ip-mgt-utils div').hide();
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#example').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"cellt-server-process.php",      
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
            { "data": "csr_site_id" },
            { "data": "csr_site_name" },
            { "data": "devicename" },
            { "data": "market" },
            { "data": "deviceseries" },
            { "data": "nodeVersion" },
            { "data": "lastpolled" }
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
	
	
	if($('#ipmgt-ipv4').length > 0){
		$('#export-v-pills-profile').hide();
		$('#search-v-pills-profile').hide();
        var table1 =  $('#ipmgt-ipv4').DataTable( {
        "aoColumns": [{ "bSortable": true },{ "bSortable": true, "bVisible": false },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": false }],	
         "processing": true,
         "pageLength": 5,
         "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}},{extend: 'print',titleAttr:'',className:'dtprintbtn',exportOptions: {columns: [0, 2, 3, 4, 5]}}], 
           "language": {
           "lengthMenu": "Display _MENU_ records per page",
           "zeroRecords": "No records found",
           "info": "Showing page _PAGE_ of _PAGES_",
           "infoEmpty": "",
           "infoFiltered": ""
           },
       "order": [[0, 'asc']],

     } );
        table1.buttons().container().appendTo('#export-v-pills-home');
        $('#search-v-pills-home input').keyup(function(){
        	table1.search($(this).val()).draw() ;
      })
      table1.columns(1).search($("#ip-allocation-region-dt-filter .btn").html().trim()).draw();
	}
     
	if($('#ipmgt-ipv6').length > 0){
        var table2 =  $('#ipmgt-ipv6').DataTable( {
            "aoColumns": [{ "bSortable": true },{ "bSortable": true, "bVisible": false },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": false }],	
         "processing": true,
         "pageLength": 5,
         "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
           "language": {
           "lengthMenu": "Display _MENU_ records per page",
           "zeroRecords": "No records found",
           "info": "Showing page _PAGE_ of _PAGES_",
           "infoEmpty": "",
           "infoFiltered": ""
           },
       "order": [[0, 'asc']],

     } );
        table2.buttons().container().appendTo('#export-v-pills-profile');
        $('#search-v-pills-profile input').keyup(function(){
        	table2.search($(this).val()).draw() ;
      })
      table2.columns(1).search($("#ip-allocation-region-dt-filter .btn").html().trim()).draw();
        $('#ip-mgt-screen #ajax_loader').hide();
        $('#ip-mgt-screen #ip-mgt-utils').show();
	}
	if($('#ipv4subnetmask').length > 0){
        var table3 =  $('#ipv4subnetmask').DataTable( {
         "processing": true,
         "pageLength": 5,
         "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
           "language": {
           "lengthMenu": "Display _MENU_ records per page",
           "zeroRecords": "No records found",
           "info": "Showing page _PAGE_ of _PAGES_",
           "infoEmpty": "",
           "infoFiltered": ""
           },
       "order": [[1, 'asc']],

     } );
	}
	if($('#ipv6subnetmask').length > 0){
        var table3 =  $('#ipv6subnetmask').DataTable( {
         "processing": true,
         "pageLength": 5,
         "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
           "language": {
           "lengthMenu": "Display _MENU_ records per page",
           "zeroRecords": "No records found",
           "info": "Showing page _PAGE_ of _PAGES_",
           "infoEmpty": "",
           "infoFiltered": ""
           },
       "order": [[1, 'asc']],

     } );
	}    
         
	$(".col-1 .nav-link").click(function(){
		if($(this).html() == 'IPv4'){
			$('#export-v-pills-profile').hide();
			$('#export-v-pills-home').show();
			$('#search-v-pills-profile').hide();
			$('#search-v-pills-home').show();
		}else{
			$('#export-v-pills-home').hide();
			$('#export-v-pills-profile').show();
			$('#search-v-pills-home').hide();
			$('#search-v-pills-profile').show();
			
		}
	}); 

    	
    	$("#ip-allocation-region a").click(function(){
    		$("#ip-allocation-region .btn").html($(this).text());
			  $("#exampleModalIPM #exampleModalIPMLabel").html("ADD A SUBNET IN " + $(this).text());
			  $("#exampleModalIPM #selected_region").val($(this).text());
    		$.post( "ip-mgt-process.php", { calltype: "trigger", region: $(this).text() })
    		  .done(function( data ) {
    			  $("#ip-allocation-market button").text("SELECT MARKET");
    			  $("#ip-allocation-market .dropdown-menu").html(data);
    		  });
    	});
    	
    	$("#ip-allocation-region-dt-filter a").click(function(){
    		$("#ip-allocation-region-dt-filter .btn").html($(this).text());
    		var table1 =  $('#ipmgt-ipv4').DataTable();
    		var table2 =  $('#ipmgt-ipv6').DataTable();
    		if($(this).text() != 'SELECT REGION'){
    			table1.columns(1).search('^'+$(this).text()+'$', true, false).draw();
    			table2.columns(1).search('^'+$(this).text()+'$', true, false).draw();
    		}else{
    			table1.columns(1).search('').draw();
    			table2.columns(1).search('').draw();
    		}
    	});
    	
    	$('#myModal').on('hidden.bs.modal', function () {
    		 location.reload();
    	})
    	
    	
    	$(document).on('click', '#ip-allocation-market a', function(event) {
    		$("#ip-allocation-market .btn").html($(this).text());
    		$("#exampleModalIPM #selected_market").val($(this).text());
    	});
    	
    	$("#ip-mgt-screen #add-a-subnet").click(function(){
    		$('#ip-mgt-screen #main-status').html('');
    		$('#ip-mgt-screen #main-status').css("opacity","");
    		if($.trim($("#ip-allocation-region .btn").html()) == "SELECT REGION"){
    			$('#ip-mgt-screen #main-status').html("<strong>Error!</strong> Select Region field is required.<br/>");
    			$('#ip-mgt-screen #main-status').addClass('alert-danger');
    			$('#ip-mgt-screen #main-status').show();
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
        	var myModal = $('#exampleModalIPM');
        	myModal.modal('show');
    	});	
    		
    	$("#exampleModalIPM .modal-footer button").click(function(){
    		var req_err = false;
    		$('#exampleModalIPM #status').html('');
    		$('#exampleModalIPM #status').css("opacity","");
    		if($.trim($("#exampleModalIPM  #ip-allocation-market .btn").html()) == "SELECT MARKET"){
    			$('#exampleModalIPM #status').html("<strong>Error!</strong> Market field is required.<br/>");
    			$('#exampleModalIPM #status').addClass('alert-danger');
    			req_err = true;
    		}
    		if($('#exampleModalIPM #inputSubnet').val() == ""){
    			$('#exampleModalIPM #status').append("<strong>Error!</strong> Subnet field is required.<br/>");
    			$('#exampleModalIPM #status').addClass('alert-danger');
    			req_err = true;
    		}
    		if($('#exampleModalIPM #inputMask').val() == ""){
    			$('#exampleModalIPM #status').append("<strong>Error!</strong> Mask field is required.<br/>");
    			$('#exampleModalIPM #status').addClass('alert-danger');
    			req_err = true;
    		}
    		if(($(this).text() == 'COMPUTE' || $(this).text() == 'ADD') && $('#exampleModalIPM #inputSubnet').val() != ""){
    			$.post( "ip-mgt-process.php", { calltype: "trigger", action: "IP-Validate", type: $('#v-pills-tab .active').html(), subnet: $("#exampleModalIPM #inputSubnet").val(), mask: $("#exampleModalIPM #inputMask").val()})
	    		  .done(function( data ) {
	    			  if(data != 'success'){
	    	    			$('#exampleModalIPM #status').append("<strong>Error!</strong> Subnet field " + $('#v-pills-tab .active').html() + " address is Invalid.<br/>");
	    	    			$('#exampleModalIPM #status').addClass('alert-danger');
	    	    			req_err = true;
	    			  }
	    		  });
    		}
    		if(req_err){ 
    			$('#exampleModalIPM #status').show();
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
    			if($(this).text() == 'COMPUTE'){
    				$.post( "ip-mgt-process.php", { calltype: "trigger", action: $(this).text(), subnet: $("#exampleModalIPM #inputSubnet").val(), mask: $("#exampleModalIPM #inputMask").val()})
    	    		  .done(function( data ) {
    	    			  	var res = data.split(" ");
    	    			  	$("#exampleModalIPM #compute-from-ip").html(res[0]);
    	    			  	$("#exampleModalIPM #compute-count").html(res[1]);
    	    			  	$("#exampleModalIPM #compute-to-ip").html(res[2]);
    	    		  });
    			}else{
    				$.post( "ip-mgt-process.php", { calltype: "trigger", action: $(this).text(), subnet: $("#exampleModalIPM #inputSubnet").val(), mask: $("#exampleModalIPM #inputMask").val(), region:$("#exampleModalIPM #selected_region").val(),market:$("#exampleModalIPM #selected_market").val()})
  	    		  .done(function( data ) {
  	    			  if(data == 'success'){
  	    				$("#exampleModalIPM .alert-success").show();
	    			  	$("#exampleModalIPM #compute-from-ip").html('{{from IP}}');
	    			  	$("#exampleModalIPM #compute-count").html('{{Count}}');
	    			  	$("#exampleModalIPM #compute-to-ip").html('{{to IP}}');
	    			  	$("#exampleModalIPM #inputSubnet").val('');
	    			  	$("#exampleModalIPM #inputMask").val('');
  	    			  }
  	    		  });
    			}
    			
    		});
    	
    	
    	$('#exampleModalIPM').on('hidden.bs.modal', function () {
    		 location.reload();
    	})
    	
    	
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
                    url:"healthchk-cellsitetech.php",
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
                });
            }
          }

             

      });

});

function format ( d ) {
     var id = d.replace('row_','');
    
     return "<div id='detail_"+id+"'></div>";
     
  }

  function functionss(d) {
    alert(d);
  }
