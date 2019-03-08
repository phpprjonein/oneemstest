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
// check_user_authentication(array(8)); //cellsite tech type user
$page_title = 'OneEMS';
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes.php");  ?>
	 <script
	src="resources/js/cellsitetech_user_dash_devices.js?t=<?php echo date('his'); ?>"></script>
<script
	src="resources/js/ip-instant-health-check.js?t=<?php echo date('his'); ?>"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini ownfont"
	id="healthpage">
	<!-- Modal HTML -->
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
	<input type="hidden" id="userid" value="<?php echo $_SESSION['userid'] ?>"
		name="userid">
	<input type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>"
		name="username">



	<!-- Modal HTML -->
	<div class="container-fluid instant-health-check"
		id="instant-health-check">
        <?php include ('menu.php'); ?>
        
                    <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div class="panel">
						<div class="row">
							<div class="col-12 col-sm-12">
								<div id="status" style="display: none;" class="alert"></div>
								<form class="login-form" action="#" method="post">
									<div class="input-group row">
									<div id="slectchktype" class="form-inline col-md-6 pb-2 col-sm-12">
										<label class="radio-inline">
                                          <input type="radio" class="radiocat" value="ipaddress" name="optradio" checked><b>IP V4/IP V6 Address</b>
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" class="radiocat" value="devicename" name="optradio"><b>Device Name</b>
                                        </label> 
									</div>
									</div>
									<div class="input-group row">
									<div class="form-inline col-md-6 col-sm-12">
											<input type="inputName" name="ipaddress" class="form-control"
												id="inputDeviceIPaddress" placeholder="Enter IP Address"
												autofocus>
											<input type="inputName" name="devicename" style="display: none;" class="form-control"
												id="inputDeviceName" placeholder="Enter Device Name"
												autofocus>	
											<button type="submit" class="btn" id="ip-health-check"
												data-toggle="modal">Run All Health Checks</button>
									</div>
									</div>
								</form>
							</div>
						</div>
						<div class="panel-body-wrap"></div>
                                                                <!--  Sync Password Form Start -->
<hr width="50%" align="left" style="border: 1px solid blue;" />
                                                                <form class="sync-pass-form" action="" method="post">
                                    <div class="input-group row">
                                    <div class="form-inline col-md-6 col-sm-12">
                                            <input type="inputName" name="syncpass_ipaddress" class="form-control"
                                                id="syncPassInputDeviceIPaddress" placeholder="Enter IPv6 Address"
                                                autofocus>
                                            <button type="submit" class="btn" id="sync-password-ip-health-check"
                                                data-toggle="modal">Sync Password</button>
                                    </div>
                                    </div>
                                    </form>
                                    <hr width="50%" align="left" style="border: 1px solid blue;" />
                                    <form class="cyberark-sync-pass-form" action="" method="post">
                                    <div class="input-group row">
                                    <div class="form-inline col-md-6 col-sm-12">
                                            <input type="inputName" name="synccyberarkpass_ipaddress" class="form-control"
                                                id="synccyberarkpass_ipaddress" placeholder="Enter IPv6 Address"
                                                autofocus>
                                            <button type="submit" class="btn" id="sync-cyberark-sync-password-ip-health-check"
                                                data-toggle="modal">Check CyberArk Sync</button>
                                    </div>
                                    </div>
                                </form>
<?php
    echo $cyberarc_output;
?>
                                                                <!--  Sync Password Form End -->
                                                                <!--  Show CyberArk CmdLine Form Start -->
<hr width="50%" align="left" style="border: 1px solid blue;" />
                                                                <form class="ssh-putty-form" action="" method="post">
                                    <div class="input-group row">
                                    <div class="form-inline col-md-6 col-sm-12">
                                            <input type="inputName" name="sshPuTTY_IPv6_addr" class="form-control"
                                                id="sshPuTTYInputIPv6" placeholder="Enter IPv6 Address"
                                                autofocus>
                                            <button type="submit" class="btn" id="ssh-PuTTY-ip-health-check"
                                                data-toggle="modal">Show CyberArk CmdLine</button>
                                    </div>
                                                                <!--  Show CyberArk CmdLine Form End -->
                                                                <!--  Show Add CyberArk Account Form Start -->
                                    </div>
<hr width="50%" align="left" style="border: 1px solid blue;" />
                                    <div class="input-group row">
                                    <div class="form-inline col-md-6 col-sm-12">
                                            <input type="inputName" name="cyberarkaddacct_ipaddress" class="form-control"
                                                id="cyberarkaddacct_ipaddress" placeholder="Enter IPv6 Address"
                                                autofocus>
                                            <button type="submit" class="btn" id="cyberark-add-acct"
                                                data-toggle="modal">Add CyberArk Account </button>
                                    </div>
                                                                <!--  Show Add CyberArk Account Form End -->
                                    </div>
                                </form>
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
	</div>
	<?php include ('footer.php'); ?>
    </body>
</html>
