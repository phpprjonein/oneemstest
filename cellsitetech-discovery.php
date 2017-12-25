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
        <div class="col-1">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link btn-conflicts" id="v-pills-conflict-tab" data-toggle="pill" href="#v-pills-conflict" role="tab" aria-controls="v-pills-conflict" aria-selected="true">Conflicts</a>
            <a class="nav-link btn-missed" id="v-pills-missed-tab" data-toggle="pill" href="#v-pills-missed" role="tab" aria-controls="v-pills-missed" aria-selected="false">Missed</a>
            <a class="nav-link btn-new" id="v-pills-new-tab" data-toggle="pill" href="#v-pills-new" role="tab" aria-controls="v-pills-new" aria-selected="false">New</a>
            <a class="nav-link btn-ok active" id="v-pills-ok-tab" data-toggle="pill" href="#v-pills-ok" role="tab" aria-controls="v-pills-ok" aria-selected="false">OK</a>
          </div>
        </div>
<!-- /table pill navigation -->

<!-- table content row -->
        <div class="col-11">

<!-- IP container div -->
          <div class="tab-content" id="v-pills-tabContent">

<!-- conflict table content -->
            <div class="tab-pane fade" id="v-pills-conflict" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
                  	$resultset =  load_discovery_dataset('c'); 
                    if(isset($resultset['result'])){
                        foreach ($resultset['result'] as $key => $value){
                            if(test_ipv6_address($value['deviceIpAddr'])){
                                $value['ipvsix'] = $value['deviceIpAddr'];
                            }else{
                                $value['ipvfour'] = $value['deviceIpAddr'];
                            }
                            ?>
                        <tr> <td><?php echo $value['ipvfour'];?></td>
                        <td>Discovery</td>
                        <td><?php echo $value['ipvsix'];?></td>
                        <td><?php echo $value['devicename'];?></td>
                    	<td><?php echo $value['site_id'];?></td>
                        <td><?php echo $value['site_name'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeversion'];?></td>
                        <td><?php echo $value['timepolled'];?></td>
						<td></td>
                        <td style="display:none;"><?php echo $value['region'];?></td>
                        <td style="display:none;"><?php echo $value['market'];?></td></tr>                          
                   <?php }
                    }
                    ?>
                </tbody>
              </table>
            </div>
<!-- /conflict table content -->

<!-- missed table content -->
            <div class="tab-pane fade" id="v-pills-missed" role="tabpanel" aria-labelledby="v-pills-missed-tab">
              <table class="table table-sm table-responsive table-striped ip-missed-table" id="ip-missed-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">ICMP</th>
                    <th scope="col">SNMP</th>
                    <th scope="col">Site ID</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <th scope="col">Remove / Update</th>
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
                        <td>P</td>
                    	<td>F</td>
                    	<td><?php echo $value['site_id'];?></td>
                        <td><?php echo $value['site_name'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeversion'];?></td>
                        <td><?php echo $value['timepolled'];?></td>
						<td><button type="button" class="btn btn-danger">UPDATE</button></td>
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
            <div class="tab-pane fade" id="v-pills-new" role="tabpanel" aria-labelledby="v-pills-new-tab">
              <table class="table table-responsive table-striped ip-new-table" id="ip-new-table">
                <thead>
                  <tr>
                    <th scope="col">IPv4 Address</th>
                    <th scope="col">IPv6 Address</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Device Series</th>
                    <th scope="col">OS</th>
                    <th scope="col">OS Version</th>
                    <th scope="col">Last Polled</th>
                    <th scope="col">Add</th>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>
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
                        <td><?php echo $value['nodeversion'];?></td>
                        <td><?php echo $value['timepolled'];?></td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addDeviceModal">ADD</button></td>
                        <td style="display:none;"><?php echo $value['region'];?></td>
                        <td style="display:none;"><?php echo $value['market'];?></td></tr>                          
                   <?php }
                    }
                    ?>
                    </tbody></table>
            </div>
<!-- /new table content -->

<!-- ok table content -->
            <div class="tab-pane fade show active" id="v-pills-ok" role="tabpanel" aria-labelledby="v-pills-ok-tab">
              <table id="ip-ok-table" class="table table-sm table-responsive table-striped ip-ok-table">
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
                    <th scope="col"><a href="#" id="select_all" onclick="ok_all_item();">Select&nbsp;All</a></th>
                    <th scope="col" style="display:none;">Region</th>
                    <th scope="col" style="display:none;">Market</th>
                  </tr>
                </thead>
                <tbody>
                  	<?php 
                  	$resultset =  load_discovery_dataset('k'); 
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
                        <td><?php echo $value['site_id'];?></td>
                        <td><?php echo $value['site_name'];?></td>
                        <td><?php echo $value['deviceseries'];?></td>
                        <td><?php echo $value['deviceos'];?></td>
                        <td><?php echo $value['nodeversion'];?></td>
                        <td><?php echo $value['timepolled'];?></td>
                        <td>
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

        </div>
        </div>
<!-- /IP container div -->

      </div>
<!-- /table content row -->

    </div>
<!-- /IP management table row -->


<!-- add device modal -->
  <div class="modal fade" id="addDeviceModal" tabindex="-1" role="dialog" aria-labelledby="addDeviceModalLabel" aria-hidden="true">

<!-- modal content container -->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

<!-- modal header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD A DEVICE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
<!-- /modal header -->

<!-- add device form -->
        <div class="modal-body">
          <form>
              <div class="row">

<!-- left side -->
                <div class="col-lg-6 col-md-12 border">

<!-- first section -->
<!-- first row -->
                  <div class="row">
                    <div class="col-md-6">
                      <label for="inputRegion">Region</label>
                      <input type="regionName" class="form-control-plaintext" id="inputRegion" placeholder="Ohio" >
                    </div>
                    <div class="col-md-6">
                      <label for="inputMarket">Market</label>
                      <input type="marketnName" class="form-control-plaintext" id="inputMarket" placeholder="OPW" >
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
                      <input type="deviceName" class="form-control-plaintext" id="inputDevicename" placeholder="MSHWINBWT1A-P-CI-0090-01" >
                    </div>
                    <div class="col-md-6">
                      <label for="inputDeviceIPaddress">Device IP Address</label>
                      <input type="deviceIPaddress" class="form-control-plaintext" id="inputDeviceIPaddress" placeholder="10.203.144.152" >
                    </div>
                  </div>
<!-- /second row -->

<!-- third row -->
                  <div class="row">
                    <div class="col-md-12">
                    	<?php 
                    	$managers = get_managers();
                    	?>
                      <label for="inputNodeAddedBy">Node Added By</label>
                      <select class="form-control" id="inputNodeAddedBy">
                      <?php foreach ($managers['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_tech_mgr_id']; ?>"><?php  echo $val['csr_site_tech_mgr_name']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                  </div>
<!-- /third row -->

<!-- fourth row -->
                  <div class="row">
                    <div class="col-md-6">
                    	<?php 
                    	$categories = generic_get_categories();
                    	?>
                      <label for="inputNodeCatID">Node Category</label>
                      <select class="form-control" id="inputNodeCatID">
                      <?php foreach ($categories['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['id']; ?>"><?php  echo $val['categoryName']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                        <?php 
                        $vendors = generic_get_vendors();
                    	?>
                      <label for="inputVendorID">Vendor</label>
                      <select class="form-control" id="inputVendorID">
                      <?php foreach ($vendors['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['id']; ?>"><?php  echo $val['vendorName']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                  </div>
<!-- /fourth row -->

<!-- fifth row -->
                  <div class="row">
                    <div class="col-md-4">
                      <label for="inputModel">Model</label>
                      <input type="model" class="form-control-plaintext" id="inputModel" placeholder="Cisco" >
                    </div>
                    <div class="col-md-4">
                      <label for="inputDeviceSeries">Device Series</label>
                      <input type="model" class="form-control-plaintext" id="inputDeviceSeries" placeholder="ASR900" >
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                      <label for="inputNodeVersion">OS</label>
                      <input type="nodeVersion" class="form-control-plaintext" id="inputNodeVersion" placeholder="IOS-XE" >
                    </div>
                    <div class="col-md-4">
                      <label for="inputDeviceStatus">Status</label>
                      <select class="form-control" id="inputDeviceStatus">
                      <option value="1">Active</option>
                      <option value="0">In-Active</option>
                      <option value="2">Unknown</option>
                      </select>
                    </div>
                  </div>
<!-- /fifth row -->
<!-- /second section -->

                  <hr />

<!-- third section -->
<!-- sixth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                        <?php 
                        $technames = get_csr_technames();
                    	?>
                      <label for="inputCSRSiteTechName">Tech Name</label>
                      <select class="form-control" id="inputCSRSiteTechName">
                      <?php foreach ($technames['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_tech_name']; ?>"><?php  echo $val['csr_site_tech_name']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                    
                    
                    <div class="form-group col-md-6">
                        <?php 
                    	$managers = get_managers();
                    	?>
                      <label for="inputCSRSiteTechMgrName">Tech Mgr Name</label>
                      <select class="form-control" id="inputCSRSiteTechMgrName">
                      <?php foreach ($managers['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_tech_mgr_name']; ?>"><?php  echo $val['csr_site_tech_mgr_name']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  
                  
<!-- /sixth row -->

<!-- seventh row -->
                  <div class="row">
                    <div class="form-group col-md-12">
                        <?php 
                        $site_ids = generic_get_site_ids();
                    	?>
                      <label for="inputCSRSiteID">Site ID</label>
                      <select class="form-control" id="inputCSRSiteID">
                      <?php foreach ($site_ids['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_id']; ?>"><?php  echo $val['csr_site_id']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                  </div>
<!-- /seventh row -->

                  <hr />

<!-- eighth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputLastPolled">Device Date Added</label>
                      <input type="lastPolled" class="form-control-plaintext" id="inputLastPolled" placeholder="Today()" >
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputUpSince">Device Last Updated</label>
                      <input type="upSince" class="form-control-plaintext" id="inputUpSince" placeholder="dateTimeStamp of Discovery" >
                    </div>
                  </div>
<!-- /eighth row -->

<!-- ninth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputLastPolled">Last Polled</label>
                      <input type="lastPolled" class="form-control-plaintext" id="inputLastPolled" placeholder="11/16/17 19:28" >
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputUpSince">Up Since</label>
                      <input type="upSince" class="form-control-plaintext" id="inputUpSince" placeholder="sysUptime" >
                    </div>
                    <!--<div class="form-group col-md-4">
                      <label for="inputConnPort">Connection Port</label>
                      <input type="connPort" class="form-control-plaintext" id="inputConnPort" placeholder="PortShow" >
                    </div>-->
                  </div>
<!-- /ninth row -->

<!-- tenth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputSysName">System Name</label>
                      <input type="systemName" class="form-control-plaintext" id="inputSysName" placeholder="MSHWINBWT1A-P-CI-0090-01.verizonwireless.com" >
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputDeviceOS">Device OS</label>
                      <input type="deviceOS" class="form-control-plaintext" id="inputDeviceOS" placeholder="auto derive from osypeTable" >
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
                        <?php 
                        $technames = get_csr_technames();
                    	?>
                      <label for="inputCSRTechID">Tech ID</label>
                      <select class="form-control" id="inputCSRTechID">
                      <?php foreach ($technames['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_tech_id']; ?>"><?php  echo $val['csr_site_tech_id']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                        <?php 
                    	$managers = get_managers();
                    	?>
                      <label for="inputCSRMgrID">Tech Manager ID</label>
                      <select class="form-control" id="inputCSRMgrID">
                      <?php foreach ($managers['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_tech_mgr_id']; ?>"><?php  echo $val['csr_site_tech_mgr_id']; ?></option>	
                      <?php } ?>
                      </select>
                    </div>
                  </div>
<!-- /first row -->

<!-- second row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                        <?php 
                        $site_names = generic_get_csr_site_names();
                    	?>
                      <label for="inputCSRSiteName">Site Name</label>
                      <select class="form-control" id="inputCSRSiteName">
                      <?php foreach ($site_names['result'] as $key => $val){ ?>
                      	<option value="<?php  echo $val['csr_site_name']; ?>"><?php  echo $val['csr_site_name']; ?></option>	
                      <?php } ?>
                      </select>
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

<!-- third row -->
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="inputInvestigationState">Investigation State</label>
                      <select class="form-control" id="inputInvestigationState">
                        <option value="Operational">Operational</option>
                        <option value="Suspended">Suspended</option>
                      </select>
                    </div>
                    <div class="form-check col-md-3">
                      <label for="inputSeverity">Severity</label>
                        <select class="form-control" id="inputSeverity">
                          <option value="Low">Low</option>
                          <option value="Medium">Medium</option>
                          <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputUnacknowledged">Unacknowledged</label>
                      <select class="form-control" id="inputUnacknowledged">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                    </div>
                  </div>
<!-- /third row -->
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
<!-- /third row -->
                </div>
<!-- /right side -->

              </div>
          </form>
        </div>

      </div>
    </div>
    </div>
<!-- /add device modal -->

         <?php include ('footer.php'); ?> 
    </body>
</html>
