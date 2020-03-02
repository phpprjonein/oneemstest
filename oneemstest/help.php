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
							<?php include_once("help-nav.php");  ?>
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
