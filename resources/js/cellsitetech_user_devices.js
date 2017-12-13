$(document).ready(function() {
	if($('#example').length > 0){
         var table =  $('#example').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"cellt_server_process.php",      
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
            { "data": "deviceName" },
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
        var table1 =  $('#ipmgt-ipv4').DataTable( {
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
	}
     
	if($('#ipmgt-ipv6').length > 0){
        var table2 =  $('#ipmgt-ipv6').DataTable( {
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