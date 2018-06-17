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
//check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1 ) ? "Cell sitetechnician" : "";
  $username = $_SESSION['username'];
  $mesg = " User name: $username User type : $usertype Page:  Software Maintenance help page Description: User has navigated to the Software Maintenance help page.";
  write_log($mesg);

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<!-- <div class="container-fluid" id="cellsitech-config"> -->
    <div class="container-fluid">
	<?php include_once ('menu.php'); ?>
		<?php
        $values = array('Maintenance Help' => '#');
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
            <a class="nav-link help active" href="help_config.php">CONFIGURATION</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_config.php#item-4-1">Load Template</a>
              <a class="nav-link ml-3 my-1" href="help_config.php#item-4-2">Generate Script</a>
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
            <a class="nav-link" href="#item-7">MAINTENANCE</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-1">Software Upload - Master</a>
              <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-2">Software Upload</a>
              <a class="nav-link ml-3 my-1" href="help_maintenance.php#item-7-3">Software Delivery</a>
            </nav>
            <a class="nav-link" href="help_faqs.php">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- Maintenance help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />
        <h4 id="item-7">MAINTENANCE</h4>
        <p>This view allows a user to manage existing software configurations, create new configurations, retire existing configurations and/or apply these custom configurations to devices within the OneEMS network.</p>
        <h5 id="item-7-1">Software Upload - Master</h5>
        <img src="resources/img/screenshot-sw-master.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-sw-master1">
        <p></p>
        <span class="font-italic"><b>FIG. 7.1 - Software Master Dashboard</b></span>
        <p></p>
        <p>A user can define parameters for a device series type, vendor type, operating system versions (including the ability to set minimum build and/or patch versioning of a chosen OS), even set dates for software update activation.</p>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> This group of pages within the OneEMS application is only accesible by Cell Site Technicians.</p>
        <h5 id="item-7-2">Software Upload</h5>
        <img src="resources/img/screenshot-sw-os-repo.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-sw-os-repo">
        <p></p>
        <span class="font-italic"><b>FIG. 7.2 - Operating System Repository Dashboard</b></span>
        <p></p>
        <p>Here is where a user manages the existing list of software in the OneEMS repository. Operating Systems can be filtered by Vendor type and device series. Users can delete versions as needed also.</p>
        <img src="resources/img/screenshot-sw-os-repo2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-sw-os-repo2">
        <p></p>
        <span class="font-italic"><b>FIG. 7.2.1 - Operating System Retrieval</b></span>
        <p></p>
        <h5 id="item-7-3">Software Delivery</h5>
        <p>This screen allows users to apply specific preset software configurations to devices within the OneEMS network.</p>
        <img src="resources/img/screenshot-sw-delivery.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-sw-delivery">
        <p></p>
        <span class="font-italic"><b>FIG. 7.3 - Software Delivery Dashboard</b></span>
        <p></p>
        <p>Once you have selected a device or set of devices to apply a software configuration to, you will be presented with the <b>Batch Tracking</b> page:</p>
         <img src="resources/img/screenshot-sw-batch1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-sw-batch1">
        <p></p>
        <span class="font-italic"><b>FIG. 7.4 - Batch Tracking A Script Execution Request</b></span>
        <p></p>
        <p>Here, you will be able to monitor the progress of your Batch request. You can also cancel a batch request you've initiated prior.</p>
        <hr>
        <div class="row">
          <div class="col-6">
            <a href="help_discovery_results.php" class="border"><b><< PREV: Discovery Results</b></a>
          </div>
          <div class="col-6 text-right">
            <a href="help_faqs.php" class="border"><b>NEXT: FAQs >></b></a>
          </div>
        </div>

        <hr>
<!-- /Software -->

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
    <div class="modal fade show" id="screenshot-sw-master1" tabindex="-1"
      role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close img-close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <img src="resources/img/screenshot-sw-master.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-sw-os-repo" tabindex="-1"
      role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close img-close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <img src="resources/img/screenshot-sw-os-repo.png" alt=""
            width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-sw-os-repo2" tabindex="-1"
      role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close img-close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <img src="resources/img/screenshot-sw-os-repo2.png" alt=""
            width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-sw-delivery" tabindex="-1"
      role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close img-close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <img src="resources/img/screenshot-sw-delivery.png" alt=""
            width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-sw-batch1" tabindex="-1"
      role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="close img-close" data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <img src="resources/img/screenshot-sw-batch1.png" alt=""
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