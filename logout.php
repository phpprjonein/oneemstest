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
              <p><b> <a href="index.php"> Wanna to logout!!</a>. Any automatic login has also been stopped.</b></p>
              <p>Didn't mean to log out? Log in again.<a href="<?php echo $location_href;?>">Home</a></p>
            </div>
          </div>
<!-- /Loogut page content row main -->

                    </div>
  		</div>
	<?php include ('footer.php'); ?> 
    </body>
</html>
