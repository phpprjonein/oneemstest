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
     <body class="hold-transition skin-blue sidebar-mini ownfont">
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid">
            <?php include ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
							<!--
                            <div class="panel-heading"> My Devices List </div>
							-->
                          </div>                  
                          
 							<div id="mylist" class="panel-heading" style = "height:560px;"><b></b> 
							     <form action="upload_03.php" method="post" enctype="multipart/form-data">
									<table>
										<tr>
										  <td> Filename: </td>
										  <td> 	<input type="file" name="file" id="file">  </td>
										</tr> 
										<tr>
										  <td colspan="2" align="left"> <input type="submit" name="submit" value="Submit">  </td>
										  
										</tr>
									</table> 
								</form> 
								<?php
									$filename = "O:\wamp\www\oneems\upload\sampleconfigfile.txt";
									$fd = fopen ($filename, "r");
									//$contents = fread ($fd,filesize ($filename));
									while(!feof($fd))
									{
									  //echo fgets($fd) . "<br>";  
									$contents = fgets($fd,filesize ($filename));									
									$delimiter = "#";
									$splitcontents = explode($delimiter, $contents);
									//print_r($splitcontents); 
									$counter = "";
									$splitcontcount = count($splitcontents);
									//echo 'value of splitcontcount'.$splitcontcount.'<br>';
									//echo "Count of splitcontents array is".$splitcontcount.'<br>';
									if ($splitcontcount > 1) { 
										foreach ( $splitcontents as $color )
										{   
											$counter = $counter+1; 
											//echo "<b>Split $counter: </b> $color"; 
											if (substr_count(strtolower($color),"x") > 0 )
												echo '<input type="text" value="'."$color".'" >';
											else
												echo '<input type="text" value="'."$color".'" readonly >'; 
										};
                                        echo '<br>';										
									} elseif($splitcontcount == 1) {
										//echo 'Inside the else part';
										foreach ( $splitcontents as $color )
										{   
											$counter = $counter+1;  
											//echo "<b>Split $counter: </b> $color"; 
											echo '<input type="text" value="'."$color".'" readonly >'."<br>";
											//echo '<input type="text" value="" readonly >'."<br>";
										}; 
										echo '<br>';
									};
									};									
									fclose($fd);?>  
									<form  action='configtempl.php'> <input type = "submit" value = "SaveDB"></form>
									<form  action='scriptfile.php'> <input type = "submit" value = "Saveasscriptfile"></form>
							</div> 
                        <!-- /.box-body -->
                      </div>
                  </div> 
                </section> <!-- /.content -->
              </div>
            <!-- /.content-wrapper --> 
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->	 
        <?php //include ('footer.php'); ?> 
    </body>
</html>
