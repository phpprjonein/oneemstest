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
	src="resources/js/multi-device-healthcheck.js?t=<?php echo date('his'); ?>"></script>
</head>
<body id="devhc">
			<div id="mycmdModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<!-- Content will be loaded here from "remote.php" file -->
				</div>
			</div>
		</div>
		<!-- /.content-wrapper -->
	<div class="modal fade" id="multihcModel">
		<div class="modal-dialog">
			<div class="modal-content" id="batchModalContent">
				<!-- Modal Header -->
				<div class="modal-header" id="backupmodalhdr">
					<h5 class="modal-title">Health Check on Device Selected</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">

			  	</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid multidevicehc" id="multidevicehc">
    <?php include_once ('menu.php'); ?>
      <?php
    $values = array(
        'Multiple Device Healthcheck' => '#'
    );
    echo generate_site_breadcrumb($values);
    ?>
<!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content" id="multidevicehc">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
					<!-- backup management content row -->
					<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2"
						action='#' method='POST'
						enctype='multipart/form-data' novalidate autocomplete="on">

						<div class="row">
							<div class="col-sm-12 col-md-4 text-center">
															<div class="jf-form">
									<!-- select purpose options -->
                  <?php $swrepolist = swrepo_get_deviceseries();?>
                    <div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Select Device Series</label>
										<select id="device_series" name="device_series"
											class="form-control custom-select" data-rule-required="true">
                        <?php foreach ($swrepolist as $key => $val){ ?>
        				        <option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
        				        <?php }; ?>
                      </select>
									</div>
									<div class="clearfix"></div>
									<p>&nbsp;</p>
								</div>
							</div>
							<div class="col-sm-12 col-md-4 text-center">
								<div class="jf-form">
									<!-- select purpose options -->
                  <?php $swrepolist = generic_get_vendors();
                    //print '<pre>'; 
                    
                  //print_r($swrepolist); die;
                  ?>
                    <div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Select Vendor</label>
										<select id="vendorId" name="vendorId"
											class="form-control custom-select" data-rule-required="true">
                        <?php foreach ($swrepolist['result'] as $key => $val){ ?>
        				        <option value="<?php echo $val['id'];?>"><?php echo $val['vendorName'];?></option>
        				        <?php }; ?>
                      </select>
									</div>
									<div class="clearfix"></div>
									<p>&nbsp;</p>
								</div>
							</div>
										
							<!-- right side -->
							<!-- script output -->
							<div class="col-sm-12 col-md-12" id="listname-dd">
							<!-- /router selection content row -->
								<div class="row">
									<div class="col">
										<input type="hidden" value="" name="cbvals" id="cbvals" />
										<input type="hidden" value="<?php echo $_SESSION['userid'];?>" name="userid" id="userid" />
										<table id="multidevhc" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th></th>
													<th>IP Address</th>
													<th>Device Name</th>
													<th>Device Series</th>
													<th>Market</th>
													<th>Current Version</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<!-- /template name content -->
								<div class="row">
									<div class="col">
										<button type="button" value="SUBMIT"
											class="btn btn-default text-center" id="multi-device-healthcheck"
											name="do-multi-device-healthcheck-submit">Run Health Check</button>
									</div>
								</div>
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
