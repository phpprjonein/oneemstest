<?php

include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
 check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
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

        <div class="wrapper">
            <?php include ('menu.php'); ?> 

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
			  <?php $region = $_GET['region']; $market = $_GET['market']; $subnetmask = $_GET['subnetmask'];
			  $region = 'South East ' ;$market = 'Georgia/Alabama';
			  //$region = 'Great Lakes' ;$market = 'OPW';?>
			  <?php $devicelist = get_nodes_list_ipmgmt($region,$market,$subnetmask); ?>
              <?php foreach ($devicelist['ipaddrlst'] as $key => $val) { ?>
			  <?php foreach ($devicelist['devicerecords'] as $key1 => $val1){ ?>
			  <?php if ($val1['deviceIpAddr'] == $val) { ?>
                <tr>
                  <td><?php echo $val; ?></td> 					  
                  <td><?php echo $val1['deviceName'];?></td>
                  <td><?php echo $val1['csr_site_id'];?></td>
                  <td><?php echo $val1['csr_site_name'];?></td>
                  <td><?php echo $val1['deviceseries'];?></td>
                  <td><?php echo $val1['deviceos'];?></td>
                  <td><?php echo $val1['nodeversion'];?></td>
                  <td><?php echo $val1['lastpolled'];?></td>
                </tr>
			  <?php } else { ?>
			  <tr>
                  <td><?php echo $val; ?></td> 					  
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo "Not in use";?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                  <td><?php echo ""?></td>
                </tr> 
			  <?php }; ?> 
			  <?php };};?>
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
		
		<!-- add subnet mask modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD A SUBNET IN $REGION$</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- add subnet mask form -->

<table class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col-1"></th>
                  <th scope="col-1" colspan="3" class="table_center_text">RANGE</th>

                  <th scope="col-1" class="table_center_text">ADD SUBNET</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>

<!-- market dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SELECT MARKET
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Ohio</a>
                        <a class="dropdown-item" href="#">OPW-EAST</a>
                        <a class="dropdown-item" href="#">Outer Illinois</a>
                      </div>
                    </div>
<!-- /market dropdown -->

                  </td>
                  <td>172.202.190.0</td>
                  <td>255</td>
                  <td>172.202.190.255</td>
                  <td>
                    <div class="row">
                      <div class="col-lg-8 col-md-12 col-sm-12">
                        <input type="email" class="form-control" id="inputSubnet" placeholder="SUBNET">
                      </div>
                      <div class="col-lg-1 d-none d-xl-block">
                        <label for="inputMask">/</label>
                      </div>
                      <div class="col-lg-3 col-md-12 col-sm-12">
                        <input type="email" class="form-control" id="inputMask" placeholder="MASK">
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

<!-- /add subnet mask form -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn">COMPUTE</button>
            <button type="button" class="btn" disabled>ADD</button>
          </div>
        </div>
      </div>
  </div>
<!-- /add subnet mask modal -->

         <?php include ('footer.php'); ?> 
    </body>
</html>
