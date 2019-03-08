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
   <script src="resources/js/batch_page.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<!-- The Modal -->
	<input type="hidden" value="<?php echo implode(',', $_SESSION['filenames'])?>" name="bwfilenames" id="bwfilenames">
	<input type="hidden" value="" name="bwcategory" id="bwcategory">
	<input type="hidden" value="" name="bwbatchid" id="bwbatchid">
	<input type="hidden" value="" name="bwdeviceseries" id="bwdeviceseries">
	<input type="hidden" value="" name="bwdeviceos" id="bwdeviceos">
	<input type="hidden" value="" name="bwsel-priority" id="bwsel-priority">
	<input type="hidden" value="" name="bwrefmop" id="bwrefmop">
	<input type="hidden" value="" name="bwswitch_type" id="bwswitch_type">
	
	<div class="modal fade" id="batchpreModal">
		<div class="modal-dialog">
			<div class="modal-content" id="batchModalContent">
				<!-- Modal Header -->
				<div class="modal-header" id="backupmodalhdr">
					<h5 class="modal-title">BW Upgrade Device Selected</h5>
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
					<button type="button" id="bwcreatebatch" class="btn btn-secondary">Create Batch</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	
	
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
				<!-- Modal body -->
				<div class="modal-body">
			  Please do keep track the status on Batch Page
			  <?php if(isset($_SESSION['batch_vars']['batchid'])):?>
			  <br>Batch ID : <?php echo $_SESSION['batch_vars']['batchid']; ?>,<?php if(strpos($_SESSION['batch_vars']['templname'], 'BW-Upgrade')) { ?><?php echo ($_SESSION['batch_vars']['batchid']+1).','.($_SESSION['batch_vars']['batchid']+2); ?>
			  <?php } ?>
			  </b>
			  <?php endif;?>
			  </div>
				<!-- Modal footer -->
				<div class="modal-footer">
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
    'Batch Page' => '#'
);
echo generate_site_breadcrumb($values);
?>
            <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content" id="batch-page">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
					<div class="panel">
						<div class="panel-info">
							<!-- Page title -->
							<!--  <div class="panel-heading"> My Devices List </div>
                          </div>
						  -->
							<div class="row">
								<div class="col-sm-3">
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
							<?php if($_SESSION['batch_vars']['templname'] != ''): ?>
							<div class="col-sm-6">
									<p class="text-center">
										<b>Selected Template: <?php echo $_SESSION['batch_vars']['templname']; ?></b>
									</p>
								</div>
								<div class="col-sm-3"></div>
							<?php endif; ?>
						</div>
							<p id="cp1" style="display: none"></p>
							<input type="hidden" id='userid' value="<?php echo $userid ?>"
								name=""> <input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['batchid'];?>"
								name="batchid" id="batchid"> <input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['templname']; ?>"
								name="scriptname" id="scriptname" /> <input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['deviceseries']; ?>"
								name="deviceseries" id="deviceseries" /> <input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['deviceos']; ?>"
								name="deviceos" id="deviceos" /> <input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['refmop']; ?>"
								name="refmop" id="refmop" />
								<input type="hidden"
								value="<?php echo $_SESSION['batch_vars']['switch_type']; ?>"
								name="switch_type" id="switch_type" />
							<div class="panel-body">
								<input type="hidden" value="" name="cbvals" id="cbvals" />
								<table id="batchpro" class="table table-striped table-sm">
									<thead>
										<tr>
											<th class="noExport">Select</th>
											<th>IP Address</th>
											<th>Device Name</th>
											<th>Device Series</th>
											<th>Market</th>
											<th>Version</th>
										</tr>
									</thead>
								</table>
								<form>
									<div class="form-group row">
										<label for="Priority"
											class="col-sm-2 col-form-label font-weight-bold">Select
											Priority</label>
										<div class="col-sm-1">
											<select class="form-control custom-select" id="sel-priority">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>9</option>
												<option>10</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-auto">
										<button type="submit" value="SUBMIT" class="btn btn-default"
											id="batch-submit">ADD DEVICES</button>
										</div>
										<?php if((strpos($_SESSION['batch_vars']['templname'], 'BW-Upgrade') === false) && in_array($_SESSION['userlevel'], array(9))):?>
										<div class="col-auto">	
										<button type="submit" value="Add All Devices" class="btn btn-default"
											id="batch-submit-add-all-devices">ADD All DEVICES</button>
										</div>	
										<?php endif;?>
									</div>
								</form>

							</div>
							<!-- /.box-body -->
						</div>
					</div>
					<p>&nbsp;</p>
			
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
