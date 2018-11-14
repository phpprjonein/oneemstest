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
              {"data": "region"},
              {"data": "market"},
              {"data": "devicename"},
              {"data": "deviceIpAddr"},
              {"data": "deviceseries"},
              {"data": "filtercriteria", "className": "nowrap"},
              {"data": "austatus"},
              {"data": "austatus"},
              {"data": "createddate"},
          ],
			"order": [[2, 'asc']],
			 "createdRow": function (row, data, rowIndex) {
	             $(row).addClass('device_row');
				  $.each($('td', row), function (colIndex) {
					 var region = $(this).closest('tr').find('td:eq(2)').html().toLowerCase();
         			 var market = $(this).closest('tr').find('td:eq(3)').html();
         			 var devicename = $(this).closest('tr').find("td:eq(4)").text();
         			 
	            	 if(colIndex == 9){
	            		 $(this).html('<a href="download.php?file=/usr/apps/oneems/config/bkup/' + region + '/audit/' + market + '/' + devicename + '.pdf">' + devicename +'.pdf</a>');
	            	 }
	             }); 
	        }
      });
});		
			
