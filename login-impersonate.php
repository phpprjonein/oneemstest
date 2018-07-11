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
check_user_authentication(array(8)); //cellsite tech type user

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
      <div class="container-fluid admin-only-login">
        <?php include ('menu.php'); ?>
        <div class="content container-fluid" id="login-impersonate">

<div class="row">
  <div class="col-12 col-sm-12">

          <form class="login-form" action="index.php" method="post">
            <input type="hidden" value="imp" name="userimp"/>
            <input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="impusername"/>

              <div class="input-group row" >
                <div class="form-inline col-md-6 col-sm-12">
                  <input type="inputName" name="username" class="form-control" id="inputName" placeholder="User Name" autofocus>
                  <button type="submit" class="btn" id="manual-discovery" data-toggle="modal">Submit</button>
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
