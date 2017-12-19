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
     <body class="hold-transition skin-blue sidebar-mini ownfont">
<!-- container div -->
  <div class="container-fluid" id="disc-mgt-screen">
<?php include ('menu.php'); ?> 

<!-- table manipulation row -->
      <div class="form-row align-items-center justify-content-between">

<!-- region selection -->
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
<!-- /region selection -->

<!-- market dropdown -->
                    <div class="btn-group" id="discovery-market">
                      <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SELECT MARKET
                      </button>
                      <div class="dropdown-menu">
                      </div>
                    </div>
<!-- /market dropdown -->

<!-- search table form field -->

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
<!-- /search table form field -->

<!-- Export table -->
      <div class="col-md-2 col-xs-6">
        <p class="export" id="export-v-pills-conflict"></p>
        <p class="export" id="export-v-pills-missed"></p>
        <p class="export" id="export-v-pills-new"></p>
        <p class="export" id="export-v-pills-ok"></p>
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
            <a class="nav-link btn-conflicts active" id="v-pills-conflict-tab" data-toggle="pill" href="#v-pills-conflict" role="tab" aria-controls="v-pills-conflict" aria-selected="true">Conflicts</a>
            <a class="nav-link btn-missed" id="v-pills-missed-tab" data-toggle="pill" href="#v-pills-missed" role="tab" aria-controls="v-pills-missed" aria-selected="false">Missed</a>
            <a class="nav-link btn-new" id="v-pills-new-tab" data-toggle="pill" href="#v-pills-new" role="tab" aria-controls="v-pills-new" aria-selected="false">New</a>
            <a class="nav-link btn-ok" id="v-pills-ok-tab" data-toggle="pill" href="#v-pills-ok" role="tab" aria-controls="v-pills-ok" aria-selected="false">OK</a>
          </div>
        </div>
<!-- /table pill navigation -->

<!-- table content row -->
        <div class="col-11">

<!-- IP container div -->
          <div class="tab-content" id="v-pills-tabContent">

<!-- conflict table content -->
            <div class="tab-pane fade show active" id="v-pills-conflict" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
                    <th scope="col">Region</th>
                    <th scope="col">Market</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10.203.144.152</td>
                    <td>Discovery</td>
                    <td>2001:db8:abcd:0012:2001:db8:abcd:0012</td>
                    <td>AUVNINBWT1A-P-CI-0090-01</td>
                    <td>208090</td>
                    <td>ILWI NORTH POKAGON-CST-ARNOLD RL</td>
                    <td>Cisco ASR 1000</td>
                    <td>IOS-XE</td>
                    <td>15.6(1)S1</td>
                    <td>11/16/17 19:28</td>
                    <td></td>
                    <td>Great Lakes</td>
                    <td>OPW</td>
                  </tr>
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
                    <th scope="col">Region</th>
                    <th scope="col">Market</th>                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10.203.144.152</td>
                    <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                    <td>MSHWINBWT1A-P-CI-0090-01</td>
                    <td>P</td>
                    <td>F</td>
                    <td>208090</td>
                    <td>ILWI NORTH POKAGON-CST-ARNOLD RL</td>
                    <td>Cisco ASR 1000</td>
                    <td>IOS-XE</td>
                    <td>15.6(1)S1</td>
                    <td>11/16/17 19:28</td>
                    <td><button type="button" class="btn btn-danger">UPDATE</button></td>
                    <td>Great Lakes</td>
                    <td>OPW</td>
                  </tr>
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
                    <th scope="col">Region</th>
                    <th scope="col">Market</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10.203.144.152</td>
                    <td>2001:0DB8:130F:0000:0000:7000:0000:140B</td>
                    <td>MSHWINBWT1A-P-CI-0090-01</td>
                    <td>Cisco ASR 1000</td>
                    <td>IOS-XE</td>
                    <td>15.6(1)S1</td>
                    <td>11/16/17 19:28</td>
                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addDeviceModal">ADD</button></td>
                    <td>Great Lakes</td>
                    <td>OPW</td>
                  </tr>
                </tbody>
              </table>
            </div>
<!-- /new table content -->

<!-- ok table content -->
            <div class="tab-pane fade" id="v-pills-ok" role="tabpanel" aria-labelledby="v-pills-ok-tab">
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
                    <th scope="col">Select All</th>
                    <th scope="col">Region</th>
                    <th scope="col">Market</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>10.203.144.152</td>
                    <td>2001:db8:abcd:0012:2001:db8:abcd:0012</td>
                    <td>MSHWINBWT1A-P-CI-0090-01</td>
                    <td>208090</td>
                    <td>ILWI NORTH POKAGON-CST-ARNOLD RL</td>
                    <td>Cisco ASR 1000</td>
                    <td>IOS-XE</td>
                    <td>15.6(1)S1</td>
                    <td>11/16/17 19:28</td>
                    <td>
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                      </label>
                    </td>
                    <td>Great Lakes</td>
                    <td>OPW</td>
                  </tr>
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
                      <input type="deviceIPaddress" class="form-control-plaintext" id="inputDeviceIPaddress" placeholder="10.203.144.152" readonly>
                    </div>
                  </div>
<!-- /second row -->

<!-- third row -->
                  <div class="row">
                    <div class="col-md-12">
                      <label for="inputNodeAddedBy">Node Added By</label>
                      <input type="NodeAddedBy" class="form-control-plaintext" id="inputNodeAddedBy" placeholder="userID of Discovery Mgr" readonly>
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
                    <div class="col-md-4">
                      <label for="inputModel">Model</label>
                      <input type="model" class="form-control-plaintext" id="inputModel" placeholder="Cisco" readonly>
                    </div>
                    <div class="col-md-4">
                      <label for="inputDeviceSeries">Device Series</label>
                      <input type="model" class="form-control-plaintext" id="inputDeviceSeries" placeholder="ASR900" readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="inputNodeVersion">OS</label>
                      <input type="nodeVersion" class="form-control-plaintext" id="inputNodeVersion" placeholder="IOS-XE" readonly>
                    </div>
                    <div class="col-md-2">
                      <label for="inputDeviceStatus">Status</label>
                      <input type="deviceStatus" class="form-control-plaintext" id="inputDeviceStatus" placeholder="1" readonly>
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
                      <label for="inputCSRSiteTechName">Site ID</label>
                      <input type="CSRSiteID" class="form-control-plaintext" id="inputCSRSiteID" placeholder="Site ID" readonly>
                    </div>
                  </div>
<!-- /seventh row -->

                  <hr />

<!-- eighth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputLastPolled">Device Date Added</label>
                      <input type="lastPolled" class="form-control-plaintext" id="inputLastPolled" placeholder="Today()" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputUpSince">Device Last Updated</label>
                      <input type="upSince" class="form-control-plaintext" id="inputUpSince" placeholder="dateTimeStamp of Discovery" readonly>
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
                      <input type="upSince" class="form-control-plaintext" id="inputUpSince" placeholder="sysUptime" readonly>
                    </div>
                    <!--<div class="form-group col-md-4">
                      <label for="inputConnPort">Connection Port</label>
                      <input type="connPort" class="form-control-plaintext" id="inputConnPort" placeholder="PortShow" readonly>
                    </div>-->
                  </div>
<!-- /ninth row -->

<!-- tenth row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputSysName">System Name</label>
                      <input type="systemName" class="form-control-plaintext" id="inputSysName" placeholder="MSHWINBWT1A-P-CI-0090-01.verizonwireless.com" readonly>
                    </div>
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
                      <label for="inputCSRTechID">Tech ID</label>
                      <select class="form-control" id="inputCSRTechID">
                        <option>site_tech_ID1</option>
                        <option>site_tech_ID2</option>
                        <option>site_tech_ID3</option>
                        <option>site_tech_ID4</option>
                        <option>site_tech_ID5</option>
                        <option>site_tech_ID6</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputCSRMgrID">Tech Manager ID</label>
                      <select class="form-control" id="inputCSRMgrID">
                        <option>mgr_ID1</option>
                        <option>mgr_ID2</option>
                        <option>mgr_ID3</option>
                        <option>mgr_ID4</option>
                        <option>mgr_ID5</option>
                        <option>mgr_ID6</option>
                      </select>
                    </div>
                  </div>
<!-- /first row -->

<!-- second row -->
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="inputCSRSiteName">Site Name</label>
                      <select class="form-control" id="inputCSRSiteName">
                        <option>ILWI NORTH POKAGON-CST-ARNOLD RL</option>
                        <option>North Angola</option>
                        <option>SB NEW CARLISLE</option>
                        <option>SB NORTH LIBERTY</option>
                        <option>SB PLYMOUTH</option>
                        <option>SB DT SOUTH BEND</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="inputSwitchName">Select Switch Name</label>
                      <select class="form-control" id="inputSwitchName">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
<!-- /second row -->

<!-- third row -->
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="inputInvestigationState">Investigation State</label>
                      <select class="form-control" id="inputInvestigationState">
                        <option>Operational</option>
                        <option>Suspended</option>
                      </select>
                    </div>
                    <div class="form-check col-md-3">
                      <label for="inputSeverity">Severity</label>
                        <select class="form-control" id="inputSeverity">
                          <option>Low</option>
                          <option>Medium</option>
                          <option>High</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputUnacknowledged">Unacknowledged</label>
                      <select class="form-control" id="inputUnacknowledged">
                          <option>Yes</option>
                          <option>No</option>
                        </select>
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
