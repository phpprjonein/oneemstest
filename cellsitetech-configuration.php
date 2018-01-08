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
    /*
    $title = 'hostname <<XXXXXXYY>>5RE-E-CI-<<3850>>-01';
    preg_match_all("/\<<([^\>>]+)\>>/", $title , $matches);
    print '<pre>';
    print_r($matches);
    die;
    */
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
                    	      		
                    	      		if(isset($_POST['config-submit']) && $_POST['config-submit'] == 'Save Changes'){
                                        print '<pre>';
                                        print_r($_POST);
                                        die;
                    	      		}
                    	      		if($_POST['config-submit'] == 'Upload'){
                    	      		    $upload_try = upload_file_to_disk('config-submit', 'config', array('txt'), $_SESSION['userid']);
                    	      		    if($upload_try === true){
                    	      		        $filename = getcwd()."/uploads/config/".$_SESSION['userid']."_config.txt";
                    	      		        $handle = fopen($filename, "r");
                    	      		        $loop = 0;
                    	      		        $output = '<form name="file_process" action="'.$_SERVER['PHP_SELF'].'" method="post">';
                    	      		        if ($handle) {
                    	      		            while (($line = fgets($handle)) !== false) {
                    	      		                ++$loop;
                    	      		                preg_match_all("/\<<([^\>>]+)\>>/", $line , $matches);
                    	      		                if(count($matches[1]) > 0){
                    	      		                    $newv = $matches[1];
                    	      		                    
                    	      		                    for($i=0;$i<count($newv);$i++){
                    	      		                        $line = str_replace('<<'.$newv[$i].'>>', '<input type="text" value="'.$newv[$i].'" name="looper_'.$loop.'[]"/>', $line, $count);
                    	      		                    }
                    	      		                }
                    	      		                $output .= '<div class="form-group">'.$line.'</div>';
                    	      		            }
                    	      		            fclose($handle);
                    	      		        }
                    	      		        if($loop > 0){
                    	      		            $output .= '<input type="submit" name="config-submit" class="btn btn-lg btn-primary" value="Save Changes">';
                    	      		        }
                    	      		        $output .= '</form>';
                    	      		        echo $output;
                    	      		    }
                    	      		}else{
                    	      		    if(file_exists(getcwd()."/uploads/config/".$_SESSION['userid']."_config.txt")){
                    	      		        unlink(getcwd()."/uploads/config/".$_SESSION['userid']."_config.txt");
                    	      		    }
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
