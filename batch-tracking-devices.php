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

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script
	src="resources/js/batch_tracking_devices.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<!-- The Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content" id="cellsitech-backuprestore">

				<!-- Modal Header -->
				<div class="modal-header" id="restoremodalhdr">
					<h5 class="modal-title text-center" id="modalLabelLarge">
						<span id="restoremodalhdrtxt"><strong>Back up to be restored - <span
								id="bkup-fileid"></span></strong></span>
					</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body"></div>
				<!--  <input type="text" style="display:none;" id="model-body-txt" value="">  -->
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" id="copybtn" style="display: none;"
						class="btn btn-secondary">Copy</button>
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- The Modal -->
	<div class="modal fade" id="backupModal">
		<div class="modal-dialog">
			<div class="modal-content" id="cellsitech-backup">

				<!-- Modal Header -->
				<div class="modal-header" id="backupmodalhdr">
					<h5 class="modal-title">
						<span id="backupmodalhdrtxt"><strong>Back up device details <span
								id="bkup-deviceid"></span></strong></span>
					</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body"></div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-default">Cancel</button>
				<button type="button" class="btn btn-default">Continue</button>
				-->
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
            <?php include_once ('menu.php'); ?>
			<?php
$values = array(
    'Batch Tracking' => '#'
);
echo generate_site_breadcrumb($values);
?>
            <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-info">
							<div class="btn-group" id="batchtype-dt-filter">
								<button type="button" style="text-transform: none;"
									class="btn dropdown-toggle" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">Script Execution</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Script Execution</a> <a
										class="dropdown-item" href="#">Software Delivery</a>
								</div>
							</div>
							<p id="cp1" style="display: none"></p>
							<input type="hidden" id='userid' value="<?php echo $userid ?>"
								name="">
							<div class="panel-body">
								<table id="devicebatchtrack"
									class="table table-striped table-sm">
									<thead>
										<tr>
											<th class="noExport">Batch details</th>
											<th>Batch id</th>
											<th>Script Name</th>
											<th>Device series</th>
											<th>Device os</th>
											<th>Created date</th>
											<th>Status</th>
											<th>Cancel</th>
										</tr>
									</thead>
								</table>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
			
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

        <?php include_once ('footer.php'); ?>
    </body>
</html>