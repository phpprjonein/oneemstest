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
              {"data": "market"},
              {"data": "devicename"},
              {"data": "deviceIpAddr"},
              {"data": "deviceseries"},
              {"data": "filtercriteria"},
              {"data": "austatus"},
              {"data": "austatus"},
              {"data": "createddate"},
          ],
			"order": [[2, 'asc']],
			 "createdRow": function (row, data, rowIndex) {
	             $(row).addClass('device_row');
				  $.each($('td', row), function (colIndex) {
	            	 if(colIndex == 8){
	            		 if($(this).text().toLowerCase() == 'fail'){
	            			 $(this).html('<a href="download.php?file=upload/audit/' + $(this).closest('tr').find("td:eq(3)").text() + '.txt">'+ $(this).closest('tr').find("td:eq(3)").text() +'.txt</a>');
	            		 }else{
	            			 $(this).text('');
	            		 }
	            	 }
	             }); 
	        }
      });
});		
			
