<<<<<<< HEAD
<?php

include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
 //check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid">
            <?php include_once ('menu.php'); ?> 

<!-- container div -->
  <div class="content container-fluid">



<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between">

<!-- region name -->
      <div class="col-auto">
        <b>REGION:</b> <?php echo $_GET['region']; ?>
      </div>
<!-- /region selection -->

<!-- add row button -->
      <div class="col-auto">
        <b>MARKET:</b> <?php echo $_GET['market']; ?>
      </div>
<!-- /add row button -->

<!-- search table form field -->

<!--      <div class="col-6">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Region Table" aria-label="Search Region Table">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </div>
	  -->
<!-- /search table form field -->

<!-- Export table -->
      <div class="col-auto align-middle">
        
      </div>
<!-- /Export table -->

    </div>
<!-- /table maniupulation row -->

    <hr />

<!-- IP management table row -->
    <div class="row">

<!-- table content row -->
      <div class="col">

<!-- IP table content -->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table id="ipv4subnetmask" class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">IP Address</th>
                  <th scope="col">Device Name</th>
                  <th scope="col">Site ID</th>
                  <th scope="col">Site Name</th>
                  <th scope="col">Device Series</th>
                  <th scope="col">OS</th>
                  <th scope="col">OS Version</th>
                  <th scope="col">Last Polled</th>
                </tr>
              </thead>
              <tbody>             
			  <?php $region = $_GET['region']; $market = $_GET['market']; $subnetmask = $_GET['subnetmask'];  ?>
			  <?php $ipvfour_details = getipvfour_details($subnetmask);?>
			  <?php $ipvfour_node_details = get_nodes_list_ipmgmt($region,$market,$subnetmask);?>
			  <?php 
			  foreach ($ipvfour_node_details as $key => $val){
			      $ipvfour_node_details[$val['deviceIpAddr']] = $val;
			      unset($ipvfour_node_details[$key]);
			  }
			  
			  foreach ($ipvfour_details as $ipkey => $ipval){
			      if(array_key_exists($ipval, $ipvfour_node_details)): ?>
			      <tr>
			      <td><?php echo $ipval; ?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['devicename'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['csr_site_id'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['csr_site_name'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['deviceseries'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['deviceos'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['nodeVersion'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['lastpolled'];?></td>
                </tr>
			 <?php      
			      else:
			 ?>
			 	<tr>
                  <td><?php echo $ipval; ?></td> 					  
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo "Not in use";?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                </tr>  	
			 <?php      
			      endif;
			  }
			  ?>
              </tbody>
            </table> 
          </div>
<!-- /IP table content -->

      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->

  </div>
<!-- /container div -->
        <!-- ./wrapper -->
         <?php include_once ('footer.php'); ?> 
    </body>
</html>
=======
<?php

include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
 //check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid">
            <?php include_once ('menu.php'); ?> 

<!-- container div -->
  <div class="content container-fluid">



<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between">

<!-- region name -->
      <div class="col-auto">
        <b>REGION:</b> <?php echo $_GET['region']; ?>
      </div>
<!-- /region selection -->

<!-- add row button -->
      <div class="col-auto">
        <b>MARKET:</b> <?php echo $_GET['market']; ?>
      </div>
<!-- /add row button -->

<!-- search table form field -->

<!--      <div class="col-6">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Region Table" aria-label="Search Region Table">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </div>
	  -->
<!-- /search table form field -->

<!-- Export table -->
      <div class="col-auto align-middle">
        
      </div>
<!-- /Export table -->

    </div>
<!-- /table maniupulation row -->

    <hr />

<!-- IP management table row -->
    <div class="row">

<!-- table content row -->
      <div class="col">

<!-- IP table content -->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table id="ipv4subnetmask" class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">IP Address</th>
                  <th scope="col">Device Name</th>
                  <th scope="col">Site ID</th>
                  <th scope="col">Site Name</th>
                  <th scope="col">Device Series</th>
                  <th scope="col">OS</th>
                  <th scope="col">OS Version</th>
                  <th scope="col">Last Polled</th>
                </tr>
              </thead>
              <tbody>             
			  <?php $region = $_GET['region']; $market = $_GET['market']; $subnetmask = $_GET['subnetmask'];  ?>
			  <?php $ipvfour_details = getipvfour_details($subnetmask);?>
			  <?php $ipvfour_node_details = get_nodes_list_ipmgmt($region,$market,$subnetmask);?>
			  <?php 
			  foreach ($ipvfour_node_details as $key => $val){
			      $ipvfour_node_details[$val['deviceIpAddr']] = $val;
			      unset($ipvfour_node_details[$key]);
			  }
			  
			  foreach ($ipvfour_details as $ipkey => $ipval){
			      if(array_key_exists($ipval, $ipvfour_node_details)): ?>
			      <tr>
			      <td><?php echo $ipval; ?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['devicename'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['csr_site_id'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['csr_site_name'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['deviceseries'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['deviceos'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['nodeVersion'];?></td>
                  <td><?php echo $ipvfour_node_details[$ipval]['lastpolled'];?></td>
                </tr>
			 <?php      
			      else:
			 ?>
			 	<tr>
                  <td><?php echo $ipval; ?></td> 					  
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo "Not in use";?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                </tr>  	
			 <?php      
			      endif;
			  }
			  ?>
              </tbody>
            </table> 
          </div>
<!-- /IP table content -->

      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->

  </div>
<!-- /container div -->
        <!-- ./wrapper -->
         <?php include_once ('footer.php'); ?> 
    </body>
</html>
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
