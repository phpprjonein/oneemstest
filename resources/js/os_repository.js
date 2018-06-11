$(document).ready(function(){
	if($('#osrepository').length > 0){
		var osrepository =  $('#osrepository').DataTable( {
		 "aoColumns": [{"bSortable": false}, {},{}],
		 "processing": true,
		 "destroy": true,
		 "dom": 'Bfrtip',
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [1]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [1]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [1]}}], 
		 "order": [[1, 'asc']],
		 } );
		
		$('.dt-buttons').append('<div class="form-group col-md-8"><button type="button" class="btn" data-toggle="modal" data-target="#retModal">RETRIEVE</button></div>');
		
	}
	
	if($('#retrosrepository').length > 0){
		var retrosrepository =  $('#retrosrepository').DataTable( {
		 "aoColumns": [{"bSortable": false}, {},{},{"bSortable": false}],
		 "processing": true,
		 "destroy": true,
		 "dom": 'Bfrtip',
		 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [1]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [1]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [1]}}], 
		 "order": [[0, 'asc']],
		 } );
	}
	
	
	
	$('#batchModal,#retModal').on('hidden.bs.modal', function () {
		 location.reload();
	});
	
	$('#applydate').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "software-delivery-batch-process.php",
                data: 'type=autocomplete&category=osdate&query=' + query,            
                dataType: "json",
                type: "POST",
                success: function (data) {
					result($.map(data, function (index, value) {
						return index;
                    }));
                }
            });
        }
    });
});

$(document).on('click', ".retModaldelete", function(event) {
	if(confirm("Are you sure want to delete file " + $(this).closest('tr').find("td:eq(0)").text() + " ?")){
		$('#retModal #modelstatus').html('');
		$('#retModal #modelstatus').css("opacity","");
		var tr = $(this).closest('tr');
		var fileid = tr.attr('id').replace('row_','');
		var myModal = $('#retModal');
		$.post( "software-delivery-batch-process.php", {'fileid': fileid, 'case':'delete-os-repo-by-fileid'})
		  .done(function( data ) {
			  $.post( "software-delivery-batch-process.php", {'fileid': fileid, 'case':'reload-os-repo'}).done(function( data ) {
				  var myModal = $('#retModal');
				  myModal.find('.modal-body').html(data);
				  var retrosrepository =  $('#retrosrepository').DataTable( {
						 "aoColumns": [{"bSortable": false}, {},{},{"bSortable": false}],
						 "processing": true,
						 "destroy": true,
						 "dom": 'Bfrtip',
						 "buttons": [{extend: 'excelHtml5',className:'dtexcelbtn',exportOptions: {columns: [1]}},{extend: 'pdfHtml5',className:'dtpdfbtn',exportOptions: {columns: [1]}},{extend: 'print',className:'dtprintbtn',exportOptions: {columns: [1]}}], 
						 "order": [[0, 'asc']],
						 } );
				  myModal.modal('show');
				  $('#retModal #modelstatus').append("<strong>Success!</strong> File name deleted successfully.");
				  $('#retModal #modelstatus').show();
	    			$('#retModal #modelstatus').addClass('alert-success');
	    		    window.setTimeout(function() {
	    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
	    		            $(this).hide(); 
	    		        });
	    		    }, 4000);
			  });
		});
		return false;
	}
}); 


$(document).on(
		'click',
		'#deviceseriessubmit',
		function(event) {
			var req_err = false;
			$('#sw-delivery-devices-master #status').html('');
			$('#sw-delivery-devices-master #status').css("opacity","");
			if($('#sw-delivery-devices-master #lsform  #dsosversion').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Os Version field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices-master #lsform #dsdeviceseries').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Device Series field is required.<br/>");
				req_err = true;
			}
			
			if(req_err){ 
    			$('#sw-delivery-devices-master #status').show();
    			$('#sw-delivery-devices-master #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".errmsg").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
    		
    		
			if (confirm("Are you sure, do you want to create the device series ?")) {
				$.ajax({
					type : "post",
					url : "software-delivery-batch-process.php",
					data : {
						'ctype' : 'MasterDeviceSeries',
						'deviceseries':$('#sw-delivery-devices-master #lsform #dsdeviceseries').val(),
						'osid': $('#sw-delivery-devices-master #lsform  #dsosversion').val(),
					},
					success : function(resdata) {
						$('#sw-delivery-devices-master #status').append("<strong>Success!</strong> Device Series added successfully.<br/>");
						$('#sw-delivery-devices-master #status').show();
						$('#sw-delivery-devices-master #status').removeClass('alert-error');
		    			$('#sw-delivery-devices-master #status').addClass('alert-success');
		    			$('#sw-delivery-devices-master form')[0].reset();
		    			window.setTimeout(function() {
		    		        $(".errmsg").fadeTo(500, 0).slideUp(500, function(){
		    		            $(this).hide(); 
		    		        });
		    		    }, 4000);
					}
				});
				
			}
			
			return false;
}); 


$(document).on(
		'click',
		'#osversubmit',
		function(event) {
			
			//alert($("#rsform input[type='radio']:checked").val());
			var req_err = false;
			$('#sw-delivery-devices-master #status').html('');
			$('#sw-delivery-devices-master #status').css("opacity","");
			if($('#sw-delivery-devices-master #rsform #osversion').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Os Version field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices-master #rsform #vendorname').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Vendor Name field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices-master #rsform #ospatch').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Patch field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices-master #rsform #minverreq').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Minimum OS Version field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices-master #rsform .applydate').val() == ""){
				$('#sw-delivery-devices-master #status').append("<strong>Error!</strong> Apply date field is required.<br/>");
				req_err = true;
			}
			
    		if(req_err){ 
    			$('#sw-delivery-devices-master #status').show();
    			$('#sw-delivery-devices-master #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".errmsg").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
    		
			if (confirm("Are you sure, do you want to create the os version entry ?")) {
				$.ajax({
					type : "post",
					url : "software-delivery-batch-process.php",
					data : {
						'ctype' : 'MasterOSVersion',
						'osversion':$('#osversion').val(),
						'deviceseries':$('#deviceseries').val(),
						'vendorname': $('#vendorname').val(),
						'ospatch': $('#ospatch').val(),
						'minverreq': $('#minverreq').val(),
						'applydate': $('.applydate').val(),
						'retired': $("#rsform input[type='radio']:checked").val(),
					},
					success : function(resdata) {
						$('#sw-delivery-devices-master #status').append("<strong>Success!</strong> Os Version Entry added successfully.<br/>");
						$('#sw-delivery-devices-master #status').show();
						$('#sw-delivery-devices-master #status').removeClass('alert-error');
		    			$('#sw-delivery-devices-master #status').addClass('alert-success');
		    			$('#sw-delivery-devices-master form')[0].reset();
		    			window.setTimeout(function() {
		    		        $(".errmsg").fadeTo(500, 0).slideUp(500, function(){
		    		            $(this).hide(); 
		    		        });
		    		    }, 4000);
					}
				});
				
			}
			
			return false;
}); 


$(document).on(
		'click',
		'#osrepo-submit',
		function(event) {
			var req_err = false;
			$('#sw-delivery-devices #status').html('');
			$('#sw-delivery-devices #status').css("opacity","");
			
			if($('#sw-delivery-devices #vendorname').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Vendor name field is required.<br/>");
				req_err = true;
			}
			/*
			if($('#sw-delivery-devices #minverreq').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Minimum Os Version field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices #ospatch').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Patch field is required.<br/>");
				req_err = true;
			}
			*/
			if($('#sw-delivery-devices #deviceseries').val() == null || $('#sw-delivery-devices #deviceseries').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Device series field is required.<br/>");
				req_err = true;
			}
			/*
			if($('#sw-delivery-devices #newosversion').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> New OS version field is required.<br/>");
				req_err = true;
			}
			if($('#sw-delivery-devices #applydate').val() == ""){
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Apply date field is required.<br/>");
				req_err = true;
			}			
			*/
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
				$('#sw-delivery-devices #status').append("<strong>Error!</strong> Filename selection is required.<br/>");
				req_err = true;
			}
    		if(req_err){ 
    			$('#sw-delivery-devices #status').show();
    			$('#sw-delivery-devices #status').addClass('alert-danger');
    		    window.setTimeout(function() {
    		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
    		            $(this).hide(); 
    		        });
    		    }, 4000);
    			return false;
    		}
			if (confirm("Are you sure, do you want to process files ?")) {
				$.ajax({
					type : "post",
					url : "software-delivery-batch-process.php",
					data : {
						'ctype' : 'OsRepoUPdate',
						'filenames' : fileNames,
						'filesizes' : fileSizes,
						'vendorname' : $('#vendorname').val(),
						'ospatch': '',
						'applydate': '',
						'deviceseries':$('#deviceseries').val(),
						'minverreq':'',
						'osid': 1,
						'newosversion': ''
					},
					success : function(resdata) {
						var myModal = $('#batchModal');
						myModal.modal('show');
					}
				});
				
			}
			return false;
}); 
