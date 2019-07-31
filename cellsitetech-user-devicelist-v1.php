<?php
ini_set('display_errors', 1);
include "classes/db2.class.php";
include 'functions.php';
include 'PiwikTracker.php';
user_session_check();
/**
 * Device Search section
 */
if ($_SESSION['userid'] && isset($_POST['search_term']) && trim($_POST['search_term']) != '') {
    $_SESSION['search_term'] = $_POST['search_term'];
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$listid = $_GET['listid'];
// $device_list = get_device_list_from_nodes($_SESSION['userid']);
$title = get_user_mylist_name_by_id($listid, $userid);
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Health Check (cell site technician) page Description: Cell Site Tech has executed Health Check.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
 <script
	src="resources/js/cellsitetech_user_dash_devices_v1.js?t=<?php echo date('his'); ?>"></script>
<script type="text/javascript">
function modalClose() {
    if (location.hash == '#mycmdModal') {
        location.hash = '';
    }
}

document.addEventListener('keyup', function(e) {
    if (e.keyCode == 27) {
        modalClose();
    }
});

var modal = document.querySelector('#mycmdModal');
modal.addEventListener('click', function(e) {
    modalClose();
}, false);

modal.children[0].addEventListener('click', function(e) {
    e.stopPropagation();
}, false);
 </script>
</head>
<body class="hold-transition skin-blue sidebar-mini ownfont"
	id="healthpage">
	<!-- Modal HTML -->
			<!-- https://codepen.io/shaikmaqsood/pen/XmydxJ/ -->
    	<div id="Modal_Device_Name" tabindex="-1" class="modal fade"
    		role="dialog" aria-hidden="true">
    		<div class="modal-dialog modal-lg" role="document">
    			<!-- Modal content-->
    			<div class="modal-content">
    				<div class="modal-header">
    					<h5 class="modal-title"></h5>
    					<button type="button" class="close" data-dismiss="modal"
    						aria-label="Close">
    						<span aria-hidden="true">&times;</span>
    					</button>
    				</div>
    				<div class="modal-body">
    				</div>
    				<div class="modal-footer">
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    
    		</div>
    	</div>
	<div class="modal fade" id="healthpageModel">
		<div class="modal-dialog">
			<div class="modal-content" id="cellsitech-backup">
				<!-- Modal Header -->
				<div class="modal-header" id="backupmodalhdr">
					<h5 class="modal-title">Audit Log</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body modal-content" style="min-height: 125px;"></div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary"
						data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
            <?php include ('menu.php'); ?>
            <?php
            $values = array(
                'Health Check' => '#'
            );
            echo generate_site_breadcrumb($values);
            ?>

            <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12" id="multidevicehc">
					<div id="status" style="display: none;" class="alert"></div>
					<div class="panel">
						<div class="panel-info panel-default">
							<!-- Page title -->
							<div class="panel-heading panel-heading-myswtlst"> <?php if ($title['listname'] === "0" ) echo 'My Routers ('.$title['count'].')'; else echo $title['listname'].' ('.$title['count'].')'; ?>  </div>
						</div>
						<input type="hidden" id='userid' value="<?php echo $userid ?>"
							name=""><input type="hidden" id='listid' value="<?php echo $_GET['listid'] ?>"
							name="">  <input type="hidden" id='username'
							value="<?php echo $username ?>" name="">
							<input type="hidden" id='sso_session_life' value="<?php echo $_SESSION['sso_session_life'] ?>" name="sso_session_life">
						<div class="panel-body">
							<input type="hidden" value="" name="cbvals" id="cbvals" />
							<table id="example" class="display"
								data-listid="<?php echo $listid ?>" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Select</th>
										<th class="noExport">Health Check</th>
										<th>ID</th>
										<th>Site ID</th>
										<th>Site Name</th>
										<th>Device Name</th>
										<th>IP Address</th>
										<th>Market</th>
										<th>Device Series</th>
										<th>Version</th>
										<th class="d-none">Status</th>
										<th>Last Polled</th>
										<!--  <th>Audit Log</th>  -->
									</tr>
								</thead>
							</table>
								<div class="row">
									<div class="col">
										<button type="button" value="SUBMIT"
											class="btn btn-default text-center" id="multi-device-healthcheck"
											name="do-multi-device-healthcheck-submit">Run Health Check</button>
									</div>
								</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<div id="mycmdModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<!-- Content will be loaded here from "remote.php" file -->
				</div>
			</div>
		</div>
		<!-- /.content-wrapper -->

		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<br />
	<!--<a href ="ssh://njbbcpnebh@10.198.238.19" target="blank">  SSH Session Test </a>  -->
	<!-- ./wrapper -->
        <?php include ('footer.php'); ?>

    </body>
</html>