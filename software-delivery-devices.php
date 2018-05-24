<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
 function swrepo_get_deviceseries() {
	  global $db2;
    $sql = "SELECT distinct(deviceseries) FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;
 };	
 function swrepo_get_nodeversions() {
	  global $db2;
    $sql = "SELECT distinct(deviceseries) FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;	
};

function swrepo_get_filenames() {
	  global $db2;
    $sql = "SELECT distinct(deviceseries) FROM swrepository";
    $db2->query($sql);
    $resultset = $db2->resultset();
    return $resultset;	
}; 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>One Ems</title>
  <meta charset="utf-8">
<?php //include_once("includes.php");  ?>
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
<script type="text/javascript" language="javascript" src="resources/js/popper.min.js"></script>
<script  type="text/javascript" language="javascript" src="resources/js/bootstrap.min.js"></script> 
        
        
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
td {word-wrap: break-word;word-break: break-all;} 
.dt-buttons button{width:2.5rem;height:2rem;border:none !important}
.dt-buttons span{display:none}

.dtexcelbtn{background:url(resources/img/xlsx.jpg) no-repeat center right !important}.dtpdfbtn{background:url(resources/img/pdf.jpg) no-repeat center right !important}.dtprintbtn{background:url(resources/img/print.png) no-repeat center right !important}div.dt-buttons{float:right}
.dt-buttons button{text-content:.;}
</style>
  <script >
    
  $(document).ready(function () {
      $('#swdelvrybatchpro').DataTable({
          "processing": true,
          "serverSide": true,
			 "dom": 'Bfrtip',
			 "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},
				 {extend: 'pdfHtml5',text: '',titleAttr:'PDF',className:'dtpdfbtn'},
				 {extend: 'copyHtml5',text: '',titleAttr:'Copy',className:'dtprintbtn'}
				 ],
          "ajax": {
              url: 'software-delivery-process.php',
              type: 'POST'
          },
          "columns": [ 		
              {  "className":      'batch-control',
                  "orderable":      false,
                  "data":           null,
                  "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},	 
              {"data": "id"},
              {"data": "deviceIpAddr"},
              {"data": "devicename"},
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
 
*/		
 $(document).ready(function(){
            $('#device_series').change(function(){
                //Selected value
                var deviceseries = $(this).val();
                //alert("value in js "+deviceseries); 
				$.ajax({
						type: "POST",
						url: 'getnodeversion.php',
						data: {dropdownValue: deviceseries},
						success: function(data){
						//alert(data);
						// $('#node_version').remove();
						$('#node_version').children('option:not(:first)').remove();
						$('#node_version').append(data);	
						}
					});	
                });
            })
$(document).ready(function(){
            $('#node_version').change(function(){
                //Selected value
                var deviceseries = $(device_series).val();
				var nodeversion = $(this).val();
                //alert("value in" + deviceseries + nodeversion); 
               $.ajax({
						type: "POST",
						url: 'getswrepofilenames.php',
						data: {deviceseries:deviceseries,nodeversion: nodeversion},
						success: function(data){
						//alert(data);
						$('#swrp_filename').children('option:not(:first)').remove();
						$('#swrp_filename').append(data);	
						}
					});	
                });
            }) 
			$(document).on('click', '#batch-submit', function(event) {
        	var allVals = [];
        	$('#swdelvrybatchpro').children().find('input[type=checkbox]:checked').each(function(index){
        		allVals.push($(this).closest('tr').find("td:eq(1)").text());
        	});

        	if(allVals.length == 0){
            	alert('Error! Device selection is required');
            	return false;	
        	}
            $.ajax({
                type:"post",
                url:"software-delivery-batch-process.php",
                data: {'ctype':'BatchTabUPdate', 'userid':$(this).data('userid'), 'category':allVals, 'scriptname':$('#swrp_filename').val(), 'deviceseries':$('#device_series').val(), 'node_version':$('#node_version').val(), 'priority':$('#sw_selpriority').val()}, 
                success: function(resdata){
                	var myModal = $('#batchModal');
            		myModal.modal('show'); 
                }
            });
        	return false;
    	}); 

	
$(document).ready(function() {
	

	
	/*
	 $('form').submit(function(event) {  
        alert('value of node version is' + $('#node_version').val());
		var formData = {
            'device_series'    : $('#device_series]').val(),
            'node_version'     : $('#node_version').val(),
            'swrp_filename'    : $('#swrp_filename').val(),
			'sw_selpriority'   : $('#sw_selpriority').val()
        }
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'software-delivery-batch-process.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode      : true
        })
		.done(function(data) {
			   alert('response'); 
                alert(data);   
				$.each( data, function( key, value ) {  });
                console.log(data); 
            });
        event.preventDefault();
    });
	*/
	$('#batchModal').on('hidden.bs.modal', function () {
		 //location.reload();
		 window.location.href = 'batch-tracking-devices.php';
	})
});		
			
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
			  Please do keep track the status on Batch Page
			  <?php if(isset($_SESSION['batch_vars']['batchid'])):?>
			  <br>Batch ID : <?php echo $_SESSION['batch_vars']['batchid']; ?></b>
			  <?php endif;?>
			  </div>
			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
<div class="jumbotron text-center" style="margin-bottom:0">
  <h1> Software Delivery</h1>
</div>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Network Elements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Backup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Configuration</a>
      </li>    
	  <li class="nav-item">
        <a class="nav-link" href="#">Discovery</a>
      </li>    
	  <li class="nav-item">
        <a class="nav-link" href="#">Maintenance</a>
      </li>    
	  <li class="nav-item">
        <a class="nav-link" href="#">Help</a>
      </li>    
    </ul>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
<form action="#" method="POST">
  <div class="row">
    <div class="col-lg-4">
 <!--<form action="software/html/tags/html_form_tag_action.cfm">-->
<?php $swrepolist = swrepo_get_deviceseries();// print_r($swrepolist); ?>

<fieldset class="form-group">
<label for="device_series">Device Series</label>
<select class="custom-select" id ="device_series" name ="device_series"> 
<option selected>Choose Device Series</option>
<?php foreach ($swrepolist as $key => $val){ ?>
<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
<?php }; ?>
</select>
</fieldset>

<?php $swreponodeversions = swrepo_get_nodeversions();// print_r($swreponodeversions); ?>

<fieldset class="form-group">
<label for="os_version">Node Version</label>
<select class="custom-select" id ="node_version" name ="node_version">
<option selected>Choose OS Version </option>
</select>
</fieldset>
<?php $swrepogetfilenames = swrepo_get_filenames(); //print_r($swrepogetfilenames); ?>
<fieldset class="form-group">
<label for="swrp_filename">File Name</label>
<select class="custom-select" id ="swrp_filename" name ="swrp_filename">
<option selected>Choose Filename</option>
</select>
</fieldset>
<fieldset class="form-group">
<label for="sw_selpriority">Priority</label>
<select class="form-control custom-select" id="sw_selpriority" name="sw_selpriority">
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
</div>
    <div class="col-lg-8">
        <h2> Devices List </h2>
<p id="cp1" style="display: none"></p>
<input type="hidden" id='userid' value="<?php echo $userid ?>" name="">
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['templname']; ?>" name="scriptname" id="scriptname" /> -->
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['deviceseries']; ?>" name="deviceseries" id="deviceseries"/> -->
<!-- <input type="hidden" value="<?php //echo $_SESSION['batch_vars']['deviceos']; ?>" name="deviceos" id="deviceos"/>	 -->
   
<table id="swdelvrybatchpro" class="display" style="width:100%">
        <thead>
            <tr> 
            	<th></th>
			    <th>Id</th>
                <th>IP Address</th>
                <th>Device Name</th>
                <th>Device Series</th>
                <th>Market</th>
                <th>Version</th>
            </tr>
        </thead>        
</table> 	
<button type="button" value="SUBMIT" class="btn btn-default text-center"  id="batch-submit" name="batch-submit">SUBMIT</button>
  </div>
</div>
</form>
</div>  

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>© 2018 OneEMS. All rights reserved. All content is confidential and proprietary.</p>
</div>
</body>
</html>