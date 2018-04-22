$(document).ready(function() {
		if($('#batchpro').length > 0){
		$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#batchpro').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"batch-process.php",      
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
            {  "className":      'batch-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},
			{ "data": "deviceIpAddr" },
            { "data": "systemname" },
			{ "data": "deviceseries" },
            { "data": "market" },
            { "data": "nodeVersion" },
        ],
        "order": [[4, 'asc']],
      } );
	}
		

    	
    	
    	$('#batchModal').on('hidden.bs.modal', function () {
    		 location.reload();
    	})
    	
    	$(document).on('click', '#batch-submit', function(event) {
        	var allVals = [];
        	$('#batchpro').children().find('input[type=checkbox]:checked').each(function(index){
        		 allVals.push(($(this).closest('tr').attr('id')).replace('row_',''));
        	});
        	
            $.ajax({
                type:"post",
                url:"ip-mgt-process.php",
                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'batchid':$('#batchid').val(), 'scriptname':$('#scriptname').val(), 'deviceseries':$('#deviceseries').val(), 'deviceos':$('#deviceos').val(), 'priority':$('#sel-priority').val()}, 
                success: function(resdata){
                	var myModal = $('#batchModal');
            		myModal.modal('show'); 
                }
            });
    	}); 

		  
	  $("#backup-restore-list-dt-filter a").click(function(){			
    		$("#backup-restore-list-dt-filter .btn").html($(this).text());
    		var listname = $(this).text();
			if($(this).text() == 'My routers'){
				listname = 0;
			}
    		
            var table =  $('#batchpro').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":"batch-process.php?listname="+listname,      
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
                    {  "className":      'batch-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},
        			{ "data": "deviceIpAddr" },
                    { "data": "systemname" },
        			{ "data": "deviceseries" },
                    { "data": "market" },
                    { "data": "nodeVersion" },
              ],
              "order": [[4, 'asc']],
              "createdRow": function (row, data, rowIndex) {
                   $(row).addClass('device_row');
      			  $.each($('td', row), function (colIndex) {
      				  
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
