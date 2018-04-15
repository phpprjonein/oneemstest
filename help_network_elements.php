<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
// include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
	<?php include_once ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between border"></div>
<!-- /table maniupulation row -->

<!-- help guide content row -->
    <div class="row">

<!-- help guide navigation -->
      <div class="col-md-3 col-sm-12">
        <nav id="navbar-help" class="navbar navbar-light bg-light">
          <nav class="nav nav-pills flex-column">
            <h6 class="text-center">CONTENTS</h6>
            <a class="nav-link" href="help.php">GETTING STARTED</a>
            <a class="nav-link help active" href="#item-2">NETWORK ELEMENTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-2-2-1">List Management Options</a>
              <a class="nav-link ml-3 my-1" href="#item-2-3">Health Check Details View</a>
            </nav>
            <a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="help_discovery_results.php#item-4">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-3">OK IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-4">Manual Discovery</a>
            </nav>
            <a class="nav-link" href="help_backup.php">BACKUP</a>
            <a class="nav-link" href="help_config.php">CONFIGURATION</a>
            <a class="nav-link" href="help_faqs.php">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />

        <h4 id="item-2">NETWORK ELEMENTS</h4>
        <p>All user Types are presented with the <b>List Management Dashboard</b>. This particular Dashboard allows for users to:
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
        <p>This List Management screen allows for the user to create lists of devices that s/he can use in other screens within the OneEMS application.</p>
        <p><a href="#item-2-3">Click here</a> for more detailed information about device health individual Dashboard views.</p>
        <h5 id="item-2-2-1">List Management Options</h5>
        <p>Here, a user can create custom lists of devices associated with the switch they are assigned.</p>
        <b>List Creation</b>
        <p>To create a <b>Device List</b>, enter a name in the input field under the <b>List Management</b> heading, then click the "Submit" button next to this input field.</p>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> Your Device List title <b><i>MUST</i></b> be a combination of alphanumeric characters of no more than 20 characters.</p>
        <p>Your created Device List will appear under the <b>My Device List</b> heading.</p>
        <p>From here, you may open your lists for editing, view their contents, delete them altogether or add devices to them.</p>
        <b>Selecting Devices</b>
        <p>The right side list is for listing Routers by Region and Market. The map above this list is sectioned off into different areas. Each similarly colored set of states represents a Region, and within each Region are individual Markets. Once you've chosen a Market, you will then be presented with a list of devices that are associated with a switch in that market.</p>
        <img src="resources/img/screenshot-map1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-map1">
        <p></p>
        <span class="font-italic"><b>FIG. 1.2 - One EMS Regional Map</b></span>
        <p></p>
        <b>Adding A Device To Your Custom List</b>
        <p>In order to add devices to your list, first open a list for editing. To do this, click on the <b>Edit icon</b> ( <i class="fa fa-edit fa-lg text-primary"></i> ) to the immediate right of the list name. The contents of the selected list will appear in the center column of the page.</p>
        <p>Next, select a Region and subsequent Market from the map. this will display the devices associated with these areas.</p>
        <p>You can then drag and drop using the <b>Drag icon</b> ( <i class="fa fa-arrows-alt"></i> ) to bring any selected devices into the <b>Edit List</b> section column on the immediate left of the map Region. This will add these devices to your list and make them available for management in various areas of the application.</p>
        <b>Deleting A Device From Your Custom List</b>
        <p>To remove a device from your created list, simply use the drag icon to drag and drop it over the trash icon ( <i class="fa fa-trash fa-lg text"></i> ) inside the <b>Delete</b> button. Once you confirm this action, this will remove this device from the list. You may add it again by repeating the process of dragging it into the <b>Edit List</b> area from the list of devices under the map.</p>
        <b>Viewing The Health Of Devices In A Custom List</b>
        <p>To view the health of the devices within your selected <b>Device List</b>, click on the eye icon ( <i class="fa fa-eye fa-lg text-primary"></i> ) next to the list name. You will then be presented with the Health Check Dashboard view of all the devices in your selected list.</p>
        <h5 id="item-2-3">Health Check Details View</h5>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> Cell Site Technicians will be provided a <b>"My Routers"</b> List. This List contains Routers that are assigned to the Cell Site Technician via <b>Ops Tracker</b>.</p>
        <p>Here, a user can view the health status of devices associated with a List created on the <b>Network Elements</b> page. Various device health parameters are exposed in this view. This affords the user the ability to monitor multiple devices at a glance.</p>
        <img src="resources/img/screenshot-healthcheck1.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck1">
        <p></p>
        <span class="font-italic"><b>FIG. 2.1 - Health Check Dashboard</b></span></p>
        <p></p>
        <p>This screen gives the user a Dashboard table view of all the devices in a certain List, along with the ability to drill down and view 21 separate health checks:
          <div class="row">
            <div class="col">
              <ul>
                <li>IOS Versioning</li>
                <li>Environmental States</li>
                <li>Multi Protocol Label Switching Interfaces</li>
                <li>IPV4 and IPV6 Neighbors</li>
                <li>Memory Utilization</li>
                <li>CPU Utilization</li>
                <li>Platform Status</li>
                <li>Log Entries</li>
                <li>Ping Status/Success Rates</li>
                <li>Buffers</li>
              </ul>
            </div>
            <div class="col">
              <ul>
                <li>Multiprotocol Label Switching Updates</li>
                <li>Boot Statement Matching</li>
                <li>Configuration Registration</li>
                <li>Bidirectional Forwarding Detection Status And Routes</li>
                <li>Interface Options</li>
                <li>Memory Allocation</li>
                <li>Platform Health</li>
                <li>Log Entries</li>
                <li>X Connect Sanity Check Results</li>
                <li>Neighboring Devices</li>
              </ul>
            </div>
          </div>
        </p>
        <p>To view the health of a specific device, click on the plus icon ( <i class="fa fa-plus-circle fa-lg text-primary"></i> ) on the leftmost column of the device. This will run a script that will run a realtime health check on the device in view.</p>
        <p class="alert alert-danger"><b class="text-danger">NOTE:</b> Upon initialization, 21 separate Health Checks will run in series on the chosen Router. This process can take up to one minute to complete.</p>
        <img src="resources/img/screenshot-healthcheck2.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck2">
        <p></p>
        <span class="font-italic"><b>FIG. 2.2 - Refreshing An Individual Health Check</b></span></p>
        <p></p>
        <p>Once this realtime health check is done, you will be able to click on the page icons ( <i class="fa fa-file-text-o text-primary"></i> ) associated with each parameter to view output directly from the console of the currently selected device.</p>
        <p>You will then see the specific command that was run on the devices and the corresponding output.</p>
        <img src="resources/img/screenshot-healthcheck3.png" class="img-fluid" alt="" data-toggle="modal" data-target="#screenshot-healthcheck3">
        <p></p>
        <span class="font-italic"><b>FIG. 2.3 - Device Console Output View</b></span></p>
        <p></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr>
        <div class="row">
          <div class="col-6">
            <a href="help.php" class="border"><b><< PREV: Getting Started</b></a>
          </div>
          <div class="col-6 text-right">
            <a href="help_discovery_ips.php" class="border"><b>NEXT: Discovery IPs >></b></a>
          </div>
        </div>
        <hr>
<!-- /FAQs -->

      </div>

    </div>
<!-- /help guide content row -->
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

<!-- image modals -->
  <div class="big-modal">
    <div class="modal fade show" id="screenshot-dashboard1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-dashboard1.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-map1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-map1.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck1" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck1.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck2.png" alt="" width="100%">
        </div>
      </div>
    </div>
    <div class="modal fade show" id="screenshot-healthcheck3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <img src="resources/img/screenshot-healthcheck3.png" alt="" width="100%">
        </div>
      </div>
    </div>
  </div>
<!-- /image modals -->

<!-- footer div -->
      <span class="text-muted"><?php include_once ('footer.php'); ?> </span>
<!-- /footer div -->

<!-- JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS. Must load stack in this order for this page; popovers will not work otherwise -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
