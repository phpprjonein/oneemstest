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
										<a class="nav-link ml-3 my-1" href="help_config.php#item-4-2-2">Template - View / Modify</a>
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
                                        <a class="nav-link ml-3 my-1"	href="help_maintenance.php#item-7-2">Reboot</a>
                                        <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-3">Boot Order Sequence</a>
									</nav>
                                    <a class="nav-link" href="help_tools.php">TOOLS</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_tools.php#item-8-1">Run All Health Checks</a>
									</nav>
                                    <a class="nav-link" href="#item-audit">AUDIT</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-0">Compliance</a>
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-1">Customized Audit</a>
                                        <a class="nav-link ml-3 my-1" href="help_audit.php#item-audit-2">Customized Audit History</a>
									</nav>
									<a class="nav-link" href="help_inventory.php">INVENTORY</a>
									<a class="nav-link" href="help_admin.php">ADMIN</a>
									<nav class="nav nav-pills flex-column">
                                        <a class="nav-link ml-3 my-1" href="help_admin.php#item-9-1">Load Template - Golden</a>
                                        <a class="nav-link ml-3 my-1" href="help_admin.php#item-9-2">Maintenance</a>
                                    </nav>
									<a class="nav-link" href="help_faqs.php">FAQs</a>
								</nav>
							</nav>
						</div>
<!-- /help guide navigation -->

<!-- audit guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example"
							data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-audit">AUDIT</h4>
							<p>This dashboard allows <b>users</b> to audit network device management tasks. Devices accessible in this  dashboard are ones assigned to them, and include devices added to any custom lists created in the <a  href="help_network_elements.php#item-2-2-1">List Management Dashboard</a>.</p>
							<p>Users can:</p>
							<ul>
								<li>View the results of previous scheduled full audits</li>
								<li>Manually run a full audit on one or more devices</li>
								<li>Run a partial audit</li>
								<li>View the history of previously run partial audits.</li>
							</ul>
							<p>Users can sort basic audit log results by:</p>
							<ul>
								<li>IP Address</li>
								<li>Device Name</li>
								<li>Device Series</li>
								<li>Audit Run</li>
								<li>Market</li>
								<li>Current OS Version</li>
								<li>Region</li>
								<li>Audit Status</li>
								<li>Compliance Log Name</li>
							</ul>
							<h5 id="item-audit-0">Compliance</h5>
                            <p></p>
                            <img src="resources/img/screenshot-audit1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit1">
                            <p></p>
                            <span class="font-italic"><b>FIG. 9.1 - Compliance Audit Dashboard</b></span>
                            <p></p>
							<p>Once a user has chosen a device or devices for audit, a batch is created for processing. You can see the status of the batch at the end of the selection process after you click on the <b>Submit</b> button:</p>
							<p></p>
                            <img src="resources/img/screenshot-audit2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit2">
							<p></p>
							<span class="font-italic"><b>FIG. 9.1.1 - Audit Selection</b></span>
							<p></p>
							<p>A user will be redirected to the <a href="help_config.php#item-4-3">Batch Processing page</a> after clicking on the <b>Close</b> button. Here, you'll be presented with a screen showing the current status of the batch audit performed prior:</p>
                            <img src="resources/img/screenshot-audit3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit3">
                            <p></p>
							<span class="font-italic"><b>FIG. 9.1.2 - Audit Batch Status</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-audit-1">Customize Audit</h5>
							<p>Here, a user can run a partial audit.  The inputs are:
								<ul>
									<li>A string identifying  the top of the section to be audited</li>
									<li>The contents of the section to be audited</li>
									<li>Ignore additional configuration lines (Yes/No)</li>
								</ul>
							</p>
							<p>For example, suppose a user wants to validate the correct usernames included a configuration file for a device. S/he would do the following:
								<ol>
									<li>Enter “username” in the field that says &lt;Enter Section Header Or Search String&gt;</li>
									<li>Paste text of all the correct usernames, for example:
										<pre>username solkcpnebh privilege 15 secret 5 {{anystring}}
username njbbcpnebh privilege 15 secret 5 {{anystring}}
username PAMadmin privilege 15 secret 5 {{anystring}}</pre>
									</li>
									<li>Select whether to ignore additional lines found in the configuration file (Yes/No)</li>
									<li>Select the devices you want to run this partial audit on</li>
									<li>Click “Submit” button to run the batch job</li>
								</ol>
							</p>
                            <p></p>
                            <img src="resources/img/screenshot-audit4-1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit4-1">
                            <p></p>
                            <span class="font-italic"><b>FIG. 9.2 - Customized Audit Dashboard</b></span>
                            <p></p>
							<p>A user can filter the table results using the form fields for <b>Section Header</b> or a search string, a specific <b>Configuration Section</b> of a particular log file, and can also choose to ignore certain configuration lines in the results.</p>
							<p>All of these filtering options can be performed on just one log file or multiple sets of log files.</p>
							<p>Once a user sets the criteria for which they want to filter their audits to run on, they then choose specific audit logs to perform run filters on then click the <b>Submit</b> button. They are presented with a popup window that shows the Batch ID which they can then use to track the log request on the <a href="help_config.php#item-4-3">Batch Tracking page</a>.</p>
							<p></p>
							<p>To track the audit log customization, a user navigates to the Batch Tracking page and does a search within the table for the Batch ID created in the step earlier. Success/failure execution status will be shown here.</p>
							<p></p>
                            <img src="resources/img/screenshot-audit4-2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit4-2">
                            <p></p>
                            <span class="font-italic"><b>FIG. 9.2.2 - Custom Audit Batch Tracking Dashboard</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-audit-2">Customized Audit History</h5>
							<p>Here, a user can view the results of past customized audits on devices in their inventory. This dashboard does not present any real time information, but the <b>logs of customized audits previously performed</b>.</p>
							<p>Results can be sorted by:</p>
							<ul>
								<li>Batch ID</li>
								<li>User Name</li>
								<li>Region</li>
								<li>Market</li>
								<li>Device Name</li>
								<li>IP Address</li>
								<li>Device Series</li>
								<li>Filter Criteria</li>
								<li>Customized Audit Status</li>
								<li>Customized Audit Log Name</li>
								<li>Created Date</li>
							</ul>
							<p></p>
                            <img src="resources/img/screenshot-audit5.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-audit5">
                            <p></p>
                            <span class="font-italic"><b>FIG. 9.3 - Customized Audit History Dashboard</b></span>
                            <hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
                            <div class="row">
								<div class="col-6">
									<a href="help_tools.php" class="border"><b>&lt;&lt; PREV: Tools</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_inventory.php" class="border"><b>NEXT: Inventory &gt;&gt;</b></a>
								</div>
							</div>
							<hr>
<!-- /audit guide -->

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
		<div class="modal fade show" id="screenshot-audit1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit1.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit2.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit3.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit4.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit4-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit4-1.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit4-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit4-2.png" alt="" width="100%">
				</div>
			</div>
        </div>
		<div class="modal fade show" id="screenshot-audit5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-audit5.png" alt="" width="100%">
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
