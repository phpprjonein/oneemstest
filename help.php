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
//check_user_authentication('1'); //cellsite tech type user 

    $page_title = 'OneEMS';
 
?>
<!DOCTYPE html>
<html>
    <head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_user_devices.js?t=".<?php echo date('his'); ?>></script>
   <script defer src="resources/js/all.js"></script>
 </head>
     <body class="hold-transition skin-blue sidebar-mini ownfont">
        <!-- Modal HTML -->
        
        <!--<div id="mycmdModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Content will be loaded here from "remote.php" file --
            </div>
        </div>
        </div>-->

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
                          
 						<div id="mylist" class="panel-heading"><!-- header row -->
 

<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between">

<!-- search table form field --> 
      <div class="col">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Help Topics" aria-label="Search Help Topics">
          <span class="input-group-btn">
            <button class="btn btn-light" type="button"><i class="fas fa-search"></i></button>
          </span>
        </div>
      </div>
 <!-- /search table form field -->

    </div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
    <div class="row">

<!-- help guide navigation -->
      <div class="col-md-3 col-sm-12">
        <nav id="navbar-help" class="navbar navbar-light bg-light">
          <span class="navbar-brand d-none d-lg-block">CONTENTS</span>
          <nav class="nav nav-pills flex-column">
            <a class="nav-link" href="#item-1">GETTING STARTED</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#browserOSMatrix">Browser/OS Matrix</a>
            </nav>
            <a class="nav-link" href="#item-2">NETWORK ELEMENTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-2-2-1">List Management Options</a>
              <a class="nav-link ml-3 my-1" href="#item-2-3">Health Check Details View</a>
            </nav>
            <a class="nav-link" href="#item-3">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="#item-4">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="#item-4-3">OK IP Addresses</a>
            </nav>
            <a class="nav-link" href="#item-5">BACKUP</a>
            <a class="nav-link" href="#item-6">CONFIGURATION</a>
            <a class="nav-link" href="#item-7">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />
        <h4 id="item-1">GETTING STARTED</h4>
        <p>The One EMS application allows <b>Users</b> to perform routine network device management tasks. These devices are grouped according to <b>region</b> and further subdivided by <b>markets</b>. Users are initially provided a default list of Routers (asssigned in IOP). A User can also create customized lists of <b>Routers</b>. Users can perform actions on each Router including; device health checks, manual discovery, on-demand backup / restore and generate task specific scripts.</p>
        <p>To get started, a User <b><i>MUST</i></b> have completed certain prerequisites <b>and</b> have an assigned user ID / password login scheme.</p>
        <p>This help document assumes that the User has <b>ALREADY</b> completed the following prerequisite steps in order to gain access to this application:</p>
        <ul>
          <li>obtained permission / access from supervisor (or from <b>CARMS</b> when available)</li>
          <li>must have a single sign on account in <b>QTWIN</b> and <b>USWIN</b></li>
          <li>access to the <b>Verizon SSO</b> login screen</li>
        </ul>
        <p class="border"><b class="text-danger">NOTE:</b> This document assumes that the reader has already met the requirements listed above.</p>
        <p>Once a User has met the requirements for access to the One EMS application, they are then able to access all the features of the application. This help document will outline these specific features below, as well as provide answers to frequently asked questions about the application.</p>
        <p>The following table shows the browsers and operating systems that this application currently supports. Using browsers and operating systems besides the ones listed below as supported will produce unintended results in terms of layout and/or functionality.</p>
        <p class="border"><b class="text-danger">NOTE:</b> Please contact your system administrator or other supervisory body in order to assure that whatever device you are using this application on is equipped with one of the supported browser/OS combinations listed below.</p>

<!-- browser/OS support table -->
        <table class="table table-sm table-hover table-bordered" id="browserOSMatrix">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Operating System</th>
              <th scope="col">IE8</th>
              <th scope="col">IE9</th>
              <th scope="col">IE10</th>
              <th scope="col">IE11</th>
              <th scope="col">Edge</th>
              <th scope="col">Chrome (60+)</th>
              <th scope="col">Firefox (56+)</th>
              <th scope="col">Opera (45+)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Windows XP</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
            </tr>
            <tr>
              <th scope="row">Windows Vista SP2</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">Windows Server 2012</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">Windows 7</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">Windows 8.1</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">Windows 10</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">macOS Sierra</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
            <tr>
              <th scope="row">macOS High Sierra</th>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>No</td>
              <td>Yes</td>
              <td>Yes</td>
              <td>Yes</td>
            </tr>
          </tbody>
        </table>
<!-- /browser/OS support table -->

        <hr>
        <h4 id="item-2">NETWORK ELEMENTS</h4>
        <p>All User Types are presented with the <b>List Management Dashboard</b>. This particular Dashboard allows for Users to:
          <ul>
            <li>Create custom device lists</li>
            <li>Edit saved device lists</li>
            <li>View devices associated with a specific switch</li>
          </ul>
        </p>
        <img src="resources/img/screenshot-dashboard1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-dashboard1">
        <p></p>
        <span class="font-italic"><b>FIG. 1.1 - One EMS Dashboard</b></span>
        <p></p>
        <p>This Dashboard screen allows for the User to create lists of devices that s/he can manage in other places within the OneEMS application. For example, a User can create a list that contains devices that represent a specific <b>Site</b>. They can then update backups for the devices in that particular list. A User generated list can also be comprised of devices connected to a specific market that they can manage, etc.</p>
        <p><a href="#item-2-3">Click here</a> for more detailed information about device health individual Dashboard views.</p>
        <h5 id="item-2-2-1">List Management Options</h5>
        <b>Options</b>
        <p>Here, a User can create custom lists of devices based on the switch they are assigned.</p>
        <b>List Creation</b>
        <p>To create a <b>Device List</b>, enter a name in the input field under the <b>List Management</b> heading, then click the "Submit" button next to this input field.</p>
        <p class="border"><b class="text-danger">NOTE:</b> Your Device List title <b><i>MUST</i></b> be a combination of alphanumeric characters of no more than 20 characters.</p>
        <p>Your created Device List will appear at the top of the section just below the input field under the <b>My Device List</b> heading.</p>
        <p>From here, you may rename your list, add devices to it, view its contents or delete it altogether.</p>
        <p>In order to add devices to your list, click on an area of the map. Each similarly colored set of states represents a <b>Region</b>, and within each Region are individual <b>Markets</b>. Once you've chosen a Market, you will then be presented with a list of devices that are associated with that region.</p>
        <img src="resources/img/screenshot-map1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-map1">
        <p></p>
        <span class="font-italic"><b>FIG. 1.2 - One EMS Regional Map</b></span>
        <p></p>
        <p>Click on one or more devices in the list below the map. You can then drag and drop any selected devices into the <b>Edit List</b> section to the column on the immediate left of the map region. This will add these devices to your list and make them available for management in various areas of the application.</p>
        <p>To remove a device from your created list, simply drag and drop it over the <b>Delete</b> button with the trash icon (<i class="fas fa-trash-alt text"></i>). Once you confirm this action, this will remove this device from the list. You may add it again by repeating the process of dragging it into the <b>Edit List</b> area from the list of devices under the map.</p>
        <p>To edit your saved Device Lists, click on the <b>Edit</b> icon (<i class="fas fa-edit text-primary"></i>) to the immediate right of the list name. You can then add and/or delete devices to/from this list.</p>
        <p>To view the health of the devices within your selected <b>Device List</b>, click on the eye icon (<i class="fas fa-eye text-primary"></i>) next to the list name. You will then be presented with the Health Check Dashboard view of all the devices in your selected list.</p>
        <h5 id="item-2-3">Health Check Details View</h5>
        <b>Options</b>
        <p>Here, a User can view the health status of devices they are assigned to. Various device health parameters are exposed in this view. This affords the User the ability to monitor multiple devices at a glance.</p>
        <p>This screen gives the User a Dashboard table view of all the devices that are assigned to him/her, along with the ability to drill down into certain specific workings of a device. These views include (but are not limited to):
          <ul>
            <li>IOS Versioning</li>
            <li>Environmental States</li>
            <li>Multi Protocol Label Switching Interfaces</li>
            <li>IPV4 and IPV6 Neighbors</li>
            <li>Memory Utilization</li>
            <li>CPU Utilization</li>
            <li>Platform Status</li>
            <li>Log Entries</li>
            <li>and more...</li>
          </ul>
        </p>
        <img src="resources/img/screenshot-healthcheck1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck1">
        <p></p>
        <span class="font-italic"><b>FIG. 2.1 - Health Check Dashboard</b></span></p>
        <p></p>
        <p>To view the health of a specific device, click on the plus icon on the leftmost column of the device. From here, you then click on the <b>See All</b> button (*note?). This will run a script that will run a realtime health check on the device in view.</p>
        <img src="resources/img/screenshot-healthcheck2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck2">
        <p></p>
        <span class="font-italic"><b>FIG. 2.2 - Specific Device Health View</b></span></p>
        <p></p>
        <p>Once this realtime health check is done, you will be able to click on the search icons ( <img src="resources/img/icons/icon_healthcheck_search.png" alt="" class="no-box-shadow"> ) associated with each parameter to view output directly from the console of the currently selected device.</p>
        <img src="resources/img/screenshot-healthcheck3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck3">
        <p></p>
        <span class="font-italic"><b>FIG. 2.3 - Device Console Output View</b></span></p>
        <p></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <h4 id="item-3">DISCOVERY IPs</h4>
        <p>This Dashboard allows a User to manage the <b>subnet ranges</b> associated with the devices that the User is assigned to. This management function is categorized by Region by default.</p>
        <p>Here, Users can:
          <ul>
            <li>Select Region-specific IP addresses, subnets, subnet masks and subnet ranges to view</li>
            <li>Create IP subnets for specific regions</li>
            <li>{One other option} (*note?)</li>
          </ul>
        </p>
        <img src="resources/img/screenshot-ip_management.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-ip_management">
        <p></p>
        <span class="font-italic"><b>FIG. 3.1 - IP Management Dashboard</b></span>
        <p></p>
        <p>To view IP addresses and subnet ranges by Region, choose a Region from the dropdown menu to the right of the <b>IP Type</b> button. When this Dashboard first loads, your default Region is selected.</p>
        <img src="resources/img/screenshot-ip_management_choose_region-1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-ip_management_choose_region-1">
        <p></p>
        <span class="font-italic"><b>FIG. 3.2 - Choose Region</b></span>
        <p></p>
        <h5 id="item-3-1">Subnet Addition</h5>
        <p></p>
        <p>To add a Subnet, choose a Region from the <b>Select Region</b> dropdown at the top of the page.</p>
        <img src="resources/img/screenshot-ip_management_choose_region-2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-ip_management_choose_region-2">
        <p></p>
        <span class="font-italic"><b>FIG. 3.3 - Choose Region For Subnet Addition</b></span>
        <p></p>
        <p>Once you've selected a Region, click on the <b>Add A Subnet</b> button. You will then be presented with the Add A Subnet screen.</p>
        <img src="resources/img/screenshot-ip_management_add_subnet-1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-ip_management_add_subnet-1">
        <p></p>
        <span class="font-italic"><b>FIG. 3.4 - Add A Subnet Screen</b></span>
        <p></p>
        <p>Once at this screen, you can now set a subnet and a corresponding subnet mask to compute subnet range values for. Once you've input your values into the input fields on this screen, click on the <b>Compute</b> button to initiate a search for an appropriate range.</p>
        <p>The correct subnet range is then displayed to the left of the input values. You can then either reenter values to compute for different ranges or click the <b>Add</b> button to add this computed subnet value to the subnets associated with you.</p>
        <img src="resources/img/screenshot-ip_management_add_subnet-2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-ip_management_add_subnet-2">
        <p></p>
        <span class="font-italic"><b>FIG. 3.5 - Select Subnet And Subnet Mask Range Screen</b></span>
        <p></p>
        <p>Clicking on the <b>Add</b> button will bring the User back to the main <b>Discovery IPs</b> screen.</p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <h4 id="item-4">DISCOVERY RESULTS</h4>
        <p>This Dashboard provides a view of all the IP addresses belonging to all the devices assigned to a specific User as per the last initiated polling session. There are three distinct views:</p>
        <ul>
          <li>Missed View</li>
          <li>New View</li>
          <li>OK View</li>
        </ul>
        <h5 id="item-4-1">Missed IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that were not counted as part of the device stack when the last initiated polling session occured.</p>
        <img src="resources/img/screenshot-discovery-missed.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-discovery-missed">
        <p></p>
        <span class="font-italic"><b>FIG. 4.1 - Missed IP Addresses Dashboard</b></span>
        <p></p>
        <h5 id="item-4-2">New IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that were added to the device stack when the last initiated polling session occured.</p>
        <img src="resources/img/screenshot-discovery-new.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-discovery-new">
        <p></p>
        <span class="font-italic"><b>FIG. 4.2 - New IP Addresses Dashboard</b></span>
        <p></p>
        <h5 id="item-4-3">OK IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that are accounted for with no issues as per the last initiated polling session.</p>
        <img src="resources/img/screenshot-discovery-ok.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-discovery-ok">
        <p></p>
        <span class="font-italic"><b>FIG. 4.3 - OK IP Addresses Dashboard</b></span>
        <p></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <h4 id="item-5">BACKUP</h4>
        <p>This view allows a User to manage existing configurations for devices on their network.</p>
        <p>A User can:</p>
        <ul>
          <li>Remotely backup the configuration of any device within the One EMS network configuration</li>
          <li>Monitor the status of any device within the One EMS network</li>
          <li>Manage the backup status of devices within a User's created Lists</li>
        </ul>
        <img src="resources/img/screenshot-backup1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-backup1">
        <p></p>
        <span class="font-italic"><b>FIG. 5.1 - Backup Dashboard</b></span>
        <p></p>
        <p>To backup a device's configuration, simply click the <b>Backup</b> button in the right most column of the list table. This will run a script that attempts to remotely backup the configuration of the device selected in the User's List table.</p>
        <img src="resources/img/screenshot-backup2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-backup2">
        <p></p>
        <span class="font-italic"><b>FIG. 5.2 - Backup Device Results</b></span>
        <p></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <h4 id="item-6">CONFIGURATION</h4>
        <p>This Dashboard consists of a file upload interface that allows a User to manage <b>Configuration Scripts</b> for any device within the One EMS system. On this screen, a user can:</p>
        <ul>
          <li>Upload Templates</li>
          <li>Update existing Templates</li>
          <li>Download Template scripts to run any device, even ones not within the monitored One EMS network</li>
        </ul>
        <img src="resources/img/screenshot-config1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-config1">
        <p></p>
        <span class="font-italic"><b>FIG. 6.1 - Configuration Dashboard</b></span>
        <p></p>
        <p>To manage device scripts, a User can upload one from their hard drive. Doing so produces a form on the right in which a User can edit values.</p>
        <p class="border"><b class="text-danger">NOTE:</b> When uploading a script to the One EMS application for editing, the file must be saved as a <b>.txt</b> file. The One EMS application cannot consume files that have anything besides .txt extensions.</p>
        <p>Once a User has either manipulated the default values in the form on the right or changed the values of the script they have uploaded, they can then download this edited script for application on devices of their choosing.</p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>

<!-- FAQs -->
        <h4 id="item-7">FAQs</h4>
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> How do I gain access to the One EMS application?</button>
                </h5>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <p>In order to access the One EMS application, a User must have:</p>
                  <ul>
                    <li>obtained permission / access from supervisor (or from <b>CARMS</b> when available)</li>
                    <li>must have a single sign on account in <b>QTWIN</b> and <b>USWIN</b></li>
                    <li>access to the <b>Verizon SSO</b> login screen</li>
                  </ul>
                  <p>Please see your supervisor or administrative body to obtain this access.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How do I reset my login credentials?</button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Where do I view ALL the devices I'm assigned to?</button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  <p>The <b><a href="#item-2">Network Elements Dasboard</a></b> exposes all the devices assigned to a specific User throughout the entire monitored One EMS network.</p>
                  <p>This screen DOES NOT display any devices that a User may be monitoring, managing, editing or otherwise servicing that have not been identified within the (*note?)insert DB(s) here* database(s), or have not been added either manually or via some other method to said database(s) at the time of polling by the One EMS application.</p>
                  <p><a href="#item-3-1">Click here</a> for more information on manually adding subnets to the (*note?)insert DB(s) here* database(s) via the One EMS application.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">How do I add more devices to the One EMS Application?</button>
                </h5>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                  <p>The One EMS application does not allow for addition of devices to the network from any of the Dashboards contained within it.</p>
                  <p>A User can run scripts from the <b><a href="#item-4">Discovery Results Dashboard</a></b> in order to rediscover devices that may have been newly added to the IOP database, but this action in and of itself does <b>NOT</b> actually add a device to the network. It only <i>rediscovers</i> a device that may have been missed during the last polling session carried out by the One EMS application.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFour">A Dashboard screen I'm working in doesn't look right/work properly. How do I fix this?</button>
                </h5>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                <div class="card-body">
                  <p>The <b><a href="#browserOSMatrix">Browser/OS Support Matrix</a></b> shows the currently supported configurations that the One EMS Application works in. You must have <b>BOTH</b> a supported operating system <b>AND</b> a supported browser to view this application. Currently, no version of Internet Explorer earlier than V.11 is supported by this application.</p>
                  <p>Please see your system administrator or other supervisory body to ensure compliance with this Browser/OS Support Matrix.</p>
                  <p>Additionally, you may visit <a href="https://updatemybrowser.org" target="_blank">https://updatemybrowser.org</a> to check if your browser is current.</p>
                </div>
              </div>
            </div>
          </div>
        <p></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
<!-- /FAQs -->

      </div>

    </div>
<!-- /help guide content row -->

</div> 
                        <!-- /.box-body -->
                      </div>
                  </div> 
                </section> <!-- /.content -->
              </div>
            <!-- /.content-wrapper --> 
			
<!-- image modals -->
  <div class="big-modal">
    <div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-dashboard1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-map1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck3_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_region-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_region-1_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_choose_region-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm text-center">
          <img src="resources/img/screenshot-ip_management_choose_region-2_LARGE.png" alt="" width="">
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-ip_management_add_subnet-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-ip_management_add_subnet-2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-missed" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-missed_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-new" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-new_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-discovery-ok" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-discovery-ok_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-backup2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-backup2_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-config1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-config1_LARGE.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
			<div style="clear:both;"></div>
        </div>
        <!-- ./wrapper -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
