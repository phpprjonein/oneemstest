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

unset($_SESSION['admin_check']);

if ($_POST['submit'] == 'Password Validate' && ! empty($_POST['password'])) {
    if (valid_admin_usr_by_password($_POST['password'])) {
        $_SESSION['admin_check'] = true;
        header("location:" . $_GET['redirect']);
    } else {
        $_SESSION['admin_check'] = false;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes.php");  ?>
	</head>
<body class="hold-transition skin-blue sidebar-mini ownfont">
	<!-- Modal HTML -->
	<div class="container-fluid admin-only-login">
        <?php include ('menu.php'); ?>
        <div class="content container-fluid" id="login-impersonate">

			<div class="row">
				<div class="col-12 col-sm-12">
		  <?php if($_SESSION['admin_check'] === false){ ?>
		  <div id="status" class="alert alert-danger">Admin Validate Failed</div>
		  <?php }  ?>
          <form class="login-form login-revalidate"
						action="admin-user-revalidate.php?redirect=os-repository.php"
						method="post">
						<div class="input-group row">
							<div class="form-inline col-md-6 col-sm-12">
								<input type="password" name="password" class="form-control"
									id="inputPassword" placeholder="Password">
								<button type="submit" name="submit" value="Password Validate"
									class="btn" id="password-revalidate" data-toggle="modal">Submit</button>
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
