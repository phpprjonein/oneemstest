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
							<?php include_once("help-nav.php");  ?>
						</div>
<!-- /help guide navigation -->

<!-- help guide -->
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />
							<h4 id="item-8">TOOLS</h4>
							<p>This view allows a user to access several tools for obtaining health information or managing CyberArk credentials.</p>
							<img src="resources/img/screenshot-tools-one.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-tools1">
							<p></p>
							<span class="font-italic"><b>Tools Page</b></span>
							<p></p>
                            <p><b>Reset CyberArk Password :</b> This will reset the cyberark accounts and PAM usernames on the device to a new password.</p>
                            <p><b>Check CyberArk Sync :</b> This will log in to device and return a PASS or FAIL message.</p>
                            <p><b>Show CyberArk  Password :</b> This will provide the user string required to log in to a device as PAMadmingrp via Cyberark. A user can copy the string to a buffer.</p>
                            <img src="resources/img/screenshot-tools-two.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-tools2">
							<p></p>
							<span class="font-italic"><b>Instant Health Check Dashboard Results for an ASR9K device</b></span>
							<p></p>
							<p><b>Run All Health Checks :</b> This will return the results of a full health check for a single device. For more details see section on “Run All Health Checks”.</p>
							<p></p>
							<p>This view allows a user to initiate a full health check on a specific device in the OneEMS network. A user can perform this search based on IPV4/IPV6 addresses OR device name.</p>
							<img src="resources/img/screenshot-tools-three.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-tools3">
							<p></p>
							<span class="font-italic"><b>Run All Health Checks Dashboard Results</b></span>
							<p></p>
							<p>This dashboard page returns the same results as a Health Check initiated for a device on the main Health Check page, but for a single device.</p>
							<p>This dashboard returns Health Check results based on the device type of the IP address or device name. ASR9K devices return results for parameters such as redundancy state, CPU utilization, memory utilization, software running on the RSP and others.</p>
							<img src="resources/img/screenshot-tools-four.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-tools4">
							<p></p>
							<span class="font-italic"><b>Run All Health Checks Dashboard Results For An ASR9K Device</b></span>
							<p></p>
							<p><b>Show Tech :</b> This will allow a user to select devices to add to a batch process for later scheduling.</p>
							<img src="resources/img/screenshot-tools-five.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-tools5">
							<p></p>
							<span class="font-italic"><b>Show Tech Batch Process Results Screen</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
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
        <div class="modal fade show" id="screenshot-tools1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-one.png" alt="" width="100%">
                </div>
            </div>
        </div>
        <div class="modal fade show" id="screenshot-tools2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-two.png" alt="" width="100%">
                </div>
            </div>
		</div>
		<div class="modal fade show" id="screenshot-tools3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-three.png" alt="" width="100%">
                </div>
            </div>
		</div>
		<div class="modal fade show" id="screenshot-tools4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-four.png" alt="" width="100%">
                </div>
            </div>
        </div>
		<div class="modal fade show" id="screenshot-tools5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-five.png" alt="" width="100%">
                </div>
            </div>
        </div>
		<div class="modal fade show" id="screenshot-tools6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <img src="resources/img/screenshot-tools-six.png" alt="" width="100%">
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
