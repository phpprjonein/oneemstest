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
<script src="resources/js/os_repository.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid sw-delivery-devices"
		id="sw-delivery-devices">
    <?php include_once ('menu.php'); ?>
    <?php
    $values = array(
        'Os Repository' => '#'
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
						<!-- Modal body -->
						<div class="modal-body">Filenames saved successfully</div>
						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
					<!-- backup management content row -->
					<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2"
						action='generate_script2.php' method='POST'
						enctype='multipart/form-data' novalidate autocomplete="on">
						<div class="row">

							<!-- router selection content row -->
							<div class="col-sm-12 col-md-4">
								<div class="jf-form">

									<!-- select purpose options -->
            <?php $os_repository_vendor = os_repository_vendor(); ?>
            <div class="form-group f1 required" data-fid="f4">
										<label class="control-label" for="f1">Vendor</label> <select
											id="vendorname" name="vendor" class="form-control custom-select"
											data-rule-required="true">
											<option value="">Choose Vendor</option>
                <?php foreach ($os_repository_vendor as $key => $val){ ?>
				<option value="<?php echo $val['vendor'];?>"><?php echo $val['vendor'];?></option>
				<?php }; ?>
              </select>
									</div>
									<!-- /select purpose options -->

									<!-- select device series options -->
			<?php $os_repository_minverreq = os_repository_minverreq();?>
            <div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Minimum Os Version</label>
										<select id="minverreq" name="minverreq"
											class="form-control custom-select" data-rule-required="true">
											<option value="">Choose Minimum Os Version</option>
                <?php foreach ($os_repository_minverreq as $key => $val){ ?>
				<option value="<?php echo $val['minverreq'];?>"><?php echo $val['minverreq'];?></option>
				<?php }; ?>
              </select>
									</div>
									<!-- /select device series options -->

									<!-- select device series options -->
			<?php $os_repository_patches = os_repository_patches();?>
            <div class="form-group f3 required" data-fid="f3">
										<label class="control-label" for="f3">Patch</label> <select
											id="ospatch" name="ospatch"
											class="form-control custom-select" data-rule-required="true">
											<option value="">Choose Patches</option>
                <?php foreach ($os_repository_patches as $key => $val){ ?>
				<option value="<?php echo $val['ospatch'];?>"><?php echo $val['ospatch'];?></option>
				<?php }; ?>
              </select>
									</div>
									<!-- /select device series options -->

									<!-- select device series options -->
			<?php $os_repository_deviceseries = os_repository_deviceseries();?>
            <div class="form-group f2 required" data-fid="f2">
										<label class="control-label" for="f2">Device Series</label> <select
											id="deviceseries" multiple name="deviceseries"
											class="form-control custom-select" data-rule-required="true">
											<option value="">Choose Device Series</option>
                <?php foreach ($os_repository_deviceseries as $key => $val){ ?>
				<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries'];?></option>
				<?php }; ?>
              </select>
									</div>
									<!-- /select device series options -->

									<!-- datepicker -->
									<div class="form-group f9 required">
										<p>
											<b>Apply By Date: <input type="text" id="applydate"
												class="form-control"></b>
										</p>
									</div>
									<!-- datepicker -->

									<!-- select device series options
			<?php $os_repository_versions = os_repository_versions();?>
            <div class="form-group f5 required" data-fid="f5">
										<label class="control-label" for="f5">Os Version</label> <select
											id="deviceseries" name="deviceseries"
											class="form-control custom-select" data-rule-required="true">
											<option value="">Choose Os Version</option>
                <?php foreach ($os_repository_versions as $key => $val){ ?>
				<option value="<?php echo $val['osversion'];?>"><?php echo $val['osversion'];?></option>
				<?php }; ?>
              </select>
									</div>
									select device series options -->




									<!-- /select OS version options -->
									<div class="clearfix"></div>
									<p>&nbsp;</p>
									<!-- /router scripting selection form div -->
								</div>
							</div>
							<!-- /router selection content row -->


							<!-- right side -->
							<!-- script output -->
							<div class="col-sm-12 col-md-8" id="listname-dd">
								<!-- template output content -->
								<div class="row">
									<div class="col">
                  	<?php
                $path = '/home/saravanan/source/oneemstest/osrepository/';
                $contents = array_values(array_diff(scandir($path), array(
                    '.',
                    '..'
                )));
                $existing_filenames = os_repository_get_existing_filenames();
                ?>
                    <table id="osrepository" class="display"
											style="width: 100%">
											<thead>
												<tr>
													<th>Select</th>
													<th>Filename</th>
													<th>Size</th>
												</tr>
											</thead>
											<tbody>
                            <?php $i=1;?>
                            <?php foreach ($contents as $key=>$val):
                            if(!in_array($val, $existing_filenames)): ?>
                            <tr id="row_<?php echo $i;?>">
													<td><input type="checkbox" value="" name="category"></td>
													<td><?php echo $val; ?></td>
													<td><?php echo filesize($path.$val); ?></td>
							</tr>
							
                            <?php endif; $i++; endforeach; ?>
                            </tbody>
										</table>
									</div>
								</div>
								<!-- /template name content -->

								<div class="row">
									<div class="col">
										<button type="button" value="SUBMIT"
											class="btn btn-default text-center" id="osrepo-submit"
											name="osrepo-submit">SUBMIT</button>
									</div>
								</div>
								<!-- /right side -->
								<!-- /script output -->
							</div>

							<!-- /backup management content row -->
						</div>
					</form>
			
			</section>
			<!-- /.content -->
		</div>


	</div>
	<!-- container-fluid -->
<?php include_once ('footer.php'); ?>
</body>
</html>
