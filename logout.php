<<<<<<< HEAD
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
	<script src="resources/js/login_impersonate.js?t="<?php echo date('his'); ?>></script>
	</head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
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
          <div class="row logout">
            <div class="col-1 col-md-1 col-sm-1 logout-left d-flex justify-content-center align-items-center"><i class="fas fa-info-circle"></i></div>
            <div class="col-10 col-md-10 col-sm-10">
              <p><b> <a href="index.php"> Logout!!</a></b> &nbsp;&nbsp;&nbsp;<b>Didn't mean to log out? &nbsp;<a href="<?php echo $location_href;?>">Home</a></b>
            </div>
          </div>
<!-- /Loogut page content row main -->

                    </div>
  		</div>
	<?php include ('footer.php'); ?> 
    </body>
</html>
=======
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
/*
$userleveldesc = get_user_level_desc($_SESSION['userlevel']);
$username = $_SESSION['username'];
$logmesgdesccode  = logmessages_codes('C002');
$mesg = " User name: $username | User type : $userleveldesc | Log Message Code : 'C002' | Message : $logmesgdesccode";
write_log($mesg); 
*/
?>

<!DOCTYPE html>
<html>
    <head>
	<?php include("includes.php");  ?>
	<script src="resources/js/login_impersonate.js?t="<?php echo date('his'); ?>></script>
	</head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
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
          <div class="row logout">
            <div class="col-1 col-md-1 col-sm-1 logout-left d-flex justify-content-center align-items-center"><i class="fas fa-info-circle"></i></div>
            <div class="col-10 col-md-10 col-sm-10">
              <p><b> <a class="fa fa-sign-out fa-lg" href="index.php"> Logout!!</a></b> &nbsp;&nbsp;&nbsp;<b>Didn't mean to log out? &nbsp;<a href="<?php echo $location_href;?>">Home</a></b>
            </div>
          </div>
<!-- /Loogut page content row main -->

                    </div>
  		</div>
	<?php include ('footer.php'); ?> 
    </body>
</html>
>>>>>>> f925d24473e59e9234a9eee7f64f09b390f58d46
