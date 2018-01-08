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
 check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body>
        <div class="container-fluid">
            <?php include ('menu.php'); ?> 
            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">Configuration Management</div>
                      <div class="panel-body">
                      	     <div class="row">
                    	      	<div class="col-lg-12">
                    	      		<?php 
                    	      		if($_POST['config-submit'] == 'Upload'){
                    	      		    echo $upload_try = upload_file_to_disk('config-submit', 'config', array('txt'), $_SESSION['userid']);
                    	      		    if($upload_try === true){
                    	      		        echo $upload_try;
                    	      		        exit;
                    	      		    }
                    	      		}else{
                    	      		?>
                    	           <form class="well" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                    				  <div class="form-group">
                    				    <label for="file">Select a file to upload</label>
                    				    <input type="file" name="file">
                    				    <p class="help-block">Only txt file with maximum size of 2 MB is allowed.</p>
                    				  </div>
                    				  <input type="submit" name="config-submit" class="btn btn-lg btn-primary" value="Upload">
                    				</form>
                    				<?php } ?>	
                    			</div>
	      					</div>
                      </div>
                    </div>
                  </div> 
                </section> <!-- /.content -->
              </div>
        </div>
        <!-- container-fluid -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
