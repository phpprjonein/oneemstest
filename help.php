<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
//check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
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
          <span class="navbar-brand d-none d-lg-block">CONTENTS</span>
          <nav class="nav nav-pills flex-column">
            <a class="nav-link help active" href="#item-1">GETTING STARTED</a>
            <a class="nav-link" href="help_network_elements.php">NETWORK ELEMENTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-2-1">List Management Options</a>
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-3">Health Check Details View</a>
            </nav>
            <a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="help_discovery_results.php#item-4">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-3">OK IP Addresses</a>
			  <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-4">Manual Discovery</a>
            </nav>
            <a class="nav-link" href="help_backup.php">BACKUP</a>
            <a class="nav-link" href="help_backup.php#item-6">CONFIGURATION</a>
            <a class="nav-link" href="help_faqs.php">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />
        <h4 id="item-1">GETTING STARTED</h4>
        <p>The One EMS application allows <b>users</b> to perform routine network device management tasks. Devices are grouped according to <b>Region</b> and further subdivided by <b>Markets</b>. Users are initially provided a default list of <b>Routers</b> (assigned in <b>Ops Tracker</b>). A user can also create customized lists of Routers. users can perform actions on each Router including; device health checks, manual discovery, on-demand backup / restore and generation of task specific scripts.</p>
        <p>To get started, a user <b><i>MUST</i></b> first complete the following prerequisites:</p>
        <ul>
          <li>obtain permission / access from supervisor (or from <b>CARMS</b> when available)</li>
          <li>have a single sign on account in <b>QTWIN</b> and <b>USWIN</b></li>
          <li>secure access to the <b>Verizon SSO</b> login screen</li>
        </ul>
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
	
	<!-- image modals -->
  <div class="big-modal">
    <div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-dashboard1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-map1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck3_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-1_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_Region-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_Region-2_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-missed" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-missed_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-new" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-new_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-ok" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-ok_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-config1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-config1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

<!-- footer div -->
      <span class="text-muted"><?php include ('footer.php'); ?> </span>
<!-- /footer div -->

    </body>
</html>
