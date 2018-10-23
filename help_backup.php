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
$mesg = " User name: $username User type : $usertype Page:  Backup Help page Description: User has navigated to the Backup help page.";
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
    'Backup Help' => '#'
);
echo generate_site_breadcrumb($values);
?>

        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<!-- table manipulation row -->
					<div
						class="form-row align-items-center justify-content-between border"></div>
					<!-- /table maniupulation row -->

					<!-- help guide content row -->
					<div class="row">

						<!-- help guide navigation -->
						<div class="col-md-3 col-sm-12">
							<nav id="navbar-help" class="navbar navbar-light bg-light">
								<nav class="nav nav-pills flex-column">
									<h6 class="text-center">CONTENTS</h6>
									<a class="nav-link" href="help.php">GETTING STARTED</a> <a
										class="nav-link" href="help_network_elements.php">NETWORK
										ELEMENTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_network_elements.php#item-2-2-1">List Management
											Options</a> <a class="nav-link ml-3 my-1"
											href="help_network_elements.php#item-2-3">Health Check
											Details View</a>
									</nav>
									<a class="nav-link" href="#item-3">BACKUP</a> <a
										class="nav-link" href="help_config.php">CONFIGURATION</a>
										<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-1">Load Template - Modification</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2">Generate Script - Modification</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2-1">Generate Script - Golden</a>
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-3">Batch Tracking</a>
									</nav>
									<a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_discovery_ips.php#item-5-1">Subnet Addition</a>
									</nav>
									<a class="nav-link" href="help_discovery_results.php">DISCOVERY
										RESULTS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_discovery_results.php#item-6-1">Missed IP
											Addresses</a> <a class="nav-link ml-3 my-1"
											href="help_discovery_results.php#item-6-2">New IP Addresses</a>
										<a class="nav-link ml-3 my-1"
											href="help_discovery_results.php#item-6-3">OK IP Addresses</a>
										<a class="nav-link ml-3 my-1"
											href="help_discovery_results.php#item-6-4">Manual Discovery</a>
									</nav>
									<a class="nav-link" href="help_maintenance.php">MAINTENANCE</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_maintenance.php#item-7-1">Software Delivery</a>
											<!-- <a
											class="nav-link ml-3 my-1"
											href="help_maintenance.php#item-7-2">Scheduled Backup</a>  -->
											<a	class="nav-link ml-3 my-1"	href="help_maintenance.php#item-7-2">Reboot</a>
											<a
											class="nav-link ml-3 my-1"
											href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
									</nav>
									<a class="nav-link" href="help_instant_hc.php">INSTANT HEALTH CHECK</a>
									<a class="nav-link" href="help_inventory.php">INVENTORY</a>
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_admin.php#item-9-1">Load Template - Golden</a> <a
											class="nav-link ml-3 my-1"
											href="help_admin.php#item-9-2">Software Upload</a>
                                    </nav>
									<a class="nav-link" href="help_faqs.php">FAQs</a>
								</nav>
							</nav>
						</div>
						<!-- /help guide navigation -->

						<!-- help guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example"
							data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-3">BACKUP</h4>
							<p>This view allows a user to manage existing configurations for
								devices on their network.</p>
							<p>A user can:</p>
							<ul>
								<li>Remotely backup the configuration of any device within the One EMS network configuration</li>
								<li>View configurations previously backed up for a specific	device and download to your local desktop</li>
								<li>Restore a previous configuration to a device. Note: This only copies the configuration file to the remote device</li>
								<li>Filter custom lists of devices via the "My List" dropdown</li>
							</ul>
							<img src="resources/img/screenshot-backup1.png" class="img-fluid"
								alt="" data-toggle="modal" data-target="#screenshot-backup1">
							<p></p>
							<span class="font-italic"><b>FIG. 3.1 - Backup Dashboard</b></span>
							<p></p>
							<p>
								To backup a device's configuration, simply click the <b>Backup</b>
								button in the right most column of the list table. This will run
								an API that attempts to remotely backup the configuration of the
								device selected in the user's List table.
							</p>
							<img src="resources/img/screenshot-backup2.png" class="img-fluid"
								alt="" data-toggle="modal" data-target="#screenshot-backup2">
							<p></p>
							<span class="font-italic"><b>FIG. 3.2 - Backup Device Results</b></span>
							<p></p>

							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_network_elements.php" class="border"><b><< PREV:
											Network Elements</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_config.php" class="border"><b>NEXT: Configuration
											>></b></a>
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
		<div class="modal fade show" id="screenshot-backup1" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-backup1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-backup2" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-backup2_LARGE.png" alt=""
						width="100%">
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
