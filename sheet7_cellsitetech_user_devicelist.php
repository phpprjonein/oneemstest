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
								<!-- navigation tabs -->
   

    <hr />

<!-- IP management summary table row -->
    <div class="row">

<!-- region name display -->
      <div class="col-lg-2">
        <div class="card">
          <div class="card-body">
            REGION:
            <hr />
            <b>Ohio</b>
          </div>
        </div>
      </div>
<!-- /region name display -->

<!-- region table display -->
      <div class="col-lg-10">
        <table class="table table-sm table-bordered">
          <thead class="thead-light">
            <tr>
              <th scope="col">Market</th>
              <th scope="col">Allocated</th>
              <th scope="col">Consumed</th>
              <th scope="col">Unused</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OPW</td>
              <td>130</td>
              <td>29255; 234; AKROOH20T1A-P-CI-0003-01</td>
              <td>0</td>
            </tr>
            <tr>
              <td>OPW</td>
              <td>307</td>
              <td>29255; 234; AKROOH20T1A-P-CI-0003-01</td>
              <td>34</td>
            </tr>
            <tr>
              <td>OPW</td>
              <td>5660</td>
              <td>29255; 234; AKROOH20T1A-P-CI-0003-01</td>
              <td>255</td>
            </tr>
          </tbody>
        </table>
      </div>
<!-- /region table display -->

    </div>
<!-- /IP management summary table row -->

<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between">

<!-- region selection -->
      <div class="col-auto">
        <div class="btn-group">
          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SELECT REGION
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Ohio</a>
            <a class="dropdown-item" href="#">OPW-EAST</a>
            <a class="dropdown-item" href="#">Outer Illinois</a>
          </div>
        </div>
      </div>
<!-- /region selection -->

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

<!-- add row button -->
      <div class="col-auto">
        <div class="form-check mb-2 mb-sm-0">
          <div class="btn-group" role="group" aria-label="">
            <!--<button type="button" class="btn btn-danger">ADD A SUBNET</button>-->
            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">ADD A SUBNET</button>
          </div>
        </div>
      </div>
<!-- /add row button -->

<!-- Export table -->
      <div class="col-auto align-middle">
        <p class="export">
          <a href="#" title="Excel"><img src="resources/img/xlsx.jpg"></a>
          <a href="#" title="PDF"><img src="resources/img//pdf.jpg"></a>
        </p>
      </div>
<!-- /Export table -->

    </div>
<!-- /table maniupulation row -->

    <hr />

<!-- IP management table row -->
    <div class="row">

<!-- table pill navigation -->
      <div class="col-1">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">IPv4</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">IPv6</a>
        </div>
      </div>
<!-- /table pill navigation -->

<!-- table content row -->
      <div class="col-11">

        <div class="tab-content" id="v-pills-tabContent">

<!-- IPv4 table content -->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Market</th>
                  <th scope="col" class="table_center_text">From</th>
                  <th scope="col">Count</th>
                  <th scope="col" class="table_center_text">To</th>
                  <th scope="col">Subnet</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="">
                    OPW
                  </th>
                  <td>10.202.90.0</td>
                  <td>255</td>
                  <td>10.202.90.255</td>
                  <td>10.202.90.0/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>10.202.90.0</td>
                  <td>255</td>
                  <td>10.202.90.255</td>
                  <td>10.202.90.0/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">OPW</th>
                  <td>10.202.90.0</td>
                  <td>255</td>
                  <td>10.202.90.255</td>
                  <td>10.202.90.0/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">OPW</th>
                  <td>10.202.90.0</td>
                  <td>255</td>
                  <td>10.202.90.255</td>
                  <td>10.202.90.0/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>10.202.90.0</td>
                  <td>255</td>
                  <td>10.202.90.255</td>
                  <td>10.202.90.0/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
              </tbody>
            </table>

<!-- pagination -->
            <nav aria-label="Page navigation example">
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
<!-- /IPv4 table content -->

<!-- IPv6 table content -->
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <table class="table table-striped table-sm table-responsive ipv6-table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Market</th>
                  <th scope="col" class="table_center_text">From</th>
                  <th scope="col">Count</th>
                  <th scope="col" class="table_center_text">To</th>
                  <th scope="col">Subnet</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>255</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>255</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>255</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>255</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B/24</td>
                  <td>
                    <button type="button" class="btn">GO</button>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    OPW
                  </th>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>255</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                  <td>2001:0DB8:130F:0000:0000:7000:0000:140B/24</td>
                  <td>
                    <button type="button" class="btn ">GO</button>
                  </td>
                </tr>
              </tbody>
            </table>

<!-- pagination -->
            <nav aria-label="Page navigation example">
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
<!-- /IPv6 table content -->

        </div>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD A SUBNET IN $REGION$</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- add subnet mask form -->

<table class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col-1"></th>
                  <th scope="col-1" colspan="3" class="table_center_text">RANGE</th>

                  <th scope="col-1" class="table_center_text">ADD SUBNET</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>

<!-- market dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SELECT MARKET
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Ohio</a>
                        <a class="dropdown-item" href="#">OPW-EAST</a>
                        <a class="dropdown-item" href="#">Outer Illinois</a>
                      </div>
                    </div>
<!-- /market dropdown -->

                  </td>
                  <td>172.202.190.0</td>
                  <td>255</td>
                  <td>172.202.190.255</td>
                  <td>
                    <div class="row">
                      <div class="col-lg-8 col-md-12 col-sm-12">
                        <input type="email" class="form-control" id="inputSubnet" placeholder="SUBNET">
                      </div>
                      <div class="col-lg-1 d-none d-xl-block">
                        <label for="inputMask">/</label>
                      </div>
                      <div class="col-lg-3 col-md-12 col-sm-12">
                        <input type="email" class="form-control" id="inputMask" placeholder="MASK">
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

<!-- /add subnet mask form -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn">COMPUTE</button>
            <button type="button" class="btn" disabled>ADD</button>
          </div>
        </div>
      </div>
  </div>
<!-- /add subnet mask modal -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
