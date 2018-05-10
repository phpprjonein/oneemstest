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
   <script src="resources/js/cellsitetech_user_devices.js?t=<?php echo date('his'); ?>"></script>
 </head>
     <body>
        <!-- The Modal -->
        		<!-- The Modal -->
		<div class="modal fade" id="restoreModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="cellsitech-backup">

			  <!-- Modal Header -->
		<div class="modal-header" id ="backupmodalhdr">
        <h5 class="modal-title"><span id ="backupmodalhdrtxt"><strong><span id="bkup-deviceid"></span></strong></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			  <!-- Modal body -->
			  <div class="modal-body modal-content" style="min-height:125px;">
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
        


		<!-- The Modal -->
		<div class="modal fade" id="backupModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="cellsitech-backup">

			  <!-- Modal Header -->
		<div class="modal-header" id ="backupmodalhdr">
        <h5 class="modal-title"><span id ="backupmodalhdrtxt"><strong>Back up device details <span id="bkup-deviceid"></span></strong></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			  <!-- Modal body -->
			  <div class="modal-body modal-content" style="min-height:125px;">
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
            <?php include_once ('menu.php'); ?>
            <?php 
            $values = array('Backup' => '#');
            echo generate_site_breadcrumb($values); 
            ?>
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
						  <div class="btn-group" id="backup-restore-list-dt-filter">
						  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           My routers
						  </button>
						  <div class="dropdown-menu">
						  <?php
						  $celltuser_list = get_celltechusers_list($_SESSION['userid']);
						  foreach ($celltuser_list as $key => $value):
							if(isset($value['listname'])):
						  ?>
						  <a class="dropdown-item" href="#"><?php echo ($value['listname'] == "0") ? 'My routers' : $value['listname'] ; ?></a>
						  <?php
						  endif;
						  endforeach;
                            ?>
						  </div>
						</div>
						  <p id="cp1" style="display: none"></p>
                          <input type="hidden" id='userid' value="<?php echo $userid ?>" name="">
                          <div class="panel-body">
                            <table id="backuprestoredt"  class="table table-striped table-sm">
                              <thead>
                                <tr>
                                  <th class="noExport">Backup & Restore</th>
                                  <th>Device Name</th>
                                  <th>Site ID</th>
                                  <th>Site Name</th>
                                  <th>Region</th>
                                  <th>Market</th>
                                  <th>Device Series</th>
                                  <th>Version</th>
                                  <th>Backup</th>
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