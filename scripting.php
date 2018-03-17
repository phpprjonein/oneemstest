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
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
   <script src="resources/js/cellsitetech_config_new.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
	<form action="cellsitetech-configuration.php" method="post" id="config_file_uploader" enctype="multipart/form-data">
		<div id="status" style="display: none;" class="alert"></div>
		              <select>
                <option value="">- Select Purpose -</option>
				  <option value="one">one</option> 
              </select>
               <input type="submit" name="act" class="btn config-submit" value="NEXT">
                       <div class="row">
          <div class="col d-none" id="template_info">
            <label for="inputRegion">TEMPLATE:</label>
            <small><b><span id="filename"></span></b></small>
            <!-- Golden_ASR920_15.6_ALL_standalone_GreatLakes_AKRON_opw_021418 -->
            <input type="hidden" name="filename" id="upload_filename">
          </div>
        </div>
	</form>
	</div>

	<!-- container-fluid -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
