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
$mesg = " User name: $username User type : $usertype Page:  FAQs Help page Description: User has navigated to the FAQs help page.";
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
    'FAQs Help' => '#'
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

<!-- help guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example"
							data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />

<!-- FAQs -->
							<h4 id="item-10">FAQs</h4>
							<div id="accordion">

								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"  aria-controls="collapseOne">How do I gain access to the OneEMS application?</button>
										</h5>
									</div>
									<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											<p>In order to access the OneEMS application, a user must have:</p>
											<ul>
												<li>obtained permission / access from supervisor (or from <b>CARMS</b> when available)</li>
												<li>a single sign on account in <b>USWIN</b></li>
												<li>access to the <b>Verizon SSO</b> login screen </li>
											</ul>
											<p>Please see your supervisor or administrative body to obtain this access.</p>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingTwo">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"  aria-controls="collapseTwo">A specific device I'm looking for isn't showing up. How do I fix this?</button>
										</h5>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="card-body">
											<p>Devices are made available to the OneEMS application via <b>Ops Tracker</b>. Each device is categorized by its  name, associated site number, switch name and site name. If one or more of these criteria are not met, it is  entirely possible that <b>Ops Tracker</b>'s database does not contain the specific device in question.</p>
											<p>Please contact your administrator or supervisory body for more information regarding adding more devices.</p>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingThree">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Where do I view ALL the devices I'm assigned to?</button>
										</h5>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="card-body">
											<p>The <a href="help_network_elements.php">Network Elements Dashboard</a> exposes all the devices assigned to a specific user as per the <b>OpsTracks</b> database.</p>
											<p class="alert alert-danger"><b class="text-danger">NOTE:</b> For NA Field Assurance Users, the <b>My Routers</b> list on the <b>Network  Elements Dashboard</b> contains routers assigned to a specific user by <b>Ops Tracker</b>.</p>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingFour">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">How do I add more devices to the OneEMS Application?</button>
										</h5>
									</div>
									<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
										<div class="card-body">
											<p>The OneEMS application allows for addition of devices to the network from the <a href="help_discovery_results.php#manualDiscovery">Discovery Results Dashboard</a> in order to rediscover devices that may have been newly added to the IOP database.</p>
											<p>Once a user has found a device s/he would like to add, they would click on the <b>SAVE</b> button on the <b>Manual Discovery</b> results screen. This adds to the device to any future results sets that a user may perform OneEMS-supported queries on within the application.</p>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingFive">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">A Dashboard screen I'm working in doesn't look right/work properly. How do I fix this?</button>
										</h5>
									</div>
									<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
										<div class="card-body">
											<p>The <a href="#browserOSMatrix">Browser / OS Support Matrix</a> below shows the currently supported configurations that the OneEMS Application works in. You must have <b>BOTH</b> a supported operating system  <b>AND</b> a supported browser to view this application. Using browsers and operating systems besides the ones  listed as supported below will produce unintended results in terms of layout and/or functionality.</p>
											<p>Currently, no version of Internet Explorer earlier than V.11 is supported by this application.</p>
											<p>Please see your system administrator or other supervisory body to ensure compliance with this Browser / OS Support Matrix.</p>
											<p>You may be zoomed in to a higher percentage than usual in your browser. To rectify this, press <kbd>Ctrl +  0</kbd> ( <kbd>Command + 0</kbd> in iOS) to reset the zoom percentage in your browser to 100%.</p>
											<p>Additionally, you may visit <a href="https://updatemybrowser.org" target="_blank">https://updatemybrowser.org</a> to check if your browser is current.</p>
											<p class="alert alert-danger"><b class="text-danger">NOTE:</b> Please contact your system administrator or other  supervisory body in order to  assure that whatever device you are using this application on is equipped with one of the supported browser /  OS combinations listed below.</p>

<!-- browser/OS support table -->
											<div class="table-responsive">
												<table class="table table-sm table-hover table-bordered" id="browserOSMatrix">
													<thead class="thead-dark">
														<tr>
															<th scope="col">Operating System</th>
															<th scope="col">IE8</th>
															<th scope="col">IE9</th>
															<th scope="col">IE10</th>
															<th scope="col">IE11</th>
															<th scope="col">Edge</th>
															<th scope="col">Chrome (60+)</th>
															<th scope="col">Firefox (56+)</th>
															<th scope="col">Opera (45+)</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">Windows XP</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
														</tr>
														<tr>
															<th scope="row">Windows Vista SP2</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">Windows Server 2012</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">Windows 7</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">Windows 8.1</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">Windows 10</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">macOS Sierra</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
														<tr>
															<th scope="row">macOS High Sierra</th>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>No</td>
															<td>Yes</td>
															<td>Yes</td>
															<td>Yes</td>
														</tr>
													</tbody>
												</table>
											</div>
<!-- /browser/OS support table -->

										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingSix">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">How can I make a PuTTY window popup automatically to log in to a device?</button>
										</h5>
									</div>
									<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
										<div class="card-body">
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
							<p><b>ssh://”win-vzwnet user id”@PAMadmingrp@”IPv6 address”@pamssh.nsiam.vzwnet.com</b></p>
							<p>When prompted, enter your win-vzwnet password.</p>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingSeven">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">What is the pass criteria for each health check?</button>
										</h5>
									</div>
									<div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
										<div class="card-body">
											<p>The <a href="help_network_elements.php#item-2-3">health check dashboard</a> functionality runs specific commands against specific devices in order to determine their viability.</p>
											<p>The criteria by which a device passes these health checks is shown in the table below along with the actual commands that trigger the associated check.</p>

<!-- browser/OS support table -->
											<div class="table-responsive">
												<table class="table table-sm table-hover table-bordered" id="browserOSMatrix">
													<thead class="thead-dark">
														<tr>
															<th scope="col">Health Check</th>
															<th scope="col">Raw Command</th>
															<th scope="col">Output Summary</th>
															<th scope="col">Pass Criteria</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th scope="row">2000 Byte Ping</th>
															<td><pre>ping <bfd neighbor1> size 2000
ping <bfd neighbor2> size 2000</pre></td>
															<td>success rate = X percent</td>
															<td>5/5 success rate</td>
														</tr>
														<tr>
															<th scope="row">Bandwidth</th>
															<td><pre>show run int gigabitEthernet0/0/0
sh int Gi0/0/0</pre></td>
															<td>bandwidth = A;
port utilization:
input rate = B bits/sec,
output rate = C bits/sec,
D packets/sec</td>
															<td>Display the current configured Bandwidth and current Utilization</td>
														</tr>
														<tr>
															<th scope="row">BFD Sessions</th>
															<td><pre>show bfd neighbor</pre></td>
															<td>down neighbors = X</td>
															<td>all neighbors are up/up</td>
														</tr>
														<tr>
															<th scope="row">BGPv4 Routes</th>
															<td><pre>show ip bgp vpnv4 vrf &lt;RAN,1xrtt,cell_mgmt&gt;</pre></td>
															<td>1xrtt=X,cell_mgmt:Y,ran:Z</td>
															<td>number of default gateways >= 2</td>
														</tr>
														<tr>
															<th scope="row">BGPv4 Routes</th>
															<td><pre>show ip bgp vpnv6 unicast vrf LTE</pre></td>
															<td>BGPv6 Routes = X</td>
															<td>number of default gateways >= 2</td>
														</tr>
														<tr>
															<th scope="row">Boot Statement</th>
															<td><pre>show running | i boot</pre></td>
															<td>Boot statement matches version</td>
															<td>first boot statement in running config = currently running IOS version</td>
														</tr>
														<tr>
															<th scope="row">Buffers</th>
															<td><pre>show buffers</pre></td>
															<td>Max Buffer misses = X</td>
															<td>all buffers <= 300 misses each AND “no memory” fails = 0 for Huge pool</td>
														</tr>
														<tr>
															<th scope="row">Config Register</th>
															<td><pre>show version | i Config</pre></td>
															<td>0x2102</td>
															<td>configuration register = 0x2102 OR (will be at next reload) = 0x2102</td>
														</tr>
														<tr>
															<th scope="row">CPU Utilization</th>
															<td><pre>show processes cpu</pre></td>
															<td>5s=x%,1m=y%,5m=x%</td>
															<td>5min utilization <= 70%</td>
														</tr>
														<tr>
															<th scope="row">Environmental</th>
															<td><pre>show environment</pre></td>
															<td>Total alarms = X</td>
															<td>Critical + Major + Minor alarms = 0</td>
														</tr>
														<tr>
															<th scope="row">Free Memory</th>
															<td><pre>show memory statistics</pre></td>
															<td>Free Memory  X (bytes)</td>
															<td>> 500MB</td>
														</tr>
														<tr>
															<th scope="row">Interface Counters</th>
															<td><pre>show interfaces</pre></td>
															<td>Interface Counters = X</td>
															<td>None</td>
														</tr>
														<tr>
															<th scope="row">Interface State</th>
															<td><pre>show ip interface brief </pre></td>
															<td>Interfaces down = X</td>
															<td>no interfaces are down (unless they are admin down or in the ‘ignore list’)</td>
														</tr>
														<tr>
															<th scope="row">IOS Version</th>
															<td><pre>show version</pre></td>
															<td>X (version)</td>
															<td>current version = “Expected IOS Version” in Health Check Options</td>
														</tr>
														<tr>
															<th scope="row">IPv4 BGP Neighbors</th>
															<td><pre>show ip bgp vnpv4 all summary</pre></td>
															<td>BGPv4 Neighbors = X</td>
															<td>number of neighbors >= 2 and neighbor is not ‘idle’ or ‘active’ </td>
														</tr>
														<tr>
															<th scope="row">IPv6 BGP Neighbors</th>
															<td><pre>show ip bgp vpnv6 unicast all summary</pre></td>
															<td>BGPv6 Neighbors = X</td>
															<td>number of neighbors >= 2 and neighbor is not ‘idle’ or ‘active’</td>
														</tr>
														<tr>
															<th scope="row">Log Entries</th>
															<td><pre>show logging</pre></td>
															<td>Buffer Logging : X Trap Logging: Y</td>
															<td>number of logs in each category < threshold set in “Health Check Options” ></td>
														</tr>
														<tr>
															<th scope="row">MPLS Interfaces</th>
															<td><pre>show mpls interfaces</pre></td>
															<td>Number of failed interfaces = X</td>
															<td>all interfaces have ‘Yes (ldp)’ under Ip column and “Yes” under Operational column Fail</td>
														</tr>
														<tr>
															<th scope="row">MPLS Neighbors</th>
															<td><pre>show mpls ldp neighbor</pre></td>
															<td>MPLS LDP neighbors = X</td>
															<td>ldp neighbors >= 2 (or 1 if gi0/0/0 is down) and all ldp neighbors have bound IP addresses</td>
														</tr>
														<tr>
															<th scope="row">Platform</th>
															<td><pre>show platform</pre></td>
															<td>All slots OK</td>
															<td>State contains 'ok' for every slot</td>
														</tr>
														<tr>
															<th scope="row">VRF</th>
															<td><pre>show ip vrf interface</pre></td>
															<td>Interfaces down = X</td>
															<td>no interfaces are down (unless they are admin down or in the ‘ignore list’)</td>
														</tr>
														<tr>
															<th scope="row">Xconnect</th>
															<td><pre>show xconnect all</pre></td>
															<td>All OK</td>
															<td>all xconnects are “UP”</td>
														</tr>
													</tbody>
												</table>
											</div>
<!-- /browser/OS support table -->

										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-header" id="headingEight">
										<h5 class="mb-0 table-responsive">
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">I have an issue or question that isn't addressed here in these FAQ<span style="text-transform: lowercase;">s</span>...</button>
										</h5>
									</div>
									<div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
										<div class="card-body">
											<p>On <i>every</i> page of the OneEMS application, there is an option to raise a <b>JIRA Ticket</b> by clicking the persistent "<b>OPEN TICKET</b>" button at the bottom of the screen.</p>
											<img src="resources/img/screenshot-jira-button-link.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-jira-button-link">
											<p></p>
											<span class="font-italic"><b>JIRA Ticketing Button</b></span>
											<p></p>
											<p>Upon clicking this button, you will be redirected to an external JIRA ticketing system, where you can open a  ticket relevant to an issue you may be having with the OneEMS application. There, you can relay all the pertinent information that applies to your issue.</p>
										</div>
									</div>
								</div>


							</div>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_admin.php" class="border"><b><< PREV: Admin</b></a>
								</div>
								<div class="col-6 text-right"></div>
							</div>
							<hr>
							<p>&nbsp;</p>
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
		<div class="modal fade show" id="screenshot-jira-button-link" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-jira-button-link.png" alt="" width="100%">
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
