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
// include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Instant Health Check Help page Description: User has navigated to the Instant Health Check help page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script
	src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?>
	<?php
$values = array(
    'Instant Health Check Help' => '#'
);
echo generate_site_breadcrumb($values);
?>

<!-- Content Wrapper. Contains page content -->
		<div class="content">

<!-- Main content -->
			<section class="content">
				<div class="col-md-12">

<!-- table manipulation row -->
					<div class="form-row align-items-center justify-content-between border"></div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
					<div class="row">

<!-- help guide navigation -->
						<div class="col-md-3 col-sm-12">
							<nav id="navbar-help" class="navbar navbar-light bg-light">
								<nav class="nav nav-pills flex-column">
									<h6 class="text-center">CONTENTS</h6>
									<a class="nav-link" href="help.php">GETTING STARTED</a>
									<a class="nav-link" href="help_network_elements.php">NETWORK ELEMENTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-2-1">List Management Options</a>
										<a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-3">Health Check Details View</a>
									</nav>
									<a class="nav-link" href="help_backup.php">BACKUP</a>
									<a class="nav-link" href="help_config.php">CONFIGURATION</a>
										<nav class="nav nav-pills flex-column">
											<a class="nav-link ml-3 my-1" href="help_config.php#item-4-1">Load Template - Modification</a>
											<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2">Generate Script - Modification</a>
											<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2-1">Generate Script - Golden</a>
											<a class="nav-link ml-3 my-1" href="help_config.php#item-4-3">Batch Tracking</a>
										</nav>
									<a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-5-1">Subnet Addition</a>
									</nav>
									<a class="nav-link" href="help_discovery_results.php">DISCOVERY RESULTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-1">Missed IP Addresses</a>
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-2">New IP Addresses</a>
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-3">OK IP Addresses</a>
										<a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-6-4">Manual Discovery</a>
									</nav>
									<a class="nav-link" href="help_maintenance.php">MAINTENANCE</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-1">Software Delivery</a>
										<a	class="nav-link ml-3 my-1"	href="help_maintenance.php#item-7-2">Reboot</a>
										<a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
									</nav>
                                    <a class="nav-link" href="#item-8">INSTANT HEALTH CHECK</a>
									<a class="nav-link" href="help_audit.php">AUDIT</a>
									<nav class="nav nav-pills flex-column">
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-1">Customized Audit</a>
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-2">Customized Audit History</a>
									</nav>
									<a class="nav-link" href="help_inventory.php">INVENTORY</a>
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-1">Load Template - Golden</a>
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-2">Software Upload</a>
                                    </nav>
									<a class="nav-link" href="help_faqs.php">FAQs</a>
								</nav>
							</nav>
						</div>
<!-- /help guide navigation -->

<!-- help guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-8">INSTANT HEALTH CHECK</h4>
							<p>This view allows a user to initiate a full health check on a specific device in the OneEMS network.</p>
							<p>A user can perform this search based on IPV4/IPV6 addresses OR device name.</p>
							<img src="resources/img/screenshot-insta-hc1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-insta_hc1">
							<p></p>
							<span class="font-italic"><b>FIG. 8.1 - Instant Health Check  Dashboard Results</b></span>
							<p></p>
							<p>This dashboard page returns the same results as a Health Check initiated for a device on the <a  href="help_network_elements.php#item-2-3">main Health Check page</a>, but for a single device.</p>
                            <p>This dashboard returns Health Check results based on the device type of the IP address or device name. ASR9K devices return results for parameters such as redundancy state, CPU utilization, memory utilization, software running on the RSP and others.</p>
                            <img src="resources/img/screenshot-insta-hc2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-insta_hc2">
							<p></p>
							<span class="font-italic"><b>FIG. 8.2 - Instant Health Check Dashboard Results for an ASR9K device</b></span>
							<p></p>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_maintenance.php" class="border"><b><< PREV: Maintenance</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_audit.php" class="border"><b>NEXT: Audit >></b></a>
								</div>
							</div>
							<hr>
						</div>
					</div>
<!-- /help guide content row -->

				</div>
			</section>
<!-- /.content -->

		</div>
	</div>
<!-- container-fluid -->

<!-- image modals -->
	<div class="big-modal">
		<div class="modal fade show" id="screenshot-insta_hc1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-insta-hc1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-insta_hc2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-insta-hc2.png" alt="" width="100%">
				</div>
			</div>
		</div>
	</div>
<!-- /image modals -->

<!-- footer div -->
      <?php include_once ('footer.php'); ?>
<!-- /footer div -->

</body>
</html>