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
	<div class="container-fluid" id="cellsitech-config">
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
            <a class="nav-link" href="help_network_elements.php">NETWORK ELEMENTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-2-1">List Management Options</a>
              <a class="nav-link ml-3 my-1" href="help_network_elements.php#item-2-3">Health Check Details View</a>
            </nav>
            <a class="nav-link" href="help_discovery_ips.php">DISCOVERY IPs</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_ips.php#item-3-1">Subnet Addition</a>
            </nav>
            <a class="nav-link" href="help_discovery_results.php">DISCOVERY RESULTS</a>
            <nav class="nav nav-pills flex-column">
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-1">Missed IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-2">New IP Addresses</a>
              <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-3">OK IP Addresses</a>
			  <a class="nav-link ml-3 my-1" href="help_discovery_results.php#item-4-4">Manual Discovery</a>
            </nav>
            <a class="nav-link" href="help_backup_config.php">BACKUP</a>
            <a class="nav-link" href="help_config.php">CONFIGURATION</a>
            <a class="nav-link help active" href="#item-7">FAQs</a>
          </nav>
        </nav>
      </div>
<!-- /help guide navigation -->

<!-- help guide -->
      <div class="col-md-9 col-sm-12 scrollspy-example" data-spy="scroll" data-target="#navbar-help" data-offset="0">
        <hr class="d-md-none" />

<!-- FAQs -->
        <h4 id="item-7">FAQs</h4>
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0 table-responsive">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> How do I gain access to the OneEMS application?</button>
                </h5>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  <p>In order to access the OneEMS application, a user must have:</p>
                  <ul>
                    <li>obtained permission / access from supervisor (or from <b>CARMS</b> when available)</li>
                    <li>a single sign on account in <b>QTWIN</b> and <b>USWIN</b></li>
                    <li>access to the <b>Verizon SSO</b> login screen</li>
                  </ul>
                  <p>Please see your supervisor or administrative body to obtain this access.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0 table-responsive">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">A specific device I'm looking for isn't showing up. How do I fix this?</button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <p>Devices are made available to the OneEMS application via <b>Ops Tracker</b>. Each device is categorized by its name, associated site number, switch name and site name. If one or more of these criteria are not met, it is entirely possible that <b>Ops Tracker</b>'s database does not contain the specific device in question.</p>
                    <p>Please contact your administrator or supervisory body for more information regarding adding more devices.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h5 class="mb-0 table-responsive">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Where do I view ALL the devices I'm assigned to?</button>
                </h5>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <p>The <b><a href="help_network_elements.php">Network Elements Dashboard</a></b> exposes all the devices assigned to a specific user as per the <b>OpsTracks</b> database.</p>
                    <p class="alert alert-danger"><b class="text-danger">NOTE:</b> For Cell Site Technicians, the <b>My Routers</b> list on the <b>Network Elements Dashboard</b> contains routers assigned to a specific user by <b>Ops Tracker</b>.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h5 class="mb-0 table-responsive">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">How do I add more devices to the OneEMS Application?</button>
                </h5>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                  <p>The OneEMS application does not allow for addition of devices to the network from any of the Dashboards contained within it. Devices are added during a discovery session. The list of devices to be discovered are governed by the <b><a href="help_discovery_ips.php">Discovery IPs list</a></b>.</p>
                  <p>A user can run scripts from the <b><a href="help_discovery_results.php">Discovery Results Dashboard</a></b> in order to rediscover devices that may have been newly added to the IOP database, but this action in and of itself does <b>NOT</b> actually add a device to the network. It only <i>rediscovers</i> a device that may have been missed during the last polling session carried out by the OneEMS application.</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingSix">
                <h5 class="mb-0 table-responsive">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">A Dashboard screen I'm working in doesn't look right/work properly. How do I fix this?</button>
                </h5>
              </div>
              <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                <div class="card-body">
                  <p>The <b><a href="#browserOSMatrix">Browser / OS Support Matrix</a></b> below shows the currently supported configurations that the OneEMS Application works in. You must have <b>BOTH</b> a supported operating system <b>AND</b> a supported browser to view this application. Using browsers and operating systems besides the ones listed as supported below will produce unintended results in terms of layout and/or functionality.</p>
                  <p>Currently, no version of Internet Explorer earlier than V.11 is supported by this application.</p>
                  <p>Please see your system administrator or other supervisory body to ensure compliance with this Browser / OS Support Matrix.</p>
                  <p>You may be zoomed in to a higher percentage than usual in your browser. To rectify this, press <kbd>Ctrl + 0</kbd> ( <kbd>Command + 0</kbd> in iOS) to reset the zoom percentage in your browser to 100%.</p>
                  <p>Additionally, you may visit <a href="https://updatemybrowser.org" target="_blank">https://updatemybrowser.org</a> to check if your browser is current.</p>
                  <p class="alert alert-danger"><b class="text-danger">NOTE:</b> Please contact your system administrator or other supervisory body in order to assure that whatever device you are using this application on is equipped with one of the supported browser / OS combinations listed below.</p>

<!-- browser/OS support table -->
                    <div class="table-responsive">
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
                    </div>
<!-- /browser/OS support table -->
                </div>
              </div>
            </div>
          </div>
        <hr>
        <div class="row">
          <div class="col-6">
            <a href="help_config.php" class="border"><b><< PREV: Configuration</b></a>
          </div>
          <div class="col-6 text-right"></div>
        </div>
        <p>&nbsp;</p>
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
