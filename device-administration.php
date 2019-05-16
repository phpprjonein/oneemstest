<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
include_once ('config/session_check_admin.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 8) ? "Admin" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Discovery Results page Description: Cell Site Tech has navigated to the Discovery Results page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/device-administration.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body>
	<!-- container div -->
	<div class="container-fluid" id="disc-mgt-screen">
<?php include_once ('menu.php'); ?>
		<?php
$values = array(
        'Device Cleanup' => '#'
);
echo generate_site_breadcrumb($values);
?>
		<!-- IP management table row -->
		<div class="row">

			<!-- table pill navigation -->
			<div class="col col-md-2 col-sm-12">
				<div class="nav flex-column nav-pills" id="v-pills-tab"
					role="tablist" aria-orientation="vertical">
					<a
						class="nav-link btn-missed active"
						id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1"
						role="tab" aria-controls="v-pills-tab1" aria-selected="true">Site Id & IPV4 & IPv6 - Same </a>
					<a
						class="nav-link btn-new"
						id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2"
						role="tab" aria-controls="v-pills-tab2" aria-selected="false"> IPv4 & IPv6 - Same </a>
					<a
						class="nav-link btn-ok"
						id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3"
						role="tab" aria-controls="v-pills-tab3" aria-selected="false">Site Id & (IPv4 || IPv6 ) - Same </a>
					<a
						class="nav-link btn-manual"
						id="v-pills-tab4-tab" data-toggle="pill" href="#v-pills-tab4"
						role="tab" aria-controls="v-pills-case4" aria-selected="false"> IPv4 || IPv6 - Same </a>
                                <!--
					<a
						class="nav-link btn-manual"
						id="v-pills-tab5-tab" data-toggle="pill" href="#v-pills-tab5"
						role="tab" aria-controls="v-pills-case5" aria-selected="false"> Invalid Devices </a>	
				-->			
				</div>
			</div>
			<!-- /table pill navigation -->

			<!-- table content row -->
			<div class="col-11 col-md-10">

				<!-- IP container div -->
				<div class="tab-content" id="v-pills-tabContent">
					<!-- missed table content -->
					<div
						class="tab-pane fade table-responsive show active"
						id="v-pills-tab1" role="tabpanel"
						aria-labelledby="v-pills-tab1-tab">
						<table class="table table-sm table-striped ipcase1"
							id="ipcase1-table">
							<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">IPv6 Address</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_tab_content('ipcase1');
                if (isset($resultset)) {
                    foreach ($resultset as $key1 => $value1) {
                            foreach ($value1 as $key => $value) {    
                            ?>
                            <tr>
    									<td><?php echo $value['id'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceIpAddrsix'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                }
                        }
                }
                ?>
                </tbody>
						</table>
					</div>
					<!-- /missed table content -->

					<!-- new table content -->
					<div
						class="tab-pane fade table-responsive"
						id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2-tab">
						<table class="table table-striped ip-new-table" id="ipcase2-table">
													<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">IPv6 Address</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_tab_content('ipcase2');
                if (isset($resultset)) {
                    foreach ($resultset as $key1 => $value1) {
                            foreach ($value1 as $key => $value) {    
                            ?>
                            <tr>
    									<td><?php echo $value['id'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceIpAddrsix'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                }
                        }
                }
                ?>
                </tbody>
						</table>
					</div>
					<!-- /new table content -->

					<!-- ok table content -->
					<div
						class="tab-pane fade table-responsive"
						id="v-pills-tab3" role="tabpanel" aria-labelledby="v-pills-tab3-tab">
            	<?php $resultset =  load_discovery_dataset('k'); ?>
              <table id="ipcase3-table"
							class="table table-sm table-striped ip-ok-table">
				<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">IPv6 Address</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_tab_content('ipcase3');
                if (isset($resultset)) {
                    foreach ($resultset as $key1 => $value1) {
                            foreach ($value1 as $key => $value) {    
                            ?>
                            <tr>
    									<td><?php echo $value['id'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceIpAddrsix'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                }
                        }
                }
                ?>
                </tbody>
						</table>
					</div>
					<!-- /ok table content -->
					<div
						class="tab-pane fade"
						id="v-pills-tab4" role="tabpanel"
						aria-labelledby="v-pills-tab4-tab">
						<table class="table table-striped ip-new-table" id="ipcase4-table">
<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">IPv6 Address</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_tab_content('ipcase4');
                if (isset($resultset)) {
                    foreach ($resultset as $key1 => $value1) {
                            foreach ($value1 as $key => $value) {    
                            ?>
                            <tr>
    									<td><?php echo $value['id'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceIpAddrsix'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                }
                        }
                }
                ?>
                </tbody>
						</table>	
				</div>		
				
									<div
						class="tab-pane fade"
						id="v-pills-tab5" role="tabpanel"
						aria-labelledby="v-pills-tab5-tab">
						<table class="table table-striped ip-new-table" id="ipcase5-table">
<thead>
								<tr>
									<th scope="col">ID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">IPv6 Address</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_tab_content('ipcase5');
                if (isset($resultset)) {
                    foreach ($resultset as $key => $value) {
                            //foreach ($value1 as $key => $value) {    
                            ?>
                            <tr>
    									<td><?php echo $value['id'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceIpAddrsix'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                //}
                        }
                }
                ?>
                </tbody>
						</table>	
				</div>	
				
				
				</div>
			</div>
			<!-- /IP container div -->
		</div>
		<!-- /table content row -->
	</div>
	<!-- /IP management table row -->
<?php include_once ('footer.php'); ?>
</body>
</html>
