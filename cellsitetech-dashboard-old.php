<?php

include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

//Static variable values set
if (isset($_GET['clear']) ) {
  if (strtolower($_GET['clear']) == 'search') {
    unset($_SESSION['search_term']);
  }
}

user_session_check();
include_once ('config/session_check_cellsite_tech.php');

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body>
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid">
            <?php include_once ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
                          <!--  <div class="panel-heading"> My Devices List </div>
                          </div>                  
						  -->
                          <input type="hidden" id='userid' value="<?php echo $userid ?>" name="">
                          <div class="panel-body">
                            <table id="example"  class="table table-striped table-sm">
                              <thead>
                                <tr>
                                  <th class="noExport">Health Check</th>
                                  <th>Site Id</th>
                                  <th width="25%">Site Name</th>
                                  <th>Device Name</th>
                                  <th>Market  </th>
                                  <th>Device series</th>
                                  <th>Version</th>
                                  <th>Last Polled</th>
                                </tr>
                              </thead>                              
                            </table>                            
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

        <?php include_once ('footer.php'); ?> 
    </body>
</html>
