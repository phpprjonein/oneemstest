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
 //check_user_authentication('1'); //cellsite tech type user

    $page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
    <head>
	<?php include("includes.php");  ?>
	<script src="resources/js/login_impersonate.js?t="<?php echo date('his'); ?>"></script>
	</head>
     <body>
        <!-- Modal HTML -->
        <div class="container-fluid">
            <?php include ('menu.php'); ?>
            <div class="col-auto">
						<?php
						if (isset($_SESSION['userlevel']) && $_SESSION['userlevel']) {
						    $location_href = get_landing_page();
						}else{
                                                    session_destroy();
						    header('Location:index.php' );
						    exit;
						}
						?>
<!-- Logut page content row main -->
          <div class="row logout text-center">
            <div class="col-sm-2 col-2 logout-left d-flex justify-content-center align-items-center">
              <i class="fa fa-sign-out fa-3x"></i>
            </div>
            <div class="col-sm-10 col-10">
              <!-- <h1><a href="index.php"> LOGOUT</a></h1> -->
              <h1>YOU ARE NOW LOGGED OUT</h1>
              <p class="font-weight-bold">Didn't mean to log out?</p>
              <!-- <a href="<?php echo $location_href;?>">Home</a> -->
              <p><a href="index.php"><i class="fa fa-sign-in fa-lg text-primary"></i> LOGIN</a></p>
            </div>
          </div>
<!-- /Loogut page content row main -->
        </div>
      </div>
	<?php include ('footer.php'); ?>
    </body>
</html>
