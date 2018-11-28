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
	<?php include("includes.php");  ?>
	<script src="resources/js/login_impersonate.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body class="hold-transition skin-blue sidebar-mini ownfont">
	<?php 
	   if($_POST['upload'] == 'submit' && $_POST['copytype'] != 'phpcopy'){
            $filename = $_SERVER["SCRIPT_FILENAME"];
            $filename = str_replace("device-upload.php", "", $filename);
            $actual_name = pathinfo ($_POST['sourceurl'], PATHINFO_FILENAME).'.'.pathinfo ($_POST['sourceurl'], PATHINFO_EXTENSION);
            $filename = getcwd().'/upload/deviceuploads/'.$actual_name;
            $output = shell_exec("/usr/bin/wget '".$_POST['sourceurl']."' -O '".$filename."'  --no-check-certificate");
	   }elseif($_POST['upload'] == 'submit' && $_POST['copytype'] == 'phpcopy'){
	       $filename = $_SERVER["SCRIPT_FILENAME"];
	       $actual_name = pathinfo ($_POST['sourceurl'], PATHINFO_FILENAME).'.'.pathinfo ($_POST['sourceurl'], PATHINFO_EXTENSION);
	       $destpath = getcwd().'/upload/deviceuploads/'.$actual_name;
	       if(copy($_POST['sourceurl'], $destpath)){
	           $message = "success";
	       }else{
	           $message = "failed";
	       }
	   }
	   
        
	?>
	<!-- Modal HTML -->
	<div class="container-fluid">
        <?php include ('menu.php'); ?>
        <div class="content container-fluid" id="device-upload">
			<div class="row">
				<div class="col-12 col-sm-12">
					<div id="status" style="display: none;" class="alert"></div>
					<?php if($message == 'success'){?>
						<div class="alert alert-success">Uploaded Successfully</div>
					<?php }?>
					<?php if($message == 'failed'){?>
						<div class="alert alert-danger">Uploaded Failed</div>
					<?php }?>
					
					<form class="login-form" method="post">
						<div class="input-group row">
							<div class="form-inline col-md-6 col-sm-12">
								<input type="hidden" name="copytype" value="phpcopy"/>
								<input type="inputName" name="sourceurl" class="form-control"
									id="inputName" placeholder="Enter URL" autofocus>
								<button type="submit" class="btn" name="upload" value="submit" id="device-upload-act"
									data-toggle="modal">Submit</button>
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
