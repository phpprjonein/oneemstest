<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
 function swrepo_get_deviceseries() {
	  global $db2;
    $sql = "SELECT * FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
 };	
 function swrepo_get_nodeversions() {
	  global $db2;
    $sql = "SELECT * FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;	
};

function swrepo_get_filenames() {
	  global $db2;
    $sql = "SELECT * FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;	
}; 
 ?>
<!DOCTYPE html>
<html>
<head>
 <?php //include_once("includes.php")?>;

<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"> </script>

<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"> </script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"> </script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"> 
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
  /*  height: 300px; */ /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
<script >
    
$(document).ready(function () {
        $('#swdelvrybatchpro').DataTable({
            "processing": true,
            "serverSide": true,
			 "dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
            "ajax": {
                url: 'software-delivery-process.php',
                type: 'POST'
            },
            "columns": [ 			 
                {"data": "id"},
                {"data": "deviceIpAddr"},
                {"data": "systemname"},
                {"data": "deviceseries"},
                {"data": "market"},
                {"data": "nodeVersion"}
            ],
			"order": [[4, 'asc']]
			
        });
    });	
	/*
	$(document).on('click', '#batch-submit', function(event) {
        	var allVals = [];
        	$('#swdelvrybatchpro').children().find('input[type=checkbox]:checked').each(function(index){
        		 allVals.push(($(this).closest('tr').attr('id')).replace('row_',''));
        	});
        	
            $.ajax({
                type:"post",
                url:"ip-mgt-process.php",  
                data: {'ctype':'SwDlvryBatchTabUpdate', 'userid':$(this).data('userid'), 'category':allVals, 'batchid':$('#batchid').val(), 'scriptname':$('#sw_filename').val(), 'deviceseries':$('#device_series').val(), 'nodeversion':$('#node_version').val(), 'priority':$('#sw_selpriority').val()}, 
                success: function(resdata){
                	var myModal = $('#batchModal');
            		myModal.modal('show'); 
                }
            });
    	});
		
	$('#batchModal').on('hidden.bs.modal', function () {
    		 location.reload();
    	}) 
		
function get_nodeversion(val){
    $.ajax({
      type: "POST",
      url: 'getnodeversion.php',
      data: ({deviceseries:val}),
      success: function(data) {
        alert(data);
      }
    });
  };
		

function get_swrepofiles(val){
    $.ajax({
      type: "POST",
      url: 'getswrepofiles.php',
      //data: ({deviceseries:val}),
      success: function(data) {
        alert(data);
      }
    });
  };
*/		
 $(document).ready(function(){
            $('#device_series').change(function(){
                //Selected value
                var deviceseries = $(this).val();
                alert("value in js "+deviceseries);

                //Ajax for calling php function
              //  $.post('getnodeversion.php', { dropdownValue: deviceseries }, function(data){
                   //alert('ajax completed. Response:  '+data);
                    //do after submission operation in DOM
                });
            })
$(document).ready(function(){
            $('#node_version').change(function(){
                //Selected value
                var inputValue = $(this).val();
                alert("value in js "+inputValue);

                //Ajax for calling php function
                //$.post('submit.php', { dropdownValue: inputValue }, function(data){
                  //  alert('ajax completed. Response:  '+data);
                    //do after submission operation in DOM
                })
            })			
			
</script>
</head>
<body>
<!-- The Modal -->
		<div class="modal fade" id="batchModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="batchModalContent">

			  <!-- Modal Header -->
		<div class="modal-header" id ="backupmodalhdr">
        <h5 class="modal-title">Batch Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			  <!-- Modal body -->
			  <div class="modal-body">
			  Please check the status on Batch Tracking Page
			  </div>
			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
<h2>Software Delivery</h2>

<div class="row">
<div class="column" style="background-color:#aaa;">
<!-- <form action="software/html/tags/html_form_tag_action.cfm"> -->
<?php $swrepolist = swrepo_get_deviceseries(); print_r($swrepolist); ?>

<fieldset class="form-group">
<label for="device_series">Device Series</label>
<select class="custom-select" id ="device_series" onChange="get_nodeversion();"> 
<!-- <select class="custom-select" id ="device_series" >    -->
<option selected>Choose Device Series</option>
<?php print_r($swrepolist);foreach ($swrepolist as $key => $val){ ?>
<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
<?php }; ?>
</select>
</fieldset>

<?php $swreponodeversions = swrepo_get_nodeversions(); print_r($swreponodeversions); ?>

<fieldset class="form-group">
<label for="os_version">Node Version</label>
<select class="custom-select" id ="node_version">
<option selected>Choose OS Version </option>
<?php print_r($swreponodeversions);foreach ($swreponodeversions as $key => $val){ ?>
<option value="<?php //echo $val['nodeVersion'];?>"><?php echo $val['nodeVersion'];?></option>
<?php }; ?>
</select>
</fieldset>
<?php $swrepogetfilenames = swrepo_get_filenames(); print_r($swrepogetfilenames); ?>
<fieldset class="form-group">
<label for="sw_filename">File Name</label>
<select class="custom-select" id ="sw_filename">
<option selected>Choose Filename</option>
<?php print_r($swrepogetfilenames);foreach ($swrepogetfilenames as $key => $val){ ?>
<option value="<?php echo $val['filename'];?>"><?php echo $val['filename'];?></option>
<?php }; ?>
</select>
</fieldset>
<fieldset class="form-group">
<label for="sw_selpriority">Priority</label>
<select class="form-control custom-select" id="sw_selpriority">
        						<option>1</option>
            					<option>2</option>
            					<option>3</option>
            					<option>4</option>
								<option>5</option>
            					<option>6</option>
            					<option>7</option>
            					<option>8</option>
            					<option>9</option>
            					<option>10</option>
</select>

</fieldset>							

<!-- </form> -->
</div>
  <div class="column" style="background-color:#bbb;">
    <h2>Column 2</h2>
<p id="cp1" style="display: none"></p>
<input type="hidden" id='userid' value="<?php echo "testuser";//echo $userid ?>" name="">
<input type="hidden" value="<?php echo time();?>" name="batchid" id="batchid">
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['templname']; ?>" name="scriptname" id="scriptname" /> -->
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['deviceseries']; ?>" name="deviceseries" id="deviceseries"/> -->
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['deviceos']; ?>" name="deviceos" id="deviceos"/>	 -->
   
<table id="swdelvrybatchpro" class="display" style="width:100%">
        <thead>
            <tr> 
			    <th>id</th>
                <th>deviceIpAddr</th>
                <th>systemname</th>
                <th>deviceseries</th>
                <th>market</th>
                <th>nodeVersion</th>
            </tr>
        </thead>        
</table> 	
  </div>
</div>

<button type="submit" value="SUBMIT" class="btn btn-default" id="batch-submit">SUBMIT</button>
</body>
</html>