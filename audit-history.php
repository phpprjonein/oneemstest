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
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Software Delivery page Description: Cell Site Tech has navigated to the Software Delivery page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("includes.php");  ?>
<script
	src="resources/js/audit_history.js?t=<?php echo date('his'); ?>"></script>
</head>
<body class="audit-history">
        <!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="manual-device-discovery">

					<!-- Modal Header -->
					<div class="modal-header" id="restoremodalhdr">
						<h5 class="modal-title text-center" id="modalLabelLarge"></h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body"></div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
							data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	<div class="container-fluid sw-delivery-devices">
    <?php include_once ('menu.php'); ?>
      <?php
    $values = array(
        'Customize Audit History' => '#'
    );
    echo generate_site_breadcrumb($values);
    ?>

<!-- Content Wrapper. Contains page content -->
		<div class="content">


			<div class="modal fade" id="batchModal">
				<div class="modal-dialog">
					<div class="modal-content" id="batchModalContent">

						<!-- Modal Header -->
						<div class="modal-header" id="backupmodalhdr">
							<h5 class="modal-title">Batch Success</h5>
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<!-- /Modal Header -->

						<!-- Modal body -->
						<div class="modal-body">
        			  Please do keep track the status on Batch Page
                     <?php $batchid = time(); ?>
                     <br>Batch ID : <?php echo $batchid; ?></b> <input
								type="hidden" value="<?php echo $batchid; ?>" id="batchid" />
						</div>
						<!-- /Modal body -->

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
						<!-- /Modal footer -->

					</div>
				</div>
			</div>

			<!-- Main content -->
			<section class="content" id="sw-delivery-devices">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>

					<!-- backup management content row -->
					<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2"
						action='generate-post-script.php' method='POST'
						enctype='multipart/form-data' novalidate autocomplete="on">

						<div class="row">

							<!-- right side -->
							<!-- script output -->
							<div class="col-sm-12 col-md-12" id="listname-dd">
								<div class="row">
									<div class="col">
										<input type="hidden" value="" name="cbvals" id="cbvals" />
										<table id="auditinglog" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th>Batch&nbsp;ID</th>
													<th>User&nbsp;Name</th>
													<th>Device&nbsp;Name</th>
													<th>IP&nbsp;Address</th>
													<th>Market</th>
													<th>Device&nbsp;Series</th>
													<th>Region</th>
													<th>Filter&nbsp;Criteria</th>
													<th>Status</th>
													<th>Customized&nbsp;Audit&nbsp;Log</th>
													<th>Created&nbsp;date</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<!-- /template name content -->
								<p>&nbsp;</p>
								<!-- /right side -->

							</div>
							<!-- /script output -->

							<!-- /backup management content row -->
						</div>
					</form>
			
			</section>
		</div>
		<!-- /.content -->

	</div>
	<!-- container-fluid -->

<?php include_once ('footer.php'); ?>
</body>
</html>
