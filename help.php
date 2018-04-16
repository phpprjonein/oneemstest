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
          <li>secure access to the <b>NCM SSO</b> login screen</li>
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

<!-- footer div -->
      <span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

    </body>
</html>
