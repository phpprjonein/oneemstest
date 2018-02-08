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
   <script src="resources/js/cellsitetech_discovery.js?t=".<?php echo date('his'); ?>></script>
 </head>
     <body>
<!-- container div -->
  <div class="container-fluid" id="disc-mgt-screen">
<?php include ('menu.php'); ?> 

        <!-- The Modal -->
		<div class="modal fade" id="myModal">
		  <div class="modal-dialog" >
			<div class="modal-content" id="manual-device-discovery">

			  <!-- Modal Header -->
		<div class="modal-header" id="restoremodalhdr">
        <h5 class="modal-title text-center"  id="modalLabelLarge">Manual Device Discovery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
			  <!-- Modal body -->
			  <div class="modal-body">
				
			  </div>

			  <!-- Modal footer -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>



<!-- 
      <div class="form-row align-items-center justify-content-between">

      <div class="col-auto">
        <div class="btn-group" id="discovery-region">
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

                    <div class="btn-group" id="discovery-market">
                      <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SELECT MARKET
                      </button>
                      <div class="dropdown-menu">
                      </div>
                    </div>


        <div class="col-6">
          
          <div class="input-group" id="search-v-pills-conflict">
            <input type="text" class="form-control" placeholder="Search Conflicts" aria-label="Search Region Table">
            <span class="input-group-btn">
              <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
            </span>
          </div>
          
          <div class="input-group" style="display: none;" id="search-v-pills-missed">
            <input type="text" class="form-control" placeholder="Search Missed" aria-label="Search Region Table">
            <span class="input-group-btn">
              <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
            </span>
          </div>
          
           <div class="input-group" style="display: none;" id="search-v-pills-new">
            <input type="text" class="form-control" placeholder="Search New" aria-label="Search Region Table">
            <span class="input-group-btn">
              <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
            </span>
          </div>
          
           <div class="input-group" style="display: none;" id="search-v-pills-ok">
            <input type="text" class="form-control" placeholder="Search OK" aria-label="Search Region Table">
            <span class="input-group-btn">
              <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
            </span>
          </div>
          
        </div>

      <div class="col-md-2 col-xs-6">
        <p class="export" id="export-v-pills-conflict"></p>
        <p class="export" id="export-v-pills-missed"></p>
        <p class="export" id="export-v-pills-new"></p>
        <p class="export" id="export-v-pills-ok"></p>
      </div>

      </div>

      <hr />
 -->


<!-- IP management table row -->
      <div class="row">

<!-- table pill navigation -->
        <div class="col col-md-2 col-sm-12">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!--
			<a class="nav-link btn-conflicts <?php /*if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Conflicts') || empty($_SESSION['disc_page_tab'])): */?>active<?php /*endif; */?>" id="v-pills-conflict-tab" data-toggle="pill" href="#v-pills-conflict" role="tab" aria-controls="v-pills-conflict" aria-selected="true">Conflicts</a>			
			-->
            <a class="nav-link btn-missed <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Missed')  || empty($_SESSION['disc_page_tab'])):?>active<?php endif;?>" id="v-pills-missed-tab" data-toggle="pill" href="#v-pills-missed" role="tab" aria-controls="v-pills-missed" aria-selected="false">Missed</a>
            <a class="nav-link btn-new <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'New'):?>active<?php endif;?>" id="v-pills-new-tab" data-toggle="pill" href="#v-pills-new" role="tab" aria-controls="v-pills-new" aria-selected="false">New</a>
            <a class="nav-link btn-ok <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'OK'):?>active<?php endif;?>" id="v-pills-ok-tab" data-toggle="pill" href="#v-pills-ok" role="tab" aria-controls="v-pills-ok" aria-selected="false">OK</a>
            <a class="nav-link btn-manual <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Manual Discovery'):?>active<?php endif;?>" id="v-pills-manual-tab" data-toggle="pill" href="#v-pills-manual" role="tab" aria-controls="v-pills-manual" aria-selected="false">Manual Discovery</a>
          </div>
        </div>
<!-- /table pill navigation -->

<!-- table content row -->
        <div class="col-11 col-md-10">

<!-- IP container div -->
          <div class="tab-content" id="v-pills-tabContent">

<!-- conflict table content
            <div class="tab-pane fade <?php /* if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Conflicts') || empty($_SESSION['disc_page_tab'])): */?>show active<?php /* unset($_SESSION['disc_page_tab']); endif; */?>" id="v-pills-conflict" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <table class="table table-responsive table-sm ip-conflict-table" id="ip-conflict-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">Source</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Site ID</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <th scope="col">Update</th>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    /*
                  	$resultset =  load_discovery_dataset('c'); 
                    if(isset($resultset['result'])){
                        foreach ($resultset['result'] as $key => $value){
                            if(test_ipv6_address($value['deviceIpAddr'])){
                                $value['ipvsix'] = $value['deviceIpAddr'];
                            }else{
                                $value['ipvfour'] = $value['deviceIpAddr'];
                            }*/
                            ?>
                        <tr><td><?php //echo $value['ipvfour'];?></td>
                        <td>Discovery</td>
                        <td><?php //echo $value['ipvsix'];?></td>
                        <td><?php //echo $value['devicename'];?></td>
                    	<td><?php //echo $value['csr_site_id'];?></td>
                        <td><?php //echo $value['csr_site_name'];?></td>
                        <td><?php //echo $value['deviceseries'];?></td>
                        <td><?php //echo $value['deviceos'];?></td>
                        <td><?php //echo $value['nodeVersion'];?></td>
                        <td><?php //echo $value['timepolled'];?></td>
						<td></td>
                        <td style="display:none;"><?php //echo $value['region'];?></td>
                        <td style="display:none;"><?php //echo $value['market'];?></td>
                        </tr>                          
                   <?php //}
                    //}
                    ?>
                </tbody>
              </table>
            </div>
conflict table content -->

<!-- missed table content -->
			<div class="tab-pane fade <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Missed') || empty($_SESSION['disc_page_tab'])):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>" id="v-pills-missed" role="tabpanel" aria-labelledby="v-pills-missed-tab">
              <table class="table table-sm table-striped ip-missed-table" id="ip-missed-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Site ID</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <th scope="col"><!-- Remove / Update --></th>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>                    
                  </tr>
                </thead>
                <tbody>
                <?php 
                  	$resultset =  load_discovery_dataset('m'); 
                    if(isset($resultset['result'])){
                        foreach ($resultset['result'] as $key => $value){
                            if(test_ipv6_address($value['deviceIpAddr'])){
                                $value['ipvsix'] = $value['deviceIpAddr'];
                            }else{
                                $value['ipvfour'] = $value['deviceIpAddr'];
                            }
                            ?>
                        <tr> <td><?php echo $value['ipvfour'];?></td>
                        <td><?php echo $value['ipvsix'];?></td>
                        <td><?php echo $value['devicename'];?></td>
                    	<td><?php echo $value['csr_site_id'];?></td>
                        <td><?php echo $value['csr_site_name'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeVersion'];?></td>	
                        <td><?php //echo $value['timepolled'];?><?php echo $value['lastpolled'];?></td>
						<td><!-- <button type="button"  data-toggle="modal" class="btn btn-danger missed_update">UPDATE</button> --></td>
                        <td style="display:none;"><?php echo $value['region'];?></td>
                        <td style="display:none;"><?php echo $value['market'];?></td></tr>                          
                   <?php }
                    }
                    ?>
                </tbody>
              </table>
            </div>
<!-- /missed table content -->

<!-- new table content -->
            <div class="tab-pane fade <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'New'):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>" id="v-pills-new" role="tabpanel" aria-labelledby="v-pills-new-tab">
              <table class="table table-striped ip-new-table" id="ip-new-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <th scope="col " style="display:none;">Add</th>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>
                    <th scope="col" style="display:none;">Upsince</th>
                    <th scope="col" style="display:none;">Site ID</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  	$resultset =  load_discovery_dataset('n'); 
                    if(isset($resultset['result'])){
                        foreach ($resultset['result'] as $key => $value){
                            if(test_ipv6_address($value['deviceIpAddr'])){
                                $value['ipvsix'] = $value['deviceIpAddr'];
                            }else{
                                $value['ipvfour'] = $value['deviceIpAddr'];
                            }
                            ?>
                        <tr> <td><?php echo $value['ipvfour'];?></td>
                        <td><?php echo $value['ipvsix'];?></td>
                        <td><?php echo $value['devicename'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeVersion'];?></td>
                        <td><?php echo($value['lastpolled']);?></td>
                    	<td><!--<button type="button" class="btn btn-danger addDeviceModal">ADD</button>--></td>
                        <td style="display:none;"><?php echo $value['region'];?></td>
                        <td style="display:none;"><?php echo $value['market'];?></td>
                        <td style="display:none;"><?php echo $value['upsince'];?></td>
                        <td style="display:none;"><?php echo $value['csr_site_id'];?></td>
                        </tr>                          
                   <?php }
                    }
                    ?>
                    </tbody></table>
            </div>
<!-- /new table content -->

<!-- ok table content -->
            <div class="tab-pane fade <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'OK'):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>" id="v-pills-ok" role="tabpanel" aria-labelledby="v-pills-ok-tab">
            	<?php $resultset =  load_discovery_dataset('k'); ?>
              <table id="ip-ok-table" class="table table-sm table-striped ip-ok-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Site ID</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <?php  if(count($resultset['result']) > 0): ?>
                    <th scope="col" style="display:none;"><a href="#" id="select_all" onclick="ok_all_item();">Select&nbsp;All</a></th>
                    <?php else:?>
                    <th scope="col" style="display:none;">Select&nbsp;All</th>
                    <?php endif; ?>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>
                  </tr>
                </thead>
                <tbody>
                  	<?php 
                    if(isset($resultset['result'])){
                        foreach ($resultset['result'] as $key => $value){
                            if(test_ipv6_address($value['deviceIpAddr'])){
                                $value['ipvsix'] = $value['deviceIpAddr'];
                            }else{
                                $value['ipvfour'] = $value['deviceIpAddr'];
                            }
                            ?>
                        <tr> <td><?php echo $value['ipvfour'];?></td>
                        <td><?php echo $value['ipvsix'];?></td>
                        <td><?php echo $value['devicename'];?></td>
                        <td><?php echo $value['csr_site_id'];?></td>
                        <td><?php echo $value['csr_site_name'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeVersion'];?></td>
                        <td><?php //echo $value['timepolled'];?><?php echo $value['lastpolled'];?></td>
                        <td style="display:none;">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?php echo $value['id'];?>">
                          </label>
                        </td>
                        <td style="display:none;"><?php echo $value['region'];?></td>
                        <td style="display:none;"><?php echo $value['market'];?></td></tr>                          
                   <?php }
                    }
                    ?>
                </tbody>
              </table>
            </div>
<!-- /ok table content -->


<div class="tab-pane fade <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Manual Discovery')):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>" id="v-pills-manual" role="tabpanel" aria-labelledby="v-pills-ok-manual">
<hr />
<div id="status" style="display: none;" class="alert"></div>
<div class="form-row align-items-center justify-content-center" id="manual-disc-utils">
<!-- region selection -->
		<form class="form-inline">
		               <div class="col-auto field">
		               <div class="form-group form-inline">  
                       <label class="control-label mr-2" for="inputDeviceIPaddress">Device IP Address</label>
                      <input type="deviceIPaddress" class="form-control inline" id="inputDeviceIPaddress">
                      </div>
                    </div>

      <div class="col-auto"> 
        <div class="btn-group" id="manual-disc-market">
          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SELECT MARKET
          </button>
          <div class="dropdown-menu">
          <?php 
          $market_list = generic_get_market_by_username($_SESSION['username']);
          foreach ($market_list['result'] as $rkey => $rvalue):
            if(!empty($rvalue['market'])):          
          ?>
          <a class="dropdown-item" href="#"><?php echo $rvalue['market']; ?></a>
          <?php 
          endif;
          endforeach;
          if(count($market_list['result']) > 0): ?>
          	<a class="dropdown-item" href="#">SELECT MARKET</a>
          <?php endif; ?>
          </div>
        </div>
      </div>
<!-- /region selection -->

<!-- add row button -->
      <div class="col-auto">
        <div class="form-check mb-2 mb-sm-0">
          <div class="btn-group" role="group" aria-label="">
            <button type="button" class="btn" id="manual-discovery" data-toggle="modal">Submit</button>
          </div>
        </div>
      </div>
<!-- /add row button -->

	</form>
    </div>
    
    <hr />
    
<!-- /table maniupulation row -->
             </div>
        </div>
        </div>
<!-- /IP container div -->

      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->

<?php include ('footer.php'); ?> 

<!-- Missed Modal -->
<div class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="Modal_Missed_Update" tabindex="-1" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal content-->
    <div class="modal-content">
    	      <div class="modal-header">
        <h5 class="modal-title">Remove or Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		  <div id="status" style="display: none;" class="alert"></div>
      	   <div id="ajax_loader" style="padding-left:45%;"><img src="resources/img/ajax-loader.gif" style="display: none;"></img></div>
           <div class="row" id="discovery-missed-ip" style="display: none;">
              <div class="col-auto">
                <div class="form-check mb-2 mb-sm-0">
                  <div id="response-txt"><h6></h6></div>	
                  <div class="btn-group" id="button-action" role="group" aria-label="">
                  			<input type="hidden" value="" name="missedDeviceIPaddress" id="missedDeviceIPaddress" />
                  	        <button type="button" class="btn btn-primary" value="OK" id="ip-ok">OK</button>&nbsp;&nbsp;&nbsp;
        					<button type="button" class="btn btn-primary" value="Ignore" id="ip-ignore">Ignore</button>&nbsp;&nbsp;&nbsp;
        					<button type="button" class="btn btn-primary" value="Remove" id="ip-remove">Remove From Master</button>
                  </div>
                </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- add device modal -->
  <div class="modal fade" id="addDeviceModal" tabindex="-1" role="dialog" aria-labelledby="addDeviceModalLabel" aria-hidden="true">

<!-- modal content container -->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

<!-- modal header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add device</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
<!-- /modal header -->

<!-- add device form -->
        <div class="modal-body">
        <div id="status" style="display: none;" class="alert">
		</div>
		
          <form>
              <div class="row">

<!-- left side -->
                <div class="col-lg-6 col-md-12 border">

<!-- first section -->
<!-- first row -->
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputRegion">Region</label>
                      <input type="regionName" class="form-control-plaintext" id="inputRegion" placeholder="Ohio" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="inputMarket">Market</label>
                      <input type="marketnName" class="form-control-plaintext" id="inputMarket" placeholder="OPW" readonly>
                    </div>
                  </div>
<!-- /first row -->
<!-- /first section -->

                  <hr />

<!-- second section -->
<!-- second row -->
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputDevicename">Device Name</label>
                      <input type="deviceName" class="form-control-plaintext" id="inputDevicename" placeholder="MSHWINBWT1A-P-CI-0090-01" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="inputDeviceIPaddress">Device IP Address</label>
                      <input type="deviceIPaddress" class="form-control-plaintext" id="inputDeviceIPaddress"  readonly>
                    </div>
                  </div>
<!-- /second row -->

<!-- third row -->
                  <div class="row">
                    <div class="col-md-12">
                      <label for="inputNodeAddedBy">Node Added By</label>
                      <input type="NodeAddedBy" class="form-control-plaintext" id="inputNodeAddedBy" value="<?php echo $_SESSION['username'];?>" placeholder="userID of Discovery Mgr" readonly>
                    </div>
                  </div>
<!-- /third row -->

<!-- fourth row -->
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputNodeCatID">Node Category</label>
                      <input type="NodeCatID" class="form-control-plaintext" id="inputNodeCatID" placeholder="Router" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="inputVendorID">Vendor</label>
                      <input type="model" class="form-control-plaintext" id="inputVendorID" placeholder="CISCO" readonly>
                    </div>
                  </div>
<!-- /fourth row -->

<!-- fifth row -->
                  <div class="row">
                    <div class="col-md-12">
                      <label for="inputDeviceSeries">Device Series</label>
                      <input type="model" class="form-control-plaintext" id="inputDeviceSeries" placeholder="ASR900" readonly>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                      <label for="inputNodeVersion">OS</label>
                      <input type="nodeVersion" class="form-control-plaintext" id="inputNodeVersion" placeholder="IOS-XE" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="inputDeviceStatus">Status</label>
                      <input type="deviceStatus" class="form-control-plaintext" id="inputDeviceStatus" value="Operational" placeholder="Operational" readonly>
                    </div>
                  </div>
<!-- /fifth row -->
<!-- /second section -->

                  <hr />

<!-- third section -->
<!-- sixth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputCSRSiteTechName">Tech Name</label>
                      <input type="CSRSiteTechName" class="form-control-plaintext" id="inputCSRSiteTechName" placeholder="Site Tech Name" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputCSRSiteTechMgrName">Tech Mgr Name</label>
                      <input type="CSRSiteTechMgrName" class="form-control-plaintext" id="inputCSRSiteTechMgrName" placeholder="Site Tech Mgr Name" readonly>
                    </div>
                  </div>
<!-- /sixth row -->

<!-- seventh row -->
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="inputCSRSiteID">Site Name</label>
                      <input type="CSRSiteID" class="form-control-plaintext" id="inputCSRSiteID" placeholder="Site Name" readonly>
                    </div>
                  </div>
<!-- /seventh row -->

                  <hr />

<!-- eighth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputDeviceDateAdded">Device Date Added</label>
                      <input type="lastPolled" class="form-control-plaintext" id="inputDeviceDateAdded" value="<?php echo date('m/d/y'); ?>" placeholder="Today()" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputDeviceLastUpdated">Device Last Updated</label>
                      <input type="upSince" class="form-control-plaintext" id="inputDeviceLastUpdated" value="<?php echo date('m/d/y H:i:s'); ?>" placeholder="dateTimeStamp of Discovery" readonly>
                    </div>
                  </div>
<!-- /eighth row -->

<!-- ninth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputLastPolled">Last Polled</label>
                      <input type="lastPolled" class="form-control-plaintext" id="inputLastPolled" placeholder="11/16/17 19:28" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputUpSince">Up Since</label>
                      <input type="upSince" class="form-control-plaintext" id="inputUpSince"  readonly>
                    </div>
                    <!--<div class="form-group col-md-4">
                      <label for="inputConnPort">Connection Port</label>
                      <input type="connPort" class="form-control-plaintext" id="inputConnPort" placeholder="PortShow" readonly>
                    </div>-->
                  </div>
<!-- /ninth row -->

<!-- tenth row -->
                  <div class="row">
				  <!--
                    <div class="form-group col-md-6">
                      <label for="inputSysName">System Name</label>
                      <input type="systemName" class="form-control-plaintext" id="inputSysName" placeholder="MSHWINBWT1A-P-CI-0090-01.verizonwireless.com" readonly>
                    </div>
					-->
                    <div class="form-group col-md-4">
                      <label for="inputDeviceOS">Device OS</label>
                      <input type="deviceOS" class="form-control-plaintext" id="inputDeviceOS" placeholder="auto derive from osypeTable" readonly>
                    </div>
                  </div>
<!-- /tenth row -->
<!-- /third section -->

                </div>
<!-- /left side -->

<!-- right side -->
                <div class="col-lg-6 col-md-12 border">
                <!-- first row -->
                  <div class="row">
                  	<div class="form-group col-md-6">
                      <label for="inputCSRSiteTechNameID">Tech Name</label>
                      <input type="inputCSRSiteTechNameID" class="form-control" id="inputCSRSiteTechNameID" placeholder="Site Tech Name">
                      <input type="hidden" value="" name="inputCSRSiteTechNameIDVal" id="inputCSRSiteTechNameIDVal">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputCSRSiteTechMgrNameID">Tech Mgr Name</label>
                      <input type="inputCSRSiteTechMgrNameID" class="form-control-plaintext" id="inputCSRSiteTechMgrNameID" placeholder="Site Tech Mgr Name" readonly>
                      <input type="hidden" value="" name="inputCSRSiteTechMgrNameIDVal" id="inputCSRSiteTechMgrNameIDVal">
                    </div>
                  </div>
<!-- /first row -->
<!--  selector -->
				<div class="row">
                    <div class="form-group col-md-6" id="tech-details">
                    <label for="inputCSRTechID">Existing</label>
                    <input type="radio" name="added-details" checked value="1"/>
                    <label for="inputCSRTechID">New</label>
                    <input type="radio" name="added-details" value="0"/>
                    </div>
                </div>
<!-- second row -->
                  <div class="row">
                    
                    <div class="form-group col-md-6">
                      <label for="inputCSRSiteName">Site Name</label>
                      <input type="inputCSRSiteName" class="form-control site-name-exist" id="inputCSRSiteName" placeholder="Site Name">
                      <input type="inputCSRTechID" style="display: none;" class="form-control-plaintext site-name-new" id="inputCSRSiteNameNew" placeholder="Site Name">
                    </div>
                    
					
                    <div class="col-md-6">
                        <?php 
                        $switch_names = generic_get_csr_switch_names();
                    	?>
                      <label for="inputSwitchName">Select Switch Name</label>
                      <select class="form-control" id="inputSwitchName">
                      <?php foreach ($switch_names['result'] as $key => $val){ ?>
                      <option value="<?php  echo $val['switch_name']; ?>"><?php  echo $val['switch_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
<!-- /second row -->





<!-- fourth row -->
                  <div class="row" id="discovery-new-ip">
                      <div class="col-auto">
                        <div class="form-check mb-2 mb-sm-0">
                          <div class="btn-group" role="group" aria-label="">
                            <button type="button" class="btn" value="Add New" id="add-new-ip">ADD NEW</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
<!-- /right side -->

              </div>
          </form>
        </div>

      </div>
    </div>
    
<!-- /add device modal -->
	</div>
         
    </body>
</html>
