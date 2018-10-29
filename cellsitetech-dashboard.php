<?php
include_once ("classes/db2.class.php");
include_once "classes/paginator.class.php";
include_once ("functions.php");
user_session_check();
// Check for switch tech type user
include_once ('config/session_check_cellsite_tech.php');
$page_title = 'OneEMS';
// Default map dispaly flag true
$show_map_flag = true;
// Map flag set to false once map is clicked
// print_r($_GET);
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  cellsitetech landing page Description: Logged in. ";
write_log($mesg);
if (isset($_GET['markets']) && $_GET['markets'] != '') {
    $marketname = $_SESSION['marketname'] = $_GET['markets'];
    $show_map_flag = false;
    unset($_SESSION['switch_device_id']);
} else {
    $marketname = null;
    unset($_SESSION['marketname']);
}

$userid = $_SESSION['userid'];
$succss_msg = '';

if (isset($_POST['addlist']) && ! empty($_POST['addlist'])) {
    $_SESSION['succss_msg'] = '';
    
    $data = array(
        'listname' => $_POST['addlist'],
        'userid' => $userid
    );
    $result = insert_usrfavritedev($data);
    $_SESSION['mylistname'] = $_POST['addlist'];
    $_SESSION['succss_msg'] = 'Created succesfully';
}

if (isset($_GET['action']) && $_GET['action'] == 'editmylist') {
    $switchlistid = $_SESSION['switchlistid'] = $_GET['switchlistid'];
}

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Network Elements page Description: Cell Site Tech has logged into the application.";
write_log($mesg);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes.php");  ?>
<script
	src="resources/js/cellsitetech_user_list.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cell-user-db">

    <?php
    // include_once menu bar htmls [ Logo, welcome text, menu ]
    include_once ('menu.php');
    ?>

	<?php echo generate_site_breadcrumb(); ?>
			<?php 
          if($_POST['addalldevices'] == 'Add All Devices'){
              $listid = $_POST['hidd_mylistid'];
              $switchname = $_POST['hidd_switch_selected'];
              $userid = $_SESSION['userid'];
              
              $list_existing_devices = $list_add_new_devices = array();
              $results = get_device_list_for_user($userid, $_POST['hidd_mylistid']);
              foreach ($results['result'] as $key => $val){
                  $list_existing_devices[] = $val['nodeid'];
                  $listname = ($listname == "") ? $val['listname'] : $listname;
              }
              
              $results_switch_nodes = get_device_list_for_user_by_switch($switchname);
              foreach ($results_switch_nodes['result'] as $key => $val){
                  $list_add_new_devices[] = $val['id'];
              }
              $new_devices_to_add = array_diff($list_add_new_devices, $list_existing_devices);
              $oc = 1;
              $dsql = 'INSERT INTO `userdevices` (`nodeid`, `userid`, `listid`, `listname`) VALUES';
              foreach ($new_devices_to_add as $key => $val) {
                  if (count($new_devices_to_add) == $oc) {
                      $dsql .= "('" . $val . "'," . $_SESSION['userid'] . ",$listid,'".$listname."')";
                  } else {
                      $dsql .= "('" . $val . "'," . $_SESSION['userid'] . ",$listid,'".$listname."'),";
                  }
                  $oc ++;
              }
              if ($oc > 1) {
                  $db2->query($dsql);
                  $db2->execute();
              }
          }
          ?>
  <div class="row">
			<div id="lhspanel" class="col-sm-6 col-md-6">
				<div id="mylist" class="alert alert-secondary panel-heading-lstmgmt">
					<b>List Management</b>
				</div>
				<div class="">
					<div class="col-md-6">
						<form id="usrmyfavlstfrm" name="usrmyfavlstfrm"
							action="cellsitetech-dashboard.php" method="POST"
							class="navbar-form search">
							<div class="input-group add-on">
								<input name="addlist" id="addlist"
									class="form-control search-details"
									placeholder="Create New List" type="text" autofocus> <span
									class="input-group-btn">
									<button class="btn btn-default search-details" type="submit"
										name="addlistbtn" name="addlistbtn" data-toggle="tooltip"
										data-placement="right"
										title="List must be &lt;21 characters long and may contain letters, spaces, and numbers. No special characters."
										value="Submit">Submit</button>
								</span>
							</div>
						</form>
						<br>
          <?php
        // Switch list create success message display
        if ($succss_msg != '') {
            ?>
            <div class="text-success"><?php echo $succss_msg ?></div>
          <?php
        }
        ?>
        </div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div id="switchlist"
							class="panel-warning  panel-default col-md-6 ">
							<div
								class="alert alert-secondary panel-heading-myswtlst text-center"
								id="delete_mylists">
								<div>
									<b>My Device List </b>
								</div>
								<!-- Deleted selected switch list by drag and drop area -->
								<div>
									<span id="myswitchlist_delete" type="button"
										class="droppable box box-danger btn"> <i class="fa fa-trash"></i>&nbsp;Drag
										Here To<br>DELETE
									</span>
								</div>
							</div>
							<div class="panel-body border">
								<table width="100%" id="<?php echo $device['id'] ?>"
									class="myswlist table table-border">
									<thead>
										<tr>
											<td width="60%">List Name</td>
											<td width="20%">Edit</td>
											<!--  <td width="20%">View</td>  -->
										</tr>
									</thead>
									<tbody>
                <?php
                $userid = $_SESSION['userid'];
                $myswitchlist = usrcellsitefavritelist_display($userid);
                foreach ($myswitchlist['result'] as $key => $value) {
                    ?>
                    <tr style='cursor: pointer'
											class="del_<?php echo $value['listid'];?>">
											<td width="70%"><i
												data-listid="<?php echo $value['listid'] ?>"
												data-listname=" <?php echo $value['listname']; ?>"
												data-deviceid="<?php echo $value['nodeid'] ?>"
												class="<?php echo (strtolower($value['listname']) != 'default') ? 'draggable' : '' ?> fa fa-arrows-alt"></i>&nbsp;
												<a
												href="cellsitetech-user-devicelist.php?userid=<?php echo $userid;?>&listid=<?php echo $value['listid'];?>"><?php echo ($value['listname'] == '0' ? 'My Routers' : $value['listname']); ?></a>
											</td>
											<td>&nbsp;
												<?php if($value['listtype'] != 'cz' && $value['listid'] != 0){ ?>
												<a
												href="?action=editmylist&switchlistid=<?php echo $value['listid'];?>"><i
													class="fa fa-edit"></i></a>
												<?php } ?>	
											</td>
											<!-- <td>&nbsp;<a href="cellsitetech-user-devicelist.php?userid=<?php echo $userid;?>&listid=<?php echo $value['listid'];?>"><i class="fa fa-eye" width="20" height="22"></i></a>
                      </td>  -->
										</tr>
                  <?php
                }
                ?>
                </tbody>
								</table>
								<!-- End: Start Switch list table -->
							</div>
							<!-- END : class : body-panel -->
						</div>
						<!--  class : col-md-6 -->
        <?php
        if (isset($_SESSION['switchlistid'])) {
            $switchlist = usrfavritecondev_celt_display($userid, $_SESSION['switchlistid']);
            ?>
          <div class="col-md-6 panel-warning panel-default"
							id="listedit-wrap">
							<div
								class="alert alert-secondary panel-heading-editlst text-center"
								id="mylist_delete">
								<div>
									<b>Edit List&nbsp;:&nbsp;<?php echo ($switchlist['mylistname'] == '0' ? 'My Routers' : $switchlist['mylistname']); ?> </b>
								</div>
								<div>


									<!-- Deleted selected list by drag   and drop area -->
									<span type="button"
										class="box box-danger border btn btn-edit-list-delete"><i
										class="fa fa-trash"></i>&nbsp;Drag Here To<br>DELETE </span> <span
										type="button" class="box box-danger btn btn-edit-list-delete"
										style="cursor: pointer;"
										onclick="javascript:window.location.assign('cellsitetech-dashboard.php');"
										data-target="#listedit-wrap" data-dismiss="alert">close list<span
										aria-hidden="true"><b>&times;</b></span></span>

								</div>

							</div>
							<div class="panel-body border">
								<!-- Start : View devices list table -->
								<table id="deviceslist"
									class="droppable myswlist table table-border"
									<?php echo ($_SESSION['switchlistid']!='') ? 'data-mylistid="'.$_SESSION['switchlistid'] .'"':'' ?>
									width="100%">
									<thead>
										<tr>
											<td><b>Device ID</b></td>
											<td><b>Device Name</b></td>
										</tr>
									</thead>
									<tbody id="mydevicestbl">
                <?php
            foreach ($switchlist['result'] as $key => $listitem) {
                ?>
                    <tr style='cursor: pointer'
											class='<?php echo "del_" . $listitem['nodeid']; echo " swtlistid_".$_SESSION['switchlistid']; ?>'>
											<td width="30%"><i
												data-listid="<?php echo $_SESSION['switchlistid']; ?>"
												data-deviceid="<?php echo  $listitem['nodeid'] ?>"
												data-devicename="<?php echo $listitem['devicename'] ?>"
												class='fa fa-arrows-alt draggable'></i>&nbsp;<?php echo $listitem['nodeid'] ?>
                      </td>
											<td width="70%"><?php echo $listitem  ['devicename'] ?></td>
										</tr>
                    <?php
            }
            ?>
                </tbody>
								</table>
								<!-- ENd : View devices list table -->
							</div>
						</div>
						<!-- Hidden field for getting selected switch list id -->
						<input type="hidden" name="hidd_mylistid" id="hidd_mylistid"
							value="<?php echo  $_SESSION['switchlistid']; ?>"> <input
							type="hidden" name="hidd_userid" id="hidd_userid"
							value="<?php echo  $_SESSION['userid']; ?>">
          <?php
            unset($_SESSION['switchlistid']);
        }
        ?>
          </div>
				</div>
			</div>
			<!-- START : Right side panel  -->
			<div id="rhsPanel" class="col-sm-6 col-md-6">
				<div class="maprow">
					<!-- START : Map section -->
					<div id="map_section" class="sec_with_map border table-responsive" style='<?php echo ($show_map_flag) ? "display: block" : "display: none" ?>;'>
						<!-- US Map Image -->
						<img src="resources/img/map_new.png" id="map_image"
							usemap="#United States of America" height="50%">
					</div>
					<!-- END : Map section -->
					<div class="panel-info panel-default">
						<div
							class="alert alert-secondary panel-heading-swtname router_search_box">

          <?php
        $str_marketname = $marketname;
        $switch_device_name = $_SESSION['sel_switch_name'];
        
        // Function call to get Switch name assigned for the user
        /*
         * $switch_list = get_switchlist_all_market($_SESSION['userid']);
         * if (isset($switch_list['result'])){
         * $switch_device_name = $switch_list['result'][0]['switch_name'];
         * }
         */
        if (! isset($str_marketname)) {
            ?>
              <!-- Displays user assigned switch name -->
							<b>Switch Name : &nbsp; </b>
              <?php if(count($_SESSION['swt_mswitch_arr']) > 0):?>
		<form action="" method="post" name="cellsitetech-dashboard-deviceadd-form"> 
          <div class="btn-group" id="dash-switches">
								<button type="button" id="switch_selected" name="switch_selected" class="btn dropdown-toggle"
									data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
          <?php echo $switch_device_name;?>
          </button>
								<div class="dropdown-menu">


          <?php
                foreach ($_SESSION['swt_mswitch_arr'] as $rkey => $rvalue) :
                    if (! empty($rvalue)) :
                        ?>
          <a class="dropdown-item" href="#"><?php echo $rvalue; ?></a>
          <?php
          endif;
                    
                endforeach
                ;
                ?>
          </div>
          
           <?php if(isset($_GET['switchlistid']) && $_GET['switchlistid'] > 0 && $_SESSION['userlevel'] == 5){?>
          	&nbsp;<button type="submit" value="Add All Devices" id="addalldevices" name="addalldevices" class="btn">Add All Devices</button>
          	<input type="hidden" name="hidd_mylistid" id="hidd_mylistid" value="<?php echo  $_GET['switchlistid']; ?>">
          	<input type="hidden" name="hidd_switch_selected" id="hidd_switch_selected" value="">
          <?php }?>
          
          
							</div>
							</form>


              <?php endif;?>

            <?php
        } elseif (isset($str_marketname)) {
            ?>
              <!-- Displays user selected market name -->
							<label>Market Name :&nbsp;</label><?php echo $str_marketname; ?>
              		  <?php
            $switchlistbymarket = generic_get_switch_name_by_market($str_marketname);
            if (count($switchlistbymarket['result']) > 0) :
                ?>
          <div class="btn-group" id="dash-switches">
								<button type="button" class="btn dropdown-toggle"
									data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">Select Switch</button>
								<div class="dropdown-menu">
          <?php
                foreach ($switchlistbymarket['result'] as $srkey => $srvalue) :
                    if (! empty($srvalue['switch_name'])) :
                        ?>
          <a class="dropdown-item" href="#"><?php echo $srvalue['switch_name']; ?></a>
          <?php
          endif;
                    
                endforeach
                ;
                ?>
          </div>
							</div>
          <?php endif;?>
            <?php
        }
        ?>
          <span id="map_show_link" class="pull-right sec_without_map" style='<?php echo ($show_map_flag) ? "display: none" : "display: block" ?>' onclick="showMap()"><b>Show
									Map</b>&nbsp; <img width="25px"
								src="resources/img/usmap-icon.png">&nbsp;</span> <span id="map_hide_link" class="pull-right sec_with_map" style='<?php echo ($show_map_flag) ? "display: block" : "display: none" ?>' onclick="hideMap()"><b>Hide
									Map</b>&nbsp; <img width="25px"
								src="resources/img/usmap-icon.png">&nbsp;</span>
						</div>
						<div id="container_mymarketswitches" class="panel-body">
							<!-- $show_map_flag is used to set default value invisiblie -->
							<div id="sw_result_without_map" class="" style='<?php echo ($show_map_flag) ? "display: block" : "display: block" ?>; '>
          <?php
        // if(isset($switch_device_name) && $switch_device_name != '' ) {
        
        if (! isset($str_marketname)) { // IF No Market is selected
            $list_type = 'user';
            // Get Routersfor users assigned switch
            ?>
                <input type="hidden" id="hidd_list_for"
									value="<?php echo $switch_device_name ?>" name=""> <input
									type="hidden" id="hidd_list_type"
									value="<?php echo $list_type ?>" name="">
                <?php
            // $device_details = get_swt_user_routers_list_datatable($switch_device_name, $list_for);
        } else { // If market is clicke on the map
               // $list_for = 'market';
            $list_type = 'market';
            // Get routers for the selected market
            ?>
                <input type="hidden" id="hidd_list_for"
									value="<?php echo strtolower($str_marketname) ?>" name=""> <input
									type="hidden" id="hidd_list_type"
									value="<?php echo $list_type ?>" name="">
                <?php
            // $device_details = get_swt_user_routers_list_datatable(strtolower($str_marketname), $list_for);
        }
        ?>
          <!-- <div class="table-responsive"> -->
								<table id="cellsitetech_user_devices" class="table table-border">
									<thead>
										<tr>
											<th><input type="checkbox" id="selectall" name="selectall"
												value="1"></th>
											<th style="display: none;"><b>ID</b></th>
											<th><b>Tech Name</th>
											<th><b>SiteID / Switch</th>
											<th><b>Site Name</th>
											<th><b>Device Name</th>
											<th><b>IP Address</th>
										</tr>
									</thead>
								</table>
								<!-- </div> -->
              <?php
            // }
            ?>
          </div>
							<!-- END : Switch results without map -->

						</div>
					</div>
				</div>
			</div>
			<!-- Start: Modal popup place holder -->
			<div id="mycmdModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Content will be loaded here from "remote.php" file -->
					</div>
				</div>
			</div>
			<!-- END: Modal popup place holder -->

			<!-- Hidden field for user id value -->
			<input type="hidden" id="hidd_userid"
				value="<?php echo $_SESSION['userid'] ?>">

			<!-- include_once custom js file for switchtech_devicelist page -->
			<div style="clear: both;"></div>
		</div>
	</div>


 <?php
    // Footder section include_once file
    include_once ('footer.php');
  ?>
</body>
</html>
