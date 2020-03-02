<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
// check_user_authentication('1'); //cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t="
	.<?php echo date('his'); ?>></script>
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
				<div class="col-auto align-middle"></div>
				<!-- /Export table -->

			</div>
			<!-- /table maniupulation row -->

			<hr />

			<!-- IP management table row -->
			<div class="row">

				<!-- table content row -->
				<div class="col">
      <?php $region = $_GET['region']; $market = $_GET['market']; $subnetmask = $_GET['subnetmask'];  ?>
		<?php //$devicelist = get_nodes_list_ipmgmtv6($region,$market,$subnetmask); print '<pre>'; print_r($devicelist); die; ?>
		
		
		
		
<!-- IP table content -->
					<div class="tab-pane fade show active" id="v-pills-home"
						role="tabpanel" aria-labelledby="v-pills-home-tab">
						<table id="ipv6subnetmask" class="table table-striped table-sm">
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
			  <?php $devicelist = get_nodes_list_ipmgmtv6($region,$market,$subnetmask); ?>
 			  <?php foreach ($devicelist as $key1 => $val1): ?>
 			    <tr>
									<td><?php echo $val1['deviceIpAddr']; ?></td>
									<td><?php echo $val1['devicename'];?></td>
									<td><?php echo $val1['csr_site_id'];?></td>
									<td><?php echo $val1['csr_site_name'];?></td>
									<td><?php echo $val1['deviceseries'];?></td>
									<td><?php echo $val1['deviceos'];?></td>
									<td><?php echo $val1['nodeVersion'];?></td>
									<td><?php echo $val1['lastpolled'];?></td>
								</tr>
 			  <?php endforeach;?>
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
         <?php include ('footer.php'); ?> 
    



</body>
</html>
