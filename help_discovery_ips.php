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
// check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Discovery IPs Help page Description: User has navigated to the Discovery IPs help page.";
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
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
  <?php
$values = array(
    'Discovery IPs Help' => '#'
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
									<a class="nav-link" href="#item-5">DISCOVERY IPs</a>
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
							<h4 id="item-5">DISCOVERY IPs</h4>
							<p>
								This <b>IP Allocation screen</b> allows a user to manage the <b>subnet
									ranges</b> associated with certain devices. This management
								function is categorized by Region by default.
							</p>
							<p>Here, users can:


							<ul>
								<li>View Subnets previously assigned to a Region</li>
								<li>Add a subnet for a specific Region and Market</li>
							</ul>
							</p>
							<img src="resources/img/screenshot-ip_management.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-ip_management">
							<p></p>
							<span class="font-italic"><b>FIG. 5.1 - IP Management Dashboard</b></span>
							<p></p>
							<p>
								To view subnets by Region, choose a Region from the dropdown
								menu to the right of the <b>IP Type</b> button. When this
								Dashboard first loads, a user's default Region is
								selected.
							</p>
							<img
								src="resources/img/screenshot-ip_management_choose_Region-1.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-ip_management_choose_Region-1">
							<p></p>
							<span class="font-italic"><b>FIG. 5.2 - Choose Region</b></span>
							<p></p>
							<h5 id="item-5-1">Subnet Addition</h5>
							<p></p>
							<p>
								To add a Subnet, choose a Region from the <b>Select Region</b>
								dropdown at the top of the page.
							</p>
							<img
								src="resources/img/screenshot-ip_management_choose_Region-2.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-ip_management_choose_Region-2">
							<p></p>
							<span class="font-italic"><b>FIG. 5.3 - Choose Region For Subnet
									Addition</b></span>
							<p></p>
							<p>
								Once you've selected a Region, click on the <b>Add A Subnet</b>
								button. You will then be presented with the Add A Subnet screen.
							</p>
							<img
								src="resources/img/screenshot-ip_management_add_subnet-1.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-ip_management_add_subnet-1">
							<p></p>
							<span class="font-italic"><b>FIG. 5.4 - Add A Subnet Screen</b></span>
							<p></p>
							<p>
								Once at this screen, you can now set a subnet and a
								corresponding subnet mask to compute subnet range values for.
								Once you've input your values into the input fields on this
								screen, click on the <b>Compute</b> button to display the
								appropriate range of IPs.
							</p>
							<p>
								The correct subnet range is then displayed to the left of the
								input values. You can then either re-enter values to compute for
								different ranges or click the <b>Add</b> button to add this
								subnet to the total list of subnets associated with this
								particular Market.
							</p>
							<img
								src="resources/img/screenshot-ip_management_add_subnet-2.png"
								class="img-fluid" alt="" data-toggle="modal"
								data-target="#screenshot-ip_management_add_subnet-2">
							<p></p>
							<span class="font-italic"><b>FIG. 5.5 - Select Subnet And Subnet
									Mask Range Screen</b></span>
							<p></p>
							<p>
								Clicking on the <b>Close</b> "X" icon will bring the user back
								to the main <b>Discovery IPs</b> screen.
							</p>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_config.php" class="border"><b><< PREV:
											Configuration</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_discovery_results.php" class="border"><b>NEXT:
											Discovery Results >></b></a>
								</div>
							</div>
							<hr>
							<!-- /FAQs -->

						</div>
					</div>
					<!-- /help guide content row -->

				</div>
			</section>
			<!-- /Main content -->

		</div>
	</div>
	<!-- container-fluid -->

	<!-- image modals -->
	<div class="big-modal">
		<div class="modal fade show" id="screenshot-ip_management"
			tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-ip_management.png" alt=""
						width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show"
			id="screenshot-ip_management_choose_Region-1" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm text-center">
				<button type="button" class="close img-close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<img
					src="resources/img/screenshot-ip_management_choose_Region-1_LARGE.png"
					alt="" width="">
			</div>
		</div>
		<div class="modal fade show"
			id="screenshot-ip_management_choose_Region-2" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm text-center">
				<button type="button" class="close img-close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<img
					src="resources/img/screenshot-ip_management_choose_Region-2_LARGE.png"
					alt="" width="">
			</div>
		</div>
		<div class="modal fade show"
			id="screenshot-ip_management_add_subnet-1" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-ip_management_add_subnet-1.png"
						alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show"
			id="screenshot-ip_management_add_subnet-2" tabindex="-1"
			role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-ip_management_add_subnet-2.png"
						alt="" width="100%">
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
