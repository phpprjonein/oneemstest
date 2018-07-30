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
$mesg = " User name: $username User type : $usertype Page:  Main help page Description: User has navigated the first Help page.";
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
	<!-- <div class="container-fluid" id="cellsitech-config"> -->
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
		<?php
$values = array(
    'Help' => '#'
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
									<a class="nav-link" href="#item-1">GETTING STARTED</a> <a
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
										class="nav-link help active" href="help_config.php">CONFIGURATION</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-1">Load
											Template</a> <a class="nav-link ml-3 my-1"
											href="help_config.php#item-4-2">Generate Script</a> <a
											class="nav-link ml-3 my-1" href="help_config.php#item-4-3">Batch
											Tracking</a>
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
											href="help_maintenance.php#item-7-1">Software Delivery</a> <a
											class="nav-link ml-3 my-1"
											href="help_maintenance.php#item-7-2">Scheduled Backup</a> <a
											class="nav-link ml-3 my-1"
											href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
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
							<h4 id="item-1">GETTING STARTED</h4>
							<p>
								The One EMS application allows <b>users</b> to perform routine
								network device management tasks. Devices are grouped according
								to <b>Region</b> and further subdivided by <b>Markets</b>. Users
								are initially provided a default list of <b>Routers</b>
								(assigned in <b>Ops Tracker</b>). A user can also create
								customized lists of Routers. users can perform actions on each
								Router including; device health checks, manual discovery,
								on-demand backup / restore and generation of task specific
								scripts.
							</p>
							<p>
								To get started, a user <b><i>MUST</i></b> first complete the
								following prerequisites:
							</p>
							<ul>
								<li>obtain permission / access from supervisor (or from <b>CARMS</b>
									when available)
								</li>
								<li>have a single sign on account in <b>QTWIN</b> and <b>USWIN</b></li>
								<li>secure access to the <b>Verizon SSO</b> login screen
								</li>
							</ul>
							<p>The OneEMS application also supports a number secondary
								functionalities:</p>
							<ul>
								<li>Logging of user activity</li>
								<li>Integration with Piwik/Matomo analytics platform solutions</li>
								<li>Active & Passive DB replication</li>
								<li>Designed to support 200k+ separate elements/devices</li>
								<li>Servers sized to support devices and frequency of
									collections</li>
							</ul>
							<hr>
							<p></p>
							<a href="help_network_elements.php" class="border"><b>NEXT:
									Network Elements >></b></a>
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

	<!-- footer div -->
      <?php include_once ('footer.php'); ?>
<!-- /footer div -->

</body>
</html>
