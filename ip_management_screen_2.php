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

        <div class="wrapper">
            <?php include ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
							<!---
                            <div class="panel-heading"> My Devices List </div>
							-->
                          </div>                  
                          
 							<div id="mylist" class="panel-heading" style = "height:600px;"><b>Coming soon.</b>
								 <!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between">

<!-- region name -->
      <div class="col-auto">
        <b>REGION:</b> $Great Lakes$
      </div>
<!-- /region selection -->

<!-- add row button -->
      <div class="col-auto">
        <b>MARKET:</b> $Illinois / Wisconsin$
      </div>
<!-- /add row button -->

<!-- search table form field -->
      <div class="col-6">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Region Table" aria-label="Search Region Table">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </div>
<!-- /search table form field -->

<!-- Export table -->
      <div class="col-auto align-middle">
        <p class="export">
          <a href="#" title="Excel"><img src="resources/img/XLSX.jpg"></a>
          <a href="#" title="PDF"><img src="resources/img/pdf.jpg"></a>
        </p>
      </div>
<!-- /Export table -->

    </div>
<!-- /table maniupulation row -->

    <hr />

<!-- IP management table row -->
    <div class="row">

<!-- table content row -->
      <div class="col">

<!-- IP table content -->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">IP Address</th>
                  <th scope="col">Device Name</th>
                  <th scope="col">Site ID</th>
                  <th scope="col">Site Name</th>
                  <th scope="col">Device Series</th>
                  <th scope="col">OS</th>
                  <th scope="col">OS Version</th>
                  <th scope="col">Last Polled</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>10.203.144.152</td>
                  <td>MSHWINBWT1A-P-CI-0090-01</td>
                  <td>208090</td>
                  <td>ILWI NORTH POKAGON-CST-ARNOLD RL</td>
                  <td>Cisco ASR 1000</td>
                  <td>IOS-XE</td>
                  <td>15.6(1)S1</td>
                  <td>11/17/21 19:28</td>
                </tr>
                <tr>
                  <td>10.203.144.150</td>
                  <td>MSHWINBWT1A-P-CI-0091-01</td>
                  <td>208091</td>
                  <td>North Angola</td>
                  <td>Cisco ASR 1000</td>
                  <td>IOS-XE</td>
                  <td>15.6(1)S1</td>
                  <td>11/17/21 19:28</td>
                </tr>
                <tr>
                  <td>10.203.144.33</td>
                  <td>MSHWINBWT1A-P-CI-0101-01</td>
                  <td>101</td>
                  <td>SB NEW CARLISLE</td>
                  <td>Cisco ASR 1000</td>
                  <td>IOS-XE</td>
                  <td>15.6(1)S1</td>
                  <td>11/17/21 19:28</td>
                </tr>
                <tr>
                  <td>10.203.144.72</td>
                  <td>MSHWINBWT1A-P-CI-0102-01</td>
                  <td>102</td>
                  <td>SB NORTH LIBERTY</td>
                  <td>Cisco ASR 1000</td>
                  <td>IOS-XE</td>
                  <td>15.6(1)S1</td>
                  <td>11/17/21 19:28</td>
                </tr>
              </tbody>
            </table>

<!-- pagination -->
            <nav aria-label="Pagination example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
<!-- /pagination -->

          </div>
<!-- /IP table content -->

      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->
							
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
		
		<!-- add subnet mask modal -->

<!-- /add subnet mask modal -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
