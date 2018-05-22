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
function get_celltechusers_list($userid){
    global $db2;
    $sql = "select distinct(listid), listname from userdevices where userid=".$userid;
    $db2->query($sql);
    $resultset['result'] = $db2->resultset();
    return  $resultset['result'];
}
if ( ! isset($_SESSION['userid'])) {
    
    header("Location: index.php?msg=User session expired");
    exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>One Ems</title>
  <meta charset="utf-8">
<?php //include_once("includes.php");  ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="swd/js/jquery.min.js"></script>
<script src="swd/js/jquery-1.12.4.js"> </script>
<script src="swd/js/jquery.dataTables.min.js"></script>
<script src="swd/js/dataTables.bootstrap4.min.js"> </script>
<script src="swd/js/dataTables.buttons.min.js"> </script>
<script src="swd/js/jszip.min.js"> </script>
<script src="swd/js/pdfmake.min.js"> </script>
<script src="swd/js/vfs_fonts.js"> </script>
<script src="swd/js/buttons.html5.min.js"> </script>
<link rel="stylesheet" type="text/css" href="swd/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="swd/css/dataTables.bootstrap4.min.css"> 
<script type="text/javascript" language="javascript" src="resources/js/popper.min.js"></script>
<script  type="text/javascript" language="javascript" src="resources/js/bootstrap.min.js"></script> 
<script  type="text/javascript" language="javascript" src="resources/js/bootstrap.min.js"></script> 
<script src="swd/js/batch_page.js"> </script>
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
						  <div class="btn-group" id="backup-restore-list-dt-filter">
						  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           My routers
						  </button>
						  <div class="dropdown-menu">
						  <?php
						  $celltuser_list = get_celltechusers_list($_SESSION['userid']);
						  foreach ($celltuser_list as $key => $value):
							if(isset($value['listname'])):
						  ?>
						  <a class="dropdown-item" href="#"><?php echo ($value['listname'] == "0") ? 'My routers' : $value['listname'] ; ?></a>
						  <?php
						  endif;
						  endforeach;
                            ?>
						  </div>
						</div>
   
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