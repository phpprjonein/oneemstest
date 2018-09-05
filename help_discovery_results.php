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
$mesg = " User name: $username User type : $usertype Page:  Discovery Results Help page Description: User has navigated to the Discovery Results help page.";
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
    'Discovery Results Help' => '#'
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
									<a class="nav-link" href="help_backup.php">BACKUP</a> <a
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
									<a class="nav-link" href="#item-6">DISCOVERY RESULTS</a>
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
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1"
											href="help_admin.php#item-8-1">Load Template - Golden</a> <a
											class="nav-link ml-3 my-1"
											href="help_admin.php#item-8-2">Software Upload</a>
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
							<h4 id="item-6">DISCOVERY RESULTS</h4>
							<p>This results screen provides a view of all recently discovered
								IP addresses. There are three distinct views:</p>
							<ul>
								<li>Missed View</li>
								<li>New View</li>
								<li>OK View</li>
							</ul>
							<h5 id="item-6-1">Missed IP Addresses View</h5>
							<p>This view shows all the IP addresses that are present in the
								current One EMS inventory but were not reachable during the last
								discovery session.</p>
							<img src="resources/img/screenshot-discovery-missed.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-discovery-missed">
							<p></p>
							<span class="font-italic"><b>FIG. 6.1 - Missed IP Addresses
									Dashboard</b></span>
							<p></p>
							<h5 id="item-6-2">New IP Addresses View</h5>
							<p>This view shows all the IP addresses of devices that were
								added to the One EMS inventory during the last discovery
								session.</p>
							<img src="resources/img/screenshot-discovery-new.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-discovery-new">
							<p></p>
							<span class="font-italic"><b>FIG. 6.2 - New IP Addresses
									Dashboard</b></span>
							<p></p>
							<h5 id="item-6-3">OK IP Addresses View</h5>
							<p>This view shows all the IP addresses of devices that exist in
								the One EMS inventory with no changes found during the most
								recent discovery session.</p>
							<img src="resources/img/screenshot-discovery-ok.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-discovery-ok">
							<p></p>
							<span class="font-italic"><b>FIG. 6.3 - OK IP Addresses Dashboard</b></span>
							<p></p>
							<h5 id="item-6-4">Manual Discovery View</h5>
							<p>This view allows for users to manually discover devices that are new and have not been discovered yet by the periodic backend discovery process.</p>
							<img src="resources/img/screenshot-discovery-manual.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-discovery-manual">
							<p></p>
							<span class="font-italic"><b>FIG. 6.4 - Manual Discovery
									Dashboard</b></span>
							<p></p>
							<p><b>Inserting A Manually Discovered Device Into OneEMS</b>
							<br>
							After discovering a device manually, you will get a popup that shows the details of the discovery. To save this to the database you will need to specify the correct Market (from a dropdown). Then you can “Save Changes”.</p>
							<img src="resources/img/screenshot-discovery-manual3.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-discovery-manual3">
							<p></p>
							<span class="font-italic"><b>FIG. 6.5 - Manual Discovery Update</b></span>
							<p></p>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_discovery_ips.php" class="border"><b><< PREV:
											Discovery IPs</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_maintenance.php" class="border"><b>NEXT:
											Maintenance >></b></a>
								</div>
							</div>
							<hr>
							<!-- /FAQs -->

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
		<div class="modal fade show" id="screenshot-discovery-missed"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-discovery-missed.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-discovery-new"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-discovery-new.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-discovery-ok"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-discovery-ok.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-discovery-manual"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-discovery-manual.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-discovery-manual3"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-discovery-manual3.png" alt=""
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
