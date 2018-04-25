$(document).ready(function() {
		if($('#devicebatchtrack').length > 0){
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#devicebatchtrack').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"batch-tracking-devices-server.php",      
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
			{ "data": "id" },
            { "data": "batchid" },
            { "data": "scriptname" },
            { "data": "deviceseries" },
			{ "data": "deviceos" },
            { "data": "batchcreated" },
			{ "data": "batchcompleted" },
            { "data": "batchstatus" },
        ],
        "order": [[4, 'asc']],
        "createdRow": function (row, data, rowIndex) {
            $(row).addClass('device_row');
			  $.each($('td', row), function (colIndex) {
           	 if(colIndex == 0)
           	   $(this).attr('title', 'Click for more details'); 
            });
       }
      } );
	}
		
	      $('#devicebatchtrack tbody').on('click', 'td.details-control', function () {
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
