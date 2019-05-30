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
						<div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
							<hr class="d-md-none" />

<!-- admin -->
                            <h4 id="item-9">ADMIN</h4>
                            <p>Admin users will be taken to this page first. They have the option of impersonating a user or   maintaining software binaries available to the user community.</p>
                            <img src="resources/img/screenshot-admin1.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-admin1">
							<p></p>
							<span class="font-italic"><b>Software Delivery – Selecting Binary And Remote Device(s)</b></span>
							<p></p>
							<h5 id="item-9-1">Load Template - Golden</h5>
							<p>Admin users are presented with a similar page and flow as all other users when configuring templates, with the key exception being that admin users are allowed to configure Golden templates.</p>
							<img src="resources/img/screenshot-load_template_mod2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin1-1">
							<p></p>
							<span class="font-italic"><b>Configuration Dashboard With Sample Values Selected (Administrative Users)</b></span>
							<p><a name="loadGolden"></a></p>
							<img src="resources/img/screenshot-load_template_mod2-1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin1-2">
							<p></p>
							<span class="font-italic"><b>File Upload</b></span>
							<p></p>
							<img src="resources/img/screenshot-load_template_mod2-2.png" class="img-fluid" alt="" data-toggle="modal"  data-target="#screenshot-admin1-3">
							<p></p>
							<span class="font-italic"><b>Configurable Template</b></span>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-9-2">Maintenance</h5>
							<p>Software Upload is a four step process.</p>
							<ol>
								<li>A OneEMS administrator or superuser pulls an official binary from the vendor site and loads it on to his/her laptop. This step is beyond the scope of OneEMS.</li>
								<li>An administrator or superuser uploads an official binary from their laptop to the OneEMS repository using the <b>Maintenance->Device Binary</b> page (<a href="#loadGolden">here</a>).</li>
								<li>An administrator or superuser associates a binary in the OneEMS repository with a vendor and device series (<a href="#binaryListing">here</a>).
								<p></p>
								<p class="alert alert-danger"><b class="text-danger">NOTE:</b> This metadata gets stored in the OneEMS database. Once this step is completed, then <b>all users</b> will be able to see this binary and complete a software delivery to a specified device.</p>
								</li>
								<li>Any user can delivery a binary to a device via the <b>Maintenance->Software Delivery</b> tab (<a href="help_maintenance.php#selectBinary">here</a>).</li>
							</ol>
							</p>
							<img src="resources/img/screenshot-admin3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin3">
							<p></p>
                            <span class="font-italic"><b>Uploading A New Binary Into OneEMS</b></span>
                            <p></p>
							<img src="resources/img/screenshot-admin4.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin4">
							<p></p>
                            <span class="font-italic"><b>- Existing Binary Listing</b></span>
                            <p></p>
							<p>This page permits user to upload a new binary to the OneEMS OS repository. This makes the binary available to users who wish to deliver a binary to a device. Select Vendor and device series on left. Then, select binary file on right and click “Submit”.</p>
							<p>If you wish to view binaries already loaded to the OS repository, select file name from the list then click the “Retrieve” button. You will get a popup with the list of existing binaries.</p>
							<img src="resources/img/screenshot-admin5.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin5">
							<p><a name="binaryListing"></a></p>
                            <span class="font-italic"><b>- Binary Retrieval Results</b></span>
                            <p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<h5 id="item-9-3">Device Cleanup</h5>
							<p>This view allows an administrative user to remove records for a specific device or set of devices in the OneEMS network that may represent irrelevant duplicates.</p>
							<p>Admins can filter these records based on combinations of IPV4/IPV6 addresses or Site IDs, and can sort the resulting records by any of those same paramaters including device name.</p>
							<img src="resources/img/screenshot-admin6.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-admin6">
							<p></p>
							<span class="font-italic"><b>Device Cleanup</b></span>
							<p></p>
							<p></p>
							<hr>
							<a href="#top" class="border"><b>Back to top</b></a>
							<hr>
							<div class="row">
								<div class="col-6">
									<a href="help_inventory.php" class="border"><b><< PREV: Inventory</b></a>
								</div>
								<div class="col-6 text-right">
									<a href="help_faqs.php" class="border"><b>NEXT:  FAQs >></b></a>
								</div>
							</div>
							<hr>
							<p>&nbsp;</p>
<!-- /admin -->

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
		<div class="modal fade show" id="screenshot-admin1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-admin1-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod2.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-admin1-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod2-1.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-admin1-3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-load_template_mod2-2.png" alt="" width="100%">
				</div>
			</div>
        </div>
        <div class="modal fade show" id="screenshot-admin2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin2.png" alt="" width="100%">
				</div>
			</div>
        </div>
        <div class="modal fade show" id="screenshot-admin3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin3.png" alt="" width="100%">
				</div>
			</div>
        </div>
        <div class="modal fade show" id="screenshot-admin4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin4.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-admin5" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin5.png" alt="" width="100%">
				</div>
			</div>
		</div>
		<div class="modal fade show" id="screenshot-admin6" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<button type="button" class="close img-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<img src="resources/img/screenshot-admin6.png" alt="" width="100%">
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