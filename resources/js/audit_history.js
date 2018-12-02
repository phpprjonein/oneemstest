$(document).ready(function () {
      $('#auditinglog').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrltip',
			 "destroy": true,
	          "lengthChange": true,
			  "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
              url: 'software-delivery-audit-log-process.php?type=audithistory',
              type: 'GET'
          },
          "columns": [ 		
              {"data": "batchid"},
              {"data": "username"},
              {"data": "devicename"},
              {"data": "deviceIpAddr"},
              {"data": "market"},
              {"data": "deviceseries"},
              {"data": "region", "className": "d-none"},
              {"data": "filtercriteria", "sorting": false},
              {"data": "austatus"},
              {"data": "austatus_exist"},
              {"data": "createddate"},
          ],
			"order": [[4, 'asc']],
			 "createdRow": function (row, data, rowIndex) {
	             $(row).addClass('device_row');
				  $.each($('td', row), function (colIndex) {
					 var batchid = $(this).closest('tr').find("td:eq(1)").text();
					 var region = $(this).closest('tr').find('td:eq(6)').html().toLowerCase();
         			 var market = $(this).closest('tr').find('td:eq(4)').html();
         			 var devicename = $(this).closest('tr').find("td:eq(2)").text();
         			 var batchid = $(this).closest('tr').find("td:eq(0)").text();
        			 var austatus_exist = $(this).closest('tr').find("td:eq(9)").text();
        			 //console.log(austatus_exist + ' ---------- tt');	
        			if(colIndex == 7){
         				$(this).html('<span style="display:none;" class="viewfiltercriteria_'+ batchid +'">' + $(this).html() + '</span><a href="#"  data-toggle="modal" data-batchid="' + batchid + '" data-target="#myModal" data-toggle="modal" class="viewfiltercriteria btn"> View </a>');
         			}
         			if(colIndex == 8){
         				if($(this).html() == 'NULL')
         					$(this).html('Not&nbsp;Applicable');
         			}
	            	 if(colIndex == 9){
	            		 if(austatus_exist == 0){
	            			 $(this).html('Not&nbsp;Applicable');	
	            		 }else{	 
	            			 $(this).html('<a href="download.php?file=' + austatus_exist + '">' + batchid + '_' + devicename +'.txt</a>');
	            		 }	 
	            	 }
	             }); 
	        }
      });
      $(document).on("click", ".audit-history .viewfiltercriteria", function(event){
    	  $('#myModal .modal-title').html('Filter Criteria for BatchId - ' + $(this).data('batchid'));
    	  $('#myModal .modal-body').html($('.viewfiltercriteria_' + $(this).data('batchid')).html());
      });
});		
			
