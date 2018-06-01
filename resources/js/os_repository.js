$(document).ready(function(){
	if($('#osrepository').length > 0){
		var ipmissedtable =  $('#osrepository').DataTable( {
		 "aoColumns": [{"bSortable": false}, {},{}],	
		 "processing": true,
		 "pageLength": 20,
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [0, 1, 2]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [0, 1, 2]}}], 
		 "order": [[1, 'asc']],
		 } );
	}
	$('#batchModal').on('hidden.bs.modal', function () {
		 location.reload();
	});
});
$(document).on(
		'click',
		'#osrepo-submit',
		function(event) {
			if (confirm("Are you sure, do you want to submit files ?")) {
				var fileNames = []; var fileSizes = [];
				$('#osrepository').children().find(
						'input[type=checkbox]:checked').each(
						function(index) {
							fileNames.push($(this).closest('tr').find("td:eq(1)")
									.text());
							fileSizes.push($(this).closest('tr').find("td:eq(2)")
									.text());
						});
				if (fileNames.length == 0) {
					alert('Error! Filename selection is required');
					return false;
				}

				$.ajax({
					type : "post",
					url : "software-delivery-batch-process.php",
					data : {
						'ctype' : 'OsRepoUPdate',
						'filenames' : fileNames,
						'filesizes' : fileSizes,
						'osid': 1,
					},
					success : function(resdata) {
						var myModal = $('#batchModal');
						myModal.modal('show');
					}
				});
				
			}
			return false;
}); 
