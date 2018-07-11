<?php

include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
//check_user_authentication(array(8)); //cellsite tech type user

    $page_title = 'OneEMS';
?>
<!DOCTYPE html>
<html>
    <head>
	<?php include("includes.php");  ?>
	<script src="resources/js/instant-health-check.js?t=<?php echo date('his'); ?>"></script>
	</head>
    <body class="hold-transition skin-blue sidebar-mini ownfont">
	<input type="hidden" id="userid" value="<?php echo $userid ?>" name="userid">
	<input type="hidden" id="username" value="<?php echo $username ?>" name="username">
		<!-- Modal HTML -->
	<div class="modal fade" id="healthpageModel">
		<div class="modal-dialog">
			<div class="modal-content" id="cellsitech-backup">
				<!-- Modal Header -->
				<div class="modal-header" id="backupmodalhdr">
					<h5 class="modal-title">
						Audit Log
					</h5>
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
    	<!-- The Modal -->
    <div id="mycmdModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Content will be loaded here from "remote.php" file -->
			</div>
		</div>
	</div>
		<div class="modal fade" id="instant-health-check">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header" id="restoremodalhdr">
						<h5 class="modal-title text-center" id="modalLabelLarge">Instant Health Checks - <span id="instant-health-checks-ip"></span></h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body"></div>
					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>


        <!-- Modal HTML -->
      <div class="container-fluid instant-health-check">
        <?php include ('menu.php'); ?>
        <div class="content container-fluid" id="instant-health-check">
        <div class="row">
          	<div class="col-12 col-sm-12">
          		  <div id="status" style="display: none;" class="alert"></div>
                  <form class="login-form" action="#" method="post">
                      <div class="input-group row" >
                        <div class="form-inline col-md-3 col-sm-12">
                          <input type="inputName" name="ipaddress" class="form-control" id="inputDeviceIPaddress" placeholder="Enter IP Address" autofocus>
                          <button type="submit" class="btn" id="ip-health-check" data-toggle="modal">Submit</button>
                        </div>
                      </div>
                  </form>
        	</div>
        </div>
        </div>
      </div>
	<?php include ('footer.php'); ?>
    </body>
</html>
