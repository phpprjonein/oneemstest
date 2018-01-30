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
							<!---
                            <div class="panel-heading"> My Devices List </div>
							-->
                          </div>                  
                          
 							<div id="mylist" class="panel-heading" style = "height:560px;"> 
<!-- table manipulation row -->
    <div class="form-row align-items-center justify-content-between border">

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

<!-- FAQs content row -->
    <div class="row">

      <div class="col-3">
        <nav id="navbar-help" class="navbar navbar-light bg-light">
          <a class="navbar-brand" href="#">CONTENTS</a>
          <nav class="nav nav-pills flex-column">
            <a class="nav-link" href="#item-1">GETTING STARTED</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-1-1">Item 1-1</a>
              <a class="nav-link ml-3 my-1" href="#item-1-2">Item 1-2</a>
            </nav>
            <a class="nav-link" href="#item-2">DASHBOARD</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-2-1">Device Health Check</a>
              <a class="nav-link ml-3 my-1" href="#item-2-1-1"> - Health Check Details View</a>
              <a class="nav-link ml-3 my-1" href="#item-2-2">List Management</a>
              <a class="nav-link ml-3 my-1" href="#item-2-2-1"> - List Management Options</a>
            </nav>
            <a class="nav-link" href="#item-3">DISCOVERY</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-3-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="#item-3-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="#item-3-3">OK IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="#item-3-3-1"> - Discovery Sub Item 3-2-1</a>
            </nav>
            <a class="nav-link" href="#item-4">BACKUP</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-4-1">Backup Sub Item 4-1</a>
              <a class="nav-link ml-3 my-1" href="#item-4-1-1"> - Backup Sub Item 4-1-1</a>
            </nav>
            <a class="nav-link" href="#item-5">CONFIGURATION</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-5-1">Configuration Sub Item 5-1</a>
              <a class="nav-link ml-3 my-1" href="#item-5-1-1"> - Configuration Sub Item 5-1-1</a>
            </nav>
            <a class="nav-link" href="#item-6">SCRIPTING</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-6-1">Scripting 6-1</a>
              <a class="nav-link ml-3 my-1" href="#item-6-2">Scripting 6-2</a>
              <a class="nav-link ml-3 my-1" href="#item-6-2-1"> - Scripting Sub Item 6-1-2</a>
              <a class="nav-link ml-3 my-1" href="#item-6-2-2"> - Scripting Sub Item 6-1-2</a>
            </nav>
            <a class="nav-link" href="#item-7">COMPLIANCES</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-7-1">Compliances Sub Item 7-1</a>
              <a class="nav-link ml-3 my-1" href="#item-7-1-1"> - Compliances Sub Item 7-1-1</a>
            </nav>
            <a class="nav-link" href="#item-8">IP MANAGEMENT</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="#item-8-1">IP Management Sub Item 8-1</a>
              <a class="nav-link ml-3 my-1" href="#item-8-1-1"> - IP Management Sub Item 8-1-1</a>
            </nav>
            <a class="nav-link" href="#item-9">FAQs</a>
          </nav>
        </nav>
      </div>

      <div class="col-9 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <h4 id="item-1">GETTING STARTED</h4>
        <p><b>COMING SOON</b></p>
        <hr />
        <h4 id="item-2">DASHBOARD</h4>
        <p>The OneEMS application has a singular <a href="#">List Management Dashboard</a> view with slightly different variations. These variations are specific to certain User types, mainly Cell Technicians and Switch Technicians. (*note?)</p>
        <p>Cell Technicians are presented with a similar screen as Switch Technicians and other User Types, with the main difference being that the Cell Technicians are presented with an additional list of routers that are assigned to that particular user. This list appears in the <b>My Device List</b> section of the Dashboard page as the <b>My Routers</b> list option.</p>
        <p>INSERT SCREENSHOT OF 'MY ROUTERS' SECTION OF DASHBOARD HERE
        <span class="font-italic"><b>FIG. 1.1 - My Routers List</b></span></p>
        <p>All User Types are presented with the List Management Dashboard. This particular dashboard allows for Users to:
          <ul>
            <li>Create custom device lists</li>
            <li>Edit saved device lists</li>
            <li>View Markets specific to the User's assigned devices</li>
            <li>Edit assigned devices</li>
          </ul>
        </p>
        <h5 id="item-2-1">DASHBOARD - Cell Technician vs Switch Technician</h5>
        <b>List Management</b>
        <p>INSERT SCREENSHOT OF SWITCH TECH DASHBOARD (which will be the same as cell tech dashboard) HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <p>The Cell Technician User Type is presented with the List Management screen upon login. This screen is nearly identical to the Dashboard screen other User Types see when logging in, except for addition of the My Routers section. This section shows routers assigned to that specific Cell Technician.</p>
        <p>This Dashboard screen allows for the User to create lists of devices that s/he can manage in other places within the OneEMS application. For example, a User can create a list that contains devices that represent a specific Site that they can then update backups for, or a list of devices connected to a specific market that they can manage, etc.</p>
        <p>The Switch Technician User type is presented with the a similar screen upon login. The main difference is that there is no My Routers list option present.</p>
        <p>INSERT SCREENSHOT OF CELL TECH DASHBOARD HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <p><a href="#">Click here</a> for more detailed information about device health individual dashboard views.</p>
        <h5 id="item-2-2-1">List Management Options</h5>
        <b>Options</b>
        <p>Here, a User can create custom lists of devices based on the Markets they are assigned to.</p>
        <p>INSERT SCREENSHOT OF LIST MANAGEMENT DASHBOARD HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <b>List Creation</b>
        <p>To create a Device List, enter a name in the input field under the <b>List Management</b> heading, then click the "Submit" button next to this input field.</p>
        <p class="border"><b>NOTE:</b> Your Device List title must be a combination of alphanumeric characters of no more than 20 characters.</p>
        <p>Your created Device List will appear at the top of the section just below the input field under the <b>My Device List</b> heading.</p>
        <p>From here, you may rename your list, add devices to it, view its contents or delete it altogether.</p>
        <p>In order to add devices to your list, click on an area of the map on the right hand side of the page. Each similarly colored set of states represents a <b>Region</b>, and within each Region are individual <b>Markets</b>. Once you've chosen a Market, you will then be presented with a list of devices that are associated with that region.</p>
        <p>Click on one or more devices in the list below the map. You can then drag and drop any selected devices into the <b>Edit List</b> section to the column on the immediate left of the map region. This will add these devices to your list and make them available for management in various areas of the site within the created list.</p>
        <p>INSERT SCREENSHOT OF DRAGGED DEVICES HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <p>To remove a device from your created list, simply drag and drop it over the <b>Delete</b> button. Once you confirm this action, this will permanently remove this device from the list. You may add it again by repeating the process of dragging it into the <b>Edit List</b> area from the list of devices under the map.</p>
        <p>To edit your saved Device Lists, click on the <b>Edit</b> icon to the immediate right of the list name. You can then add and/or delete devices to/from this list.</p>
        <p>To view the health of the devices within your selected <b>Device List</b>, click on the eye icon next to the list name. You will then be presented with the Health Check Dashboard view of all the devices in your selected list.</p>
        <h5 id="item-2-1-1">Health Check Details View</h5>
        <b>Options</b>
        <p>Here, a User can view the health status of devices they are assigned to. Various device health parameters are exposed in this view. This affords the User the ability to monitor multiple devices at a glance.</p>
        <p>INSERT SCREENSHOT OF CELL TECH DASHBOARD EXPANDED HEALTH CHECK ROUTER VIEW HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <p>This screen gives the User a dashboard table view of all the devices that are assigned to him/her, along with the ability to drill down into certain specific workings of a device. These views include (but are not limited to):
          <ul>
            <li>IOS Versioning</li>
            <li>Environmental States</li>
            <li>Multi Protocol Label Switching Interfaces</li>
            <li>IPV4 and IPV6 Neighbors</li>
            <li>Memory Utilization</li>
            <li>Platform Status</li>
            <li>and more...</li>
          </ul>
        </p>
        <p>To view the health of a specific device, click on the plus icon on the leftmost column of the device. From here, you then click on the <b>See All</b> button (*note?). This will run a script that will run a realtime health check on the device in view.</p>
        <p>Once this realtime health check is done, you will be able to click on the search icons associated with each parameter to view output directly from the console of the device.</p>
        <p>INSERT SCREENSHOT OF HEALTH CHECK ROUTER OUTPUT HERE
        <span class="font-italic"><b>FIG. 1.x - description</b></span></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-3">DISCOVERY</h4>
        <p>This Dashboard provides a view of all the IP addresses belonging to all the devices assigned to a specific User.</p>
        <h5 id="item-2-1-1">Missed IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that were not counted as part of the device stack when the last initiated polling session occured.</p>
        <img src="img/screenshot-discovery-missed.png" alt="">
        <br />
        <span class="font-italic"><b>FIG. 2.1 - Discovery Dashboard</b></span>
        <p></p>
        <h5 id="item-2-1-1">New IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that were added to the device stack when the last initiated polling session occured.</p>
        <img src="img/screenshot-discovery-new.png" alt="">
        <br />
        <span class="font-italic"><b>FIG. 2.2 - New Dashboard</b></span>
        <p></p>
        <h5 id="item-2-1-1">Missed IP Addresses View</h5>
        <p>This view shows all the IP addresses of devices that were not counted as part of the device stack when the last initiated polling session occured.</p>
        <img src="img/screenshot-discovery-missed.png" alt="">

        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-4">BACKUP</h4>
        <p>...</p>
        <p><b>COMING SOON</b></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-5">CONFIGURATION</h4>
        <p>...</p>
        <p><b>COMING SOON</b></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-6">SCRIPTING</h4>
        <p>...</p>
        <p><b>COMING SOON</b></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-7">COMPLIANCES</h4>
        <p>...</p>
        <p><b>COMING SOON</b></p>
        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-8">IP MANAGEMENT</h4>
        <p>This Dashboard allows a User to manage the IP addresses assigned to the devices that the User is assigned to.</p>
        <img src="img/screenshot-ip_management.png" alt="">
        <br />
        <span class="font-italic"><b>FIG. 7.1 - IP Management Dashboard</b></span>
         <p>Here, Users can:
          <ul>
            <li>Select Region-specific IP addresses to view</li>
            <li>Create IP subnets for specific regions</li>
            <li>{One other option} (*note?)</li>
          </ul>
        </p>
        <p></p>
        <h5 id="item-2-1-1">Subnet Addition</h5>
        <p>To add a Subnet, choose a Region from the dropdown at the top of the page.</p>
        <p>Once you've selected a Region, click on the <b>Add A Subnet</b> button. You will then be presented with the Add Subnet screen.</p>
        <img src="img/screenshot-ip_management_add_subnet-1.png" alt="">
        <br />
        <span class="font-italic"><b>FIG. 7.2 - Add A Subnet Screen</b></span>
        <p></p>
        <p>Once at this screen, you can now set an IP address and a subnet mask to </p>


        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
        <h4 id="item-9">FAQs</h4>
          <div id="accordion">

            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How do I...?
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Where do I...?
                  </button>
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
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    When do I...?
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>

          </div>
          <p></p>

        <a href="#top" class="border"><b>Back to top</b></a>
        <hr />
      </div>

    </div>
<!-- /FAQs content row --> 
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
