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
$mesg = " User name: $username User type : $usertype Page:  Network Elements Help page Description: User has navigated to the Network Elements help page.";
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
    'Network Elements Help' => '#'
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
							<?php include_once("help-nav.php");  ?>
						</div>
<!-- /help guide navigation -->

<!-- Network Elements -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-2">NETWORK ELEMENTS</h4>
							<p>All user Types are presented with the <b>List Management Dashboard</b>. This particular Dashboard allows for  users to:
							<ul>
								<li>Create custom device lists</li>
								<li>Edit saved device lists</li>
								<li>View devices associated with a specific switch</li>
							</ul>
							</p>
							<p>This List Management screen allows for the user to create lists of devices that s/he can use in other screens  within the OneEMS application.</p>
							<p><a href="#item-2-3">Click here</a> for more detailed information about device health individual Dashboard  views.</p>
							<h5 id="item-2-2-1">List Management Options</h5>
							<img src="resources/img/screenshot-dashboard1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-dashboard1">
							<p></p>
							<span class="font-italic"><b>One EMS Dashboard</b></span>
							<p></p>
							<p>Here, a user can create custom lists of devices associated with the device(s) they are assigned.</p>
							<p>In addition, a <b>“NA Field Assurance”</b> user will be provided a default <b>“My Routers”</b> option on the left.  Clicking on <b>“My Routers”</b> will take the user to the health page (see <a href="item-2-3"">Health Check Details View section</a> for more info) containing a list of routers assigned to the user (source is IOP).</p>
							<p>For a <b>“NA System Assurance”</b> user a list of Switch names will be provided on left side that are associated with the user (source is IOP).</p>
							<p>All users will also be provided a list of associated callout zones on left also.</p>
							<b>List Creation</b>
							<p>To create a <b>Device List</b>, enter a name in the input field under the <b>List Management</b> heading, then  click the "Submit" button next to this input field.</p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> Your Device List title <b><i>MUST</i></b> be a combination of alphanumeric  characters of no more than 20 characters.</p>
							<p>Your created Device List will appear under the <b>My Device List</b> heading.</p>
							<p>From here, you may open your lists for editing, view their contents, delete them altogether or add devices to them.</p>
							<b>Selecting Devices</b>
							<p>The right side list  is for listing Routers by Region and Market. The map above this list is  sectioned off into different areas. Each similarly colored set of states represents a Region, and within each Region are individual Markets. Once you've chosen a Market, you will then be presented with a list of devices that are associated with a switch in that market.</p>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> <b>NA Field Assurance Users</b> will only be permitted to view devices assigned to them, devices assigned to their callout zones and devices associated with  their switch(es).  The map has been disabled.
							<br>
							<br>
							<b>NA Systems Assurance Users</b> will only be permitted to view the switches and associated devices assigned to  them. The map will be enabled for only those markets that contain an assigned switch.</p>
							<p>&nbsp;</p>
							<img src="resources/img/screenshot-map1.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-map1">
							<p></p>
							<span class="font-italic"><b>One EMS Regional Map</b></span>
							<p></p>
							<b>Adding A Device To Your Custom List</b>
							<p>In order to add devices to your list, first open a list for editing. To do this, click on the <b>Edit icon</b> ( <i class="fa fa-edit fa-lg text-primary"></i> ) to the immediate right of the list name. The contents of the selected list will appear in the center column of the page.</p>
							<p>Next, select a Region and subsequent Market from the map. This will display the devices associated with these areas.</p>
							<p>You can then drag and drop using the <b>Drag icon</b> ( <i class="fa fa-arrows-alt"></i> ) to bring any  selected devices into the <b>Edit List</b> section column on the immediate left of the map Region. This will add these devices to your list and make them available for management in various areas of the application.</p>
							<b>Deleting A Device From Your Custom List</b>
							<p>To remove a device from your created list, simply use the drag icon to drag and drop it over the trash icon (  <i class="fa fa-trash fa-lg text"></i> ) inside the <b>Delete</b> button. Once you confirm this action, this will  remove this device from the list. You may add it again by repeating the process of dragging it into the <b>Edit  List</b> area from the list of devices under the map.</p>
							<b>Viewing The Health Of Devices In A Custom List</b>
							<p>To view the health of the devices within your selected <b>Device List</b>, click on the list name. You will  then be presented with the Health Check Dashboard view of all the devices in your selected list.</p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-2-3">Health Check Details View</h5>
							<p class="alert alert-danger"><b class="text-danger">NOTE:</b> NA Field Assurance Users will be provided a <b>"My Routers"</b> List. This List contains Routers that are assigned to the NA Field Assurance Users via <b>Ops  Tracker</b>. NA Systems Assurance Users will be provided a list of Switch names that are associated with him/her.</p>
							<p>Here, a user can view the health status of devices associated with a List created on the <b>Network Elements</b> page. Various device health parameters are exposed in this view. This affords the user the ability to monitor multiple devices at a glance.</p>
							<img src="resources/img/screenshot-healthcheck1.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-healthcheck1">
							<p></p>
							<span class="font-italic"><b>Health Check Dashboard</b></span>
							</p>
							<p></p>
							<p>This screen gives the user a Dashboard table view of all the devices in a certain List, along with the ability  to drill down and view multiple separate health checks:</p>

<!-- Health Check description accordion -->
							<div class="row">
								<div class="col">
									<div id="accordion">

<!-- asr9k specific checklist -->
										<div class="card">
											<div class="card-header" id="headingOne">
												<h5 class="mb-0 table-responsive">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">ASR9000 specific health checks</button>
												</h5>
											</div>
											<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
												<div class="card-body">
												<div class="container">
													<div class="row">
													<div class="col">
														<ul>
															<li>Redundancy state</li>
															<li>CPU utilization</li>
															<li>Memory utilization</li>
															<li>Software running on the RSP</li>
															<li>Software installed and active</li>
															<li>Software installed and committed</li>
															<li>Alarms</li>
															<li>Power supply</li>
															<li>Line card status</li>
															<li>Fabric Status</li>
															<li>Fabric interface ASIC drops</li>
															<li>Fabric interface ASIC errors</li>
															<li>Fabric Interface ASIC link-status</li>
															<li>Up/down status</li>
														</ul>
													</div>
													<div class="col">
														<ul>
															<li>Interface counters</li>
															<li>BFD session</li>
															<li>VRRP</li>
															<li>NTP</li>
															<li>Global OSPF neighbors</li>
															<li>1XRTT OSPF Neighbor</li>
															<li>CELL_MGMT OSPF Neighbor</li>
															<li>OSPF NSR and GR</li>
															<li>LDP neighbors</li>
															<li>WDN peering</li>
															<li>CSR peering</li>
															<li>CRS WDN peering</li>
															<li>CRS LTE peering</li>
															<li>BGP NSR and Graceful Restart</li>
															<li>Air Filter Check</li>
														</ul>
													</div>
													</div>
												</div>
												</div>
											</div>
										</div>
<!-- asr9k specific checklist -->

<!-- other cheklists -->
										<div class="card">
											<div class="card-header" id="headingTwo">
												<h5 class="mb-0 table-responsive">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Other health checks</button>
												</h5>
											</div>
											<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
												<div class="card-body">
												<div class="container">
													<div class="row">
													<div class="col">
														<ul>
															<li>IOS Versioning</li>
															<li>Buffers</li>
															<li>Environmental States</li>
															<li>2000 Byte Ping Status/Success Rates</li>
															<li>VRF</li>
															<li>MultiProtocol Label Switching Interfaces</li>
															<li>MultiProtocol Label Switching Neighbors</li>
															<li>CPU Utilization</li>
															<li>Boot Statement</li>
															<li>Config Registration</li>
														</ul>
													</div>
													<div class="col">
														<ul>
														<li>Bidirectional Forwarding Detection Sessions</li>
															<li>Interface State</li>
															<li>IPV4 BGP Neighbors</li>
															<li>IPV6 BGP Neighbors</li>
															<li>Free Memory</li>
															<li>Platform</li>
															<li>Interface Counters</li>
															<li>Log Entries</li>
															<li>X Connect</li>
															<li>IPV4 BGP Routes</li>
															<li>IPV6 BGP Routes</li>
														</ul>
													</div>
													</div>
												</div>
												</div>
											</div>
										</div>
<!-- other cheklists -->

									</div>
									<hr>
								</div>
							</div>
<!-- /Health Check description accordion -->

							</p>
							<b>Cyber Ark Command Generation</b>
							<p>Click on the device name (which is a link to the Cyber Ark Syntax). You will be presented with syntax that  you can copy to a buffer and use it to ssh in to the device.</p>
							<img src="resources/img/screenshot-healthcheck2-1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck2-1">
							<p></p>
							<span class="font-italic"><b>Cyber Ark Commands For Copying</b></span>
							<p></p>
							<p>In order to add devices to your list, first open a list for editing. To do this, click on the <b>Edit icon</b> ( <i class="fa fa-edit fa-lg text-primary"></i> ) to the immediate right of the list name. The contents of the selected list will appear in the center column of the page.</p></p>
							<p>To view the health of a specific device, click on the plus icon ( <i class="fa fa-plus-circle fa-lg  text-primary"></i> ) on the leftmost column of the device. This will present the results of the last run of  health checks on the device in view.</p>
							<img src="resources/img/screenshot-healthcheck2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck2">
							<p></p>
							<span class="font-italic"><b>Refreshing An Individual Health Check</b></span>
							<p></p>
							<p>You can choose to run any of the health checks from the list by selecting the corresponding check  boxes and then clicking on “Run Selective Health Checks” or you can “Run All Health Checks”.</p>
							<p>Once this real-time health check is done, you will be presented with a brief summary for each check. You will  be able to click on the page icons ( <i class="fa fa-file-text-o text-primary"></i> ) associated with each parameter to view output directly from the console of the currently selected device.</p>
							<p>You will then see the specific command that was run on the devices and the corresponding output response.</p>
							<img src="resources/img/screenshot-healthcheck3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck3">
							<p></p>
							<span class="font-italic"><b>Device Console Output View</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help.php" class="border"><b><< PREV: Getting Started</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_backup.php" class="border"><b>NEXT: Backup >></b></a>
								</div>
							</div>
							<hr>
						</div>
<!-- /Network Elements -->

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
		<div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-dashboard1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-map1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-healthcheck1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-healthcheck2.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-healthcheck2-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-healthcheck2-1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-healthcheck3.png" alt="" width="100%">
				</div>
			</div>
		</div>
	</div>
<!-- /image modals -->

<!-- footer div -->
	<span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

</body>
</html>
