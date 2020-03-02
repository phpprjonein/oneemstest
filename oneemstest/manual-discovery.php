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
//include_once ('config/session_check_cellsite_tech.php');
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Discovery Results page Description: Cell Site Tech has navigated to the Discovery Results page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_discovery_v1.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body>
	<!-- container div -->
	<div class="container-fluid" id="disc-mgt-screen">
<?php include_once ('menu.php'); ?>
		<?php
$values = array(
        'Manual Discovery' => '#'
);
echo generate_site_breadcrumb($values);
?>
	<!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="manual-device-discovery">

					<!-- Modal Header -->
					<div class="modal-header" id="restoremodalhdr">
						<h5 class="modal-title text-center" id="modalLabelLarge">Manual
							Device Discovery</h5>
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
						<button type="button" class="btn btn-primary" id="mandiscsubmit">Save
							changes</button>
					</div>
				</div>
			</div>
		</div>
        <div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div class="panel">
						<div class="row" id="v-pills-manual">
							<div class="col-12 col-sm-12" id="manual-disc-utils">
								<div id="status" style="display: none;" class="alert"></div>
								<form class="form-inline">
								<div class="col-auto field">
									<div class="form-group form-inline">
										<label class="control-label mr-2" for="inputDeviceIPaddress">Device
											IP Address</label> <input type="deviceIPaddress"
											class="form-control inline" id="inputDeviceIPaddress"><!--10.202.97.212-->
									</div>
								</div>

								<div class="col-auto" style="display: none;">
									<div class="btn-group" id="manual-disc-market">
										<button type="button" class="btn dropdown-toggle"
											data-toggle="dropdown" aria-haspopup="true"
											aria-expanded="false">SELECT MARKET</button>
										<div class="dropdown-menu">
									  <?php
										$market_list = generic_get_market_by_username($_SESSION['username']);
										foreach ($market_list['result'] as $rkey => $rvalue) :
											if (! empty($rvalue['market'])) :
												?>
										  <a class="dropdown-item" href="#"><?php echo $rvalue['market']; ?></a>
										  <?php
										  endif;
											
										endforeach
										;
										if (count($market_list['result']) > 0) :
										?>
										<a class="dropdown-item" href="#">SELECT MARKET</a>
									  <?php endif; ?>
									  </div>
									</div>
								</div>
								<!-- /region selection -->

								<!-- add row button -->
								<div class="col-auto">
									<div class="form-check mb-2 mb-sm-0">
										<div class="btn-group" role="group" aria-label="">
											<button type="button" class="btn" id="manual-discovery"
												data-toggle="modal">Submit</button>
										</div>
									</div>
								</div>
								<!-- /add row button -->

							</form>
							</div>
						</div>
						<div class="panel-body-wrap"></div>

<br>

					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>

		<!-- https://codepen.io/shaikmaqsood/pen/XmydxJ/ -->
    	<div id="Modal_Health_Checks" tabindex="-1" class="modal fade"
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
	<!-- /IP management table row -->

<?php include_once ('footer.php'); ?>


	<!-- add device modal -->
	

</body>
</html>
