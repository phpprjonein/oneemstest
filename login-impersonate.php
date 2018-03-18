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
          <div class="content container-fluid" id="login-impersonate">
          			<form class="login-form" action="index.php" method="post">
          			<input type="hidden" value="imp" name="userimp"/>
          	        <div class="row">
                    <div class="form-group col-md-12">
                      <label for="inputName">User Name</label>
                      <input type="inputName" name="username" class="form-control-plaintext" id="inputName" placeholder="User Name">
                    </div>
                    <div class="form-check col-md-12">
                      <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn" id="manual-discovery" data-toggle="modal">Submit</button>
                      </div>
                    </div>
                    </div>
                    </form>
          			</div>
  		</div>
	<?php include ('footer.php'); ?> 
    </body>
</html>
