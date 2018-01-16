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
        <!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="cellsitech-backuprestore">

			  <!-- Modal Header -->
			        <div class="modal-header">
        <h5 class="modal-title">Back up File name to be restored - <span id="bkup-fileid"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


			  <!-- Modal body -->
			  <div class="modal-body">
				
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
	  			<!--<button type="button" class="btn btn-default">Cancel</button>
				<button type="button" class="btn btn-default">Continue</button>
				-->
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
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
                          <!--  <div class="panel-heading"> My Devices List </div>
                          </div>                  
						  -->
                          <input type="hidden" id='userid' value="<?php echo $userid ?>" name="">
                          <div class="panel-body">
                            <table id="backuprestore"  class="table table-striped table-sm">
                              <thead>
                                <tr>
                                  <th class="noExport">Health Check</th>
                                  <th>Site Id</th>
                                  <th width="25%">Site Name</th>
                                  <th>Device Name</th>
								  <th>Region</th>
                                  <th>Market  </th>
                                  <th>Device series</th>
                                  <th>Version</th> 
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

        <?php include ('footer.php'); ?> 
    </body>
</html>
