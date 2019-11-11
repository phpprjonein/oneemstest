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
	src="resources/js/show_tech_page.js?t=<?php echo date('his'); ?>"></script>
</head>
<body id="sw-del-dev">
	<div class="container-fluid sw-delivery-devices"
		id="sw-delivery-devices">
    <?php include_once ('menu.php'); ?>
      <?php
    $values = array(
        'Show Tech' => '#'
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

								<!-- template output content -->
								<div class="form-group col-md-8">
									<div class="btn-group" id="backup-restore-list-dt-filter">
										<button type="button" class="btn dropdown-toggle"
											data-toggle="dropdown" aria-haspopup="true"
											aria-expanded="false">My routers</button>
										<div class="dropdown-menu">
      						  <?php
            $celltuser_list = get_celltechusers_list($_SESSION['userid']);
            foreach ($celltuser_list as $key => $value) :
                if (isset($value['listname'])) :
                    ?>
      						  <a class="dropdown-item" href="#"><?php echo ($value['listname'] == "0") ? 'My routers' : $value['listname'] ; ?></a>
      						  <?php
      						  endif;
                
            endforeach
            ;
            ?>
    						  </div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<input type="hidden" value="" name="cbvals" id="cbvals" />
										<input type="hidden" value="<?php echo $_SESSION['userid'];?>" name="userid" id="userid" />
										<table id="swdelvrybatchpro" class="display"
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
											class="btn btn-default text-center" id="batch-submit"
											name="batch-submit">SUBMIT</button>
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