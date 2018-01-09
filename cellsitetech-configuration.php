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
                  	<?php if($_SESSION['msg'] == 'ss'){ ?>
                  		<div id="main-status" class="alert alert-success">Script File Generated Successfully in Upload Path</div>
                  	<?php }elseif($_SESSION['msg'] == 'dbs'){ ?>
                  		<div id="main-status" class="alert alert-success">Configurations Saved Successfully</div>
                  	<?php }unset($_SESSION['msg']);?>
                    <div class="panel panel-default">
                      <div class="panel-heading">Configuration Management</div>
                      <div class="panel-body">
                      	     <div class="row">
                    	      	<div class="col-lg-12">
							     	<form action="upload_03.php" method="post" enctype="multipart/form-data">
							        <div class="form-group">
                    				    <label for="file">Select a file to upload</label>
                    				    <input type="file"  id="file" name="file">
                    				    <p class="help-block">Only txt file with maximum size of 2 MB is allowed.</p>
                    				  </div>
                    				  <input type="submit" name="config-submit" class="btn btn-lg btn-primary" value="Upload">
                    				</form><br/>
								<?php
							$filename = getcwd()."/upload/sampleconfigfile.txt";
							$output = '<form name="file_process" action="cellsite-config-process.php" method="post">';
							if(file_exists($filename)){
									$fd = fopen ($filename, "r");
									$line = 0;
									while(!feof($fd))
									{
									    ++$line;
    									$contents = fgets($fd,filesize ($filename));									
    									$delimiter = "#";
    									$splitcontents = explode($delimiter, $contents);
    									$splitcontcount = count($splitcontents);
    									if ($splitcontcount > 1) {
    									    $output .= '<div class="form-group">';
    										foreach ( $splitcontents as $color )
    										{   
    										    if(!empty($color)){
        											if (substr_count(strtolower($color),"x") > 0 ){
        											    $output .= '<input type="text" name="loop[looper_'.$line.'][]" value="'."$color".'" ><input type="hidden" name="hidden[looper_'.$line.'][]" value="1" >';
        											}else{
        											    if(strlen(trim($color))!=0){
        											         $output .= '<input type="text" name="loop[looper_'.$line.'][]" value="'."$color".'" readonly ><input type="hidden" name="hidden[looper_'.$line.'][]" value="0" >';
        											    }
        										    }
    										    }
    										};
    										$output .= '</div>';										
    									} elseif($splitcontcount == 1) {
    										foreach ( $splitcontents as $color )
    										{   
    										    if(!empty($color)){
    											    $output .= '<div class="form-group"><input type="text" name="loop[looper_'.$line.'][]" value="'."$color".'" readonly ><input type="hidden" name="hidden[looper_'.$line.'][]" value="0" ></div>';
    											}
    										}; 
    									};
									};									
									fclose($fd);
									$output .= '<div class="form-group"><input class="btn btn-lg btn-primary" name="action" type = "submit" value = "SaveDB">&nbsp;&nbsp;&nbsp;<input class="btn btn-lg btn-primary" name="action" type = "submit" value = "Saveasscriptfile"></div>';
									$output .= '</form>';
									echo $output;
									?>  

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
