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
include_once ('config/session_check_admin.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 8) ? "Admin" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Discovery Results page Description: Cell Site Tech has navigated to the Discovery Results page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/audit-history-cleanup.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body>
	<!-- container div -->
	<div class="container-fluid" id="disc-mgt-screen">
<?php include_once ('menu.php'); ?>
		<?php
$values = array(
        'Audit History Cleanup' => '#'
);
echo generate_site_breadcrumb($values);
?>
		<!-- IP management table row -->
		<div class="row">
			<!-- table content row -->
			<div class="col-12 col-md-12">

				<!-- IP container div -->
				<div class="tab-content" id="v-pills-tabContent">
					<!-- missed table content -->
						<table class="table table-sm table-striped ipcase1"
							id="audit-history-cleanup">
							<thead>
								<tr>
									<th scope="col">BatcID</th>
									<th scope="col">Device Name</th>
									<th scope="col">IPv4 Address</th>
									<th scope="col">Device Series</th>
									<th scope="col">Delete</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_audittab_content();
                if (isset($resultset)) {
                        foreach ($resultset as $key => $value) {    
                            ?>
                            <tr data-auhisid="<?php echo $value['auhisid']; ?>">
    									<td><?php echo $value['batchid'];?></td>
    									<td><?php echo $value['devicename'];?></td>
    									<td><?php echo $value['deviceIpAddr'];?></td>
    									<td><?php echo $value['deviceseries'];?></td>
    									<td><a href="#" class="del-device">Delete</a></td>
    								</tr>
                       		<?php
                                }
                }
                ?>
                </tbody>
						</table>
					<!-- /missed table content -->
				</div>
			</div>
			<!-- /IP container div -->
		</div>
		<!-- /table content row -->
	</div>
	<!-- /IP management table row -->
<?php include_once ('footer.php'); ?>
</body>
</html>
