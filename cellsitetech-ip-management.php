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
check_user_authentication(array(1,3));

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t="<?php echo date('his'); ?>></script>
   <script defer src="resources/js/all.js"></script>
 </head>
     <body>
        <!-- Modal HTML -->
        
        <div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
        </div>
        </div>

        <div class="container-fluid" id="ip-mgt-screen">
            <?php include ('menu.php'); ?> 

            <!-- Content Wrapper. Contains page content -->
            <div class="content">
                <!-- Main content -->
                <section class="content"> 
                  <div class="col-md-12">
                  <div id="main-status" style="display: none;" class="alert"></div>
                      <div class="panel"> 
                          <div class="panel-info">
                            <!-- Page title -->
							<!---
                            <div class="panel-heading"> My Devices List </div>
							-->
                          </div>                  
                          
								<!-- navigation tabs -->
   

    <hr />


<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-center">
		<div id="ajax_loader"><img src="resources/img/ajax-loader.gif"></img></div>
	</div>	
    <div class="form-row align-items-center justify-content-center" id="ip-mgt-utils" style="display: none;">
<!-- region selection -->
      <div class="col-auto"> 
      
        <div class="btn-group" id="ip-allocation-region">
          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SELECT REGION
          </button>
          <div class="dropdown-menu">
          <?php 
          $region_list = get_ipallocation_region_list();
          foreach ($region_list['result'] as $rkey => $rvalue):
            if(!empty($rvalue['region'])):          
          ?>
          <a class="dropdown-item" href="#"><?php echo $rvalue['region']; ?></a>
          <?php 
          endif;
          endforeach;
          if(count($region_list['result']) > 1): ?>
          	<a class="dropdown-item" href="#">SELECT REGION</a>
          <?php endif; ?>
          </div>
        </div>
      </div>
<!-- /region selection -->


<!-- add row button -->
      <div class="col-auto">
        <div class="form-check mb-2 mb-sm-0">
          <div class="btn-group" role="group" aria-label="">
            <!--<button type="button" class="btn btn-danger">ADD A SUBNET</button>-->
            <button type="button" class="btn" id="add-a-subnet" data-toggle="modal">ADD A SUBNET</button>
          </div>
        </div>
      </div>
<!-- /add row button -->
<!-- Export table -->
      <div class="col-auto align-middle">

      </div>
<!-- /Export table -->

    </div>
<!-- /table maniupulation row -->

    <hr />
<!-- IP management table row -->
    <div class="row">

<!-- table pill navigation -->
      <div class="col-1 col-xs-6">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">IPv4</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="display:none;">IPv6</a>
        </div>
      </div>
<!-- /table pill navigation -->
<!-- region selection -->
<div class="col-md-3 col-xs-6">
      
        <div class="btn-group" id="ip-allocation-region-dt-filter">
          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Great Lakes
          </button>
          <div class="dropdown-menu">
          <?php 
          $region_list = get_ipallocation_region_list();
          foreach ($region_list['result'] as $rkey => $rvalue):
            if(!empty($rvalue['region'])):          
          ?>
          <a class="dropdown-item" href="#"><?php echo $rvalue['region']; ?></a>
          <?php 
          endif;
          endforeach;
          //if(count($region_list['result']) > 1): ?>
          <!-- 	<a class="dropdown-item" href="#">SELECT REGION</a>  -->
          <?php //endif; ?>
          </div>
        </div>
      </div>
<!-- /region selection -->

<!-- search table form field -->
      <div class="col">
        <div class="input-group" id="search-v-pills-home">
          <input type="text" class="form-control" placeholder="Search IP V4 Table" aria-label="Search Table">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
        <div class="input-group" style="display: none;" id="search-v-pills-profile">
          <input type="text" class="form-control" placeholder="Search IP V6 Table" aria-label="Search Table">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
        
      </div>
<!-- /search table form field -->
<!-- Export table -->
      <div class="col-md-2 col-xs-6">
        <p class="export" id="export-v-pills-home">
        </p>
        <p class="export" id="export-v-pills-profile">
        </p>
      </div>
<!-- /Export table -->
</div>
<!-- IP management table row -->
    <div class="row">

<!-- table pill navigation 
      <div class="col-1">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">IPv4</a>
          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">IPv6</a>
        </div>
      </div>
table pill navigation -->

<!-- table content row -->
      <div class="col-12">

        <div class="tab-content" id="v-pills-tabContent">

<!-- IPv4 table content -->
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <table id="ipmgt-ipv4" class="table table-striped table-sm">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Market</th>
                  <th scope="col" style="display:none;">Region</th>
                  <th scope="col" class="table_center_text">From</th>
                  <th scope="col">Count</th>
                  <th scope="col" class="table_center_text">To</th>
                  <th scope="col">Subnet</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <?php $resultset =  load_ipv_dataset('ipv4'); 
              if(isset($resultset['result'])){
                  foreach ($resultset['result'] as $key => $value){
                      $ipvfour_details = getipvfour_details($value['subnetmask']);
                        echo '<tr>
                          <td scope="row" class="">'.$value['market'].'</td>
                          <td style="display:none;">'.$value['region'].'</td>
                          <td>'.$ipvfour_details[0].'</td>
                          <td>'.count($ipvfour_details).'</td>
                          <td>'.$ipvfour_details[count($ipvfour_details)-1].'</td>
                          <td>'.$value['subnetmask'].'</td>
                          <td>
                            <a href="#" id="deleteip" class="btn">Delete</a>
                          </td>
                          <td>     
                            <a href="ip-v4-more-details.php?region='.$value['region'].'&market='.$value['market'].'&subnetmask='.$value['subnetmask'].'" class="btn">GO</a>
                          </td>
                        </tr>';
                  }
                }
              ?>
              </tbody>
            </table>



          </div>
<!-- /IPv4 table content -->

<!-- IPv6 table content -->
          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <table id="ipmgt-ipv6" class="table table-striped table-sm table-responsive ipv6-table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Market</th>
                  <th scope="col" style="display:none;">Region</th>
                  <th scope="col" class="table_center_text">From</th>
                  <th scope="col">Count</th>
                  <th scope="col" class="table_center_text">To</th>
                  <th scope="col">Subnet</th>
                  <th scope="col"></th>
                </tr>
              </thead
              <tbody>
              <?php $resultset =  load_ipv_dataset('ipv6'); 
              if(isset($resultset['result'])){
                  foreach ($resultset['result'] as $key => $value){
                        $ipvsix_details = getipvsix_details($value['subnetmask']);
                        echo '<tr>
                          <td scope="row" class="">'.$value['market'].'</td>
                          <td style="display:none;">'.$value['region'].'</td>  
                          <td>'.$ipvsix_details['fromipvsix'].'</td>
                          <td>'.$ipvsix_details['count'].'</td>
                          <td>'.$ipvsix_details['toipvsix'].'</td>
                          <td>'.$value['subnetmask'].'</td>
                          <td>
                            <a href="ip-v6-more-details.php?region='.$value['region'].'&market='.$value['market'].'&subnetmask='.$value['subnetmask'].'" class="btn">GO</a>
                          </td>
                        </tr>';
                  }
                }
              ?>
              </tbody>
            </table>



          </div>
<!-- /IPv6 table content -->

        </div>
      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->
							

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
<div class="modal fade" id="exampleModalIPM" tabindex="-1" role="dialog" aria-labelledby="exampleModalIPMLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalIPMLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="selected_region" id="selected_region" value="">
      <input type="hidden" name="selected_market" id="selected_market" value="">
        <!-- add subnet mask form -->
	<div id="status" style="display: none;" class="alert"></div>
<div class="alert alert-success" style="display:none;">
  IP details added successfully.
</div>
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
                    <div class="btn-group" id="ip-allocation-market">
                      <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SELECT MARKET
                      </button>
                      <div class="dropdown-menu">

                      </div>
                    </div>
<!-- /market dropdown -->

                  </td>
                  <td id="compute-from-ip">{{from IP}}</td>
                  <td id="compute-count">{{Count}}</td>
                  <td id="compute-to-ip">{{to IP}}</td>
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
            <button type="button" class="btn">ADD</button>
          </div>
        </div>
      </div>
  </div>
<!-- /add subnet mask modal -->

         <?php include ('footer.php'); ?> 
    </body>
</html>
