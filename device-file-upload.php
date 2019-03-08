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
check_user_authentication(array(
        8,9
)); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   	<script src="resources/js/login_impersonate.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body>
	<div class="container-fluid" id="device-file-upload">
	<?php include_once ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<h5>Binary File Upload</h5>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
                                  	<div id="upload_status" style="display: none;" class="alert"></div>
                                  	<?php if($_SESSION['msg'] == 'fus'){ ?>
                                  		<div id="main-status" class="alert alert-success">File Uploaded Successfully</div>
                                  	<?php } ?>
                                  	<?php if($_SESSION['msg'] == 'fuee'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> File Type not allowed to upload
									</div>
                                  	<?php } ?>
                                  	<?php if($_SESSION['msg'] == 'fue'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> File Upload Error!
									</div>
                                  	<?php }unset($_SESSION['msg']);?>
									<div class="row">
										<div class="col-lg-4 tags p-b-2">
											<form action="cellsite-config-process.php" method="post" enctype="multipart/form-data">
												  <div class="form-group">
                                                    <label for="exampleInputFile">Select a file to upload</label>
                                                    <input type="file" id="file" name="file" class="form-control-file" aria-describedby="fileHelp">
                                                    <!-- <small id="fileHelp" class="form-text text-muted">Upload "avi","mp4","mkv","bin" type file.</small> -->
													<small id="fileHelp" class="form-text text-muted">Upload "bin" type file.</small>
                                                  </div>
												<input type="submit" name="action-http-upload" id="action-http-upload" class="btn btn-sm" value="UPLOAD">
											</form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

        <?php include_once ('footer.php'); ?>
    </body>
</html>
