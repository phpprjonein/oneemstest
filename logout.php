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
        <?php 
        $values = array('Logout' => '#');
        echo generate_site_breadcrumb($values); 
        ?>
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
                  <a href="index.php"><h5>CLICK HERE TO LOG OUT</h5></a>
                  <p class="font-weight-bold">Didn't mean to log out?</p>
                  <p><a href="<?php echo $location_href;?>"><i class="fa fa-sign-in fa-lg text-primary"></i> HOME</a></p>
                </div>
              </div>
<!-- /Loogut page content row main -->

                    </div>
  		</div>
	<?php include ('footer.php'); ?>
    </body>
</html>
