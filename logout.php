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
						    header('Location:index.php' );
						    exit;
						}
						?>       
						<div><p class="box-title">Are you sure want to Logout?</p></div>
						<div><p><a href="index.php">Logout</a>&nbsp;|&nbsp;<a href="<?php echo $location_href;?>">Home</a></p></div>
                    </div>
  		</div>
	<?php include ('footer.php'); ?> 
    </body>
</html>
