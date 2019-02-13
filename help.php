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
									<a class="nav-link" href="#item-1">GETTING STARTED</a>
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
										<a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-2">Reboot</a>
										<a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
									</nav>
									<a class="nav-link" href="help_instant_hc.php">TOOLS</a>
									<a class="nav-link" href="help_audit.php">AUDIT</a>
									<nav class="nav nav-pills flex-column">
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-1">Customized Audit</a>
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-2">Customized Audit History</a>
									</nav>
									<a class="nav-link" href="help_inventory.php">INVENTORY</a>
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-1">Load Template - Golden</a>
										<a class="nav-link ml-3 my-1" href="help_admin.php#item-9-2">Maintenance</a>
                                    </nav>
									<a class="nav-link" href="help_ssh.php">PAM SSH USER GUIDE</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_ssh.php#item-ssh2">Command Line Usage - SSH</a>
										<a class="nav-link ml-3 my-1" href="help_ssh.php#item-ssh3">SSH Application Usage: PuTTY</a>
										<a class="nav-link ml-3 my-1" href="help_ssh.php#item-ssh4">SSH Application Usage: SecureCRT</a>
                                    </nav>
									<a class="nav-link" href="help_faqs.php">FAQs</a>
								</nav>
							</nav>
						</div>
<!-- /help guide navigation -->

<!-- help guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-1">GETTING STARTED</h4>
							<p>The One EMS application allows <b>users</b> to perform routine network device management tasks. Devices are  grouped according to <b>Region</b> and further subdivided by <b>Markets</b>. Users are initially provided a  default list of <b>Routers</b> (assigned in <b>Ops Tracker</b>). A user can also create customized lists of  Routers. Users can perform actions on each Router including; device health checks, manual discovery, on-demand backup / restore and generation of task specific scripts.</p>
							<p>To get started, a user <b><i>MUST</i></b> first complete the following prerequisites:</p>
							<ul>
								<li>obtain permission / access from supervisor (or from <b>CARMS</b> when available)</li>
								<li>have a single sign on account in <b>USWIN</b></li>
								<li>secure access to the <b>Verizon SSO</b> login screen
								</li>
							</ul>
							<a name="SoftwareRequirements">&nbsp;</a>
							<p><b>OneEMS Software Requirements</b></p>
							<ol>
								<li>Install PuTTY 7.0 or higher
								<br>
								<a href="https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html" target="_blank">https://www.chiark.greenend.org.uk/~sgtatham/putty/latest.html</a></li>
								<li>Install WinSCP version 5.13.7 or higher
								<br>
								<a href="https://winscp.net/eng/download.php" target="blank">https://winscp.net/eng/download.php</a></li>
								<li><b>For Windows IE associate WinSCP with SSH:</b>
									<ul>
										<li>Click on <b>Tools->Internet Options->Programs->Set Programs</b></li>
										<li>Select <b>"Associate a file type or protocol with a specific program"</b> and scroll down to SSH</li>
										<li>Select SSH and click on <b>"Change program"</b>, then select WinSCP* and click "OK"</li>
										<li>Close all windows</li>
									</ul>
								</li>
								<li><b>For Firefox, associate WinSCP with SSH:</b>
								<br>
									<ul>
										<li>Click on <b>Open Menu->Options</b>, then scroll down to "Applications"</li>
										<li>Select SSH and select the “WinSCP*” option from the dropdown menu</li>
										<li>Close all windows</li>
									</ul>
							</ol>
							<p>To test with any browser, use the following string in your URL section:</p>
							<p><b>ssh://<win-vzwnet_userid>@PAMadmingrp@<IPv6 address>@pamssh.nsiam.vzwnet.com</b></p>
							<p>When prompted, enter your win-vzwnet password.</p>
							<hr>
							<p></p>
							<a href="help_network_elements.php" class="border"><b>NEXT: Network Elements >></b></a>
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
