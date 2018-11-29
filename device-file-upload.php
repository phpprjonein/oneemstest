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
        8
)); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<h5>Device File Upload</h5>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
                                  	<div id="upload_status" style="display: none;" class="alert"></div>
									<div class="row">
										<div class="col-lg-4 tags p-b-2">
											<form action="cellsite-config-process.php" method="post" enctype="multipart/form-data">
												<div class="form-group">
													<label for="file">Select a file to upload</label> 
													<input type="file" id="file" name="file">
												</div>
												<input type="submit" name="action-http-upload" id="file-submit" class="btn" value="UPLOAD">
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
