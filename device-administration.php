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
include_once ('config/session_check_cellsite_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Discovery Results page Description: Cell Site Tech has navigated to the Discovery Results page.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script src="resources/js/device-administration.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body>
	<!-- container div -->
	<div class="container-fluid" id="disc-mgt-screen">
<?php include_once ('menu.php'); ?>
		<?php
$values = array(
        'Discovery Results' => '#'
);
echo generate_site_breadcrumb($values);
?>
        <!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="manual-device-discovery">

					<!-- Modal Header -->
					<div class="modal-header" id="restoremodalhdr">
						<h5 class="modal-title text-center" id="modalLabelLarge">Manual
							Device Discovery</h5>
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<!-- Modal body -->
					<div class="modal-body"></div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
							data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="mandiscsubmit">Save
							changes</button>
					</div>
				</div>
			</div>
		</div>



		


		<!-- IP management table row -->
		<div class="row">

			<!-- table pill navigation -->
			<div class="col col-md-2 col-sm-12">
				<div class="nav flex-column nav-pills" id="v-pills-tab"
					role="tablist" aria-orientation="vertical">
					<a
						class="nav-link btn-missed <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Missed')  || empty($_SESSION['disc_page_tab'])):?>active<?php endif;?>"
						id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1"
						role="tab" aria-controls="v-pills-tab1" aria-selected="false">Cae1</a>
					<a
						class="nav-link btn-new <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'New'):?>active<?php endif;?>"
						id="v-pills-tab2-tab" data-toggle="pill" href="#v-pills-tab2"
						role="tab" aria-controls="v-pills-tab2" aria-selected="false">Cae2</a>
					<a
						class="nav-link btn-ok <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'OK'):?>active<?php endif;?>"
						id="v-pills-tab3-tab" data-toggle="pill" href="#v-pills-tab3"
						role="tab" aria-controls="v-pills-tab3" aria-selected="false">Cae3</a>
					<a
						class="nav-link btn-manual <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Manual Discovery'):?>active<?php endif;?>"
						id="v-pills-case4-tab" data-toggle="pill" href="#v-pills-case4"
						role="tab" aria-controls="v-pills-case4" aria-selected="false">Cae4</a>
						
				</div>
			</div>
			<!-- /table pill navigation -->

			<!-- table content row -->
			<div class="col-11 col-md-10">

				<!-- IP container div -->
				<div class="tab-content" id="v-pills-tabContent">
					<!-- missed table content -->
					<div
						class="tab-pane fade table-responsive <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Missed') || empty($_SESSION['disc_page_tab'])):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>"
						id="v-pills-tab1" role="tabpanel"
						aria-labelledby="v-pills-tab1-tab">
						<table class="table table-sm table-striped ip-missed-table"
							id="ip-missed-table">
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
									<th scope="col">
										<!-- Remove / Update -->
									</th>
									<th scope="col" style="display: none;">Region</th>
									<th scope="col" style="display: none;">Market</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_discovery_dataset('m');
                if (isset($resultset['result'])) {
                    foreach ($resultset['result'] as $key => $value) {
                        if (test_ipv6_address($value['deviceIpAddr'])) {
                            $value['ipvsix'] = $value['deviceIpAddr'];
                        } else {
                            $value['ipvfour'] = $value['deviceIpAddr'];
                        }
                        ?>
                        <tr>
									<td><?php echo $value['ipvfour'];?></td>
									<td><?php echo $value['ipvsix'];?></td>
									<td><?php echo $value['devicename'];?></td>
									<td><?php echo $value['csr_site_id'];?></td>
									<td><?php echo $value['csr_site_name'];?></td>
									<td><?php echo $value['deviceseries'];?></td>
									<td><?php echo $value['deviceos'];?></td>
									<td><?php echo $value['nodeVersion'];?></td>
									<td><?php //echo $value['timepolled'];?><?php echo $value['lastpolled'];?></td>
									<td>
										<!-- <button type="button"  data-toggle="modal" class="btn btn-danger missed_update">UPDATE</button> -->
									</td>
									<td style="display: none;"><?php echo $value['region'];?></td>
									<td style="display: none;"><?php echo $value['market'];?></td>
								</tr>
                   <?php
                    }
                }
                ?>
                </tbody>
						</table>
					</div>
					<!-- /missed table content -->

					<!-- new table content -->
					<div
						class="tab-pane fade table-responsive <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'New'):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>"
						id="v-pills-tab2" role="tabpanel" aria-labelledby="v-pills-tab2-tab">
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
									<th scope="col " style="display: none;">Add</th>
									<th scope="col" style="display: none;">Region</th>
									<th scope="col" style="display: none;">Market</th>
									<th scope="col" style="display: none;">Upsince</th>
									<th scope="col" style="display: none;">Site ID</th>
								</tr>
							</thead>
							<tbody>
                <?php
                $resultset = load_discovery_dataset('n');
                if (isset($resultset['result'])) {
                    foreach ($resultset['result'] as $key => $value) {
                        if (test_ipv6_address($value['deviceIpAddr'])) {
                            $value['ipvsix'] = $value['deviceIpAddr'];
                        } else {
                            $value['ipvfour'] = $value['deviceIpAddr'];
                        }
                        ?>
                        <tr>
									<td><?php echo $value['ipvfour'];?></td>
									<td><?php echo $value['ipvsix'];?></td>
									<td><?php echo $value['devicename'];?></td>
									<td><?php echo $value['deviceseries'];?></td>
									<td><?php echo $value['deviceos'];?></td>
									<td><?php echo $value['nodeVersion'];?></td>
									<td><?php echo($value['lastpolled']);?></td>
									<td>
										<!--<button type="button" class="btn btn-danger addDeviceModal">ADD</button>-->
									</td>
									<td style="display: none;"><?php echo $value['region'];?></td>
									<td style="display: none;"><?php echo $value['market'];?></td>
									<td style="display: none;"><?php echo $value['upsince'];?></td>
									<td style="display: none;"><?php echo $value['csr_site_id'];?></td>
								</tr>
                   <?php
                    }
                }
                ?>
                    </tbody>
						</table>
					</div>
					<!-- /new table content -->

					<!-- ok table content -->
					<div
						class="tab-pane fade table-responsive <?php if(isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'OK'):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>"
						id="v-pills-tab3" role="tabpanel" aria-labelledby="v-pills-tab3-tab">
            	<?php $resultset =  load_discovery_dataset('k'); ?>
              <table id="ip-ok-table"
							class="table table-sm table-striped ip-ok-table">
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
                    <th scope="col" style="display: none;"><a href="#"
										id="select_all" onclick="ok_all_item();">Select&nbsp;All</a></th>
                    <?php else:?>
                    <th scope="col" style="display: none;">Select&nbsp;All</th>
                    <?php endif; ?>
                    <th scope="col" style="display: none;">Region</th>
									<th scope="col" style="display: none;">Market</th>
								</tr>
							</thead>
							<tbody>
                  	<?php
                if (isset($resultset['result'])) {
                    foreach ($resultset['result'] as $key => $value) {
                        if (test_ipv6_address($value['deviceIpAddr'])) {
                            $value['ipvsix'] = $value['deviceIpAddr'];
                        } else {
                            $value['ipvfour'] = $value['deviceIpAddr'];
                        }
                        ?>
                        <tr>
									<td><?php echo $value['ipvfour'];?></td>
									<td><?php echo $value['ipvsix'];?></td>
									<td><?php echo $value['devicename'];?></td>
									<td><?php echo $value['csr_site_id'];?></td>
									<td><?php echo $value['csr_site_name'];?></td>
									<td><?php echo $value['deviceseries'];?></td>
									<td><?php echo $value['deviceos'];?></td>
									<td><?php echo $value['nodeVersion'];?></td>
									<td><?php //echo $value['timepolled'];?><?php echo $value['lastpolled'];?></td>
									<td style="display: none;"><label class="form-check-label"> <input
											class="form-check-input" type="checkbox" id="inlineCheckbox1"
											value="<?php echo $value['id'];?>">
									</label></td>
									<td style="display: none;"><?php echo $value['region'];?></td>
									<td style="display: none;"><?php echo $value['market'];?></td>
								</tr>
                   <?php
                    }
                }
                ?>
                </tbody>
						</table>
					</div>
					<!-- /ok table content -->
					<div
						class="tab-pane fade <?php if((isset($_SESSION['disc_page_tab']) && $_SESSION['disc_page_tab'] == 'Manual Discovery')):?>show active<?php unset($_SESSION['disc_page_tab']); endif;?>"
						id="v-pills-case4" role="tabpanel"
						aria-labelledby="v-pills-ok-manual">
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
									<th scope="col " style="display: none;">Add</th>
									<th scope="col" style="display: none;">Region</th>
									<th scope="col" style="display: none;">Market</th>
									<th scope="col" style="display: none;">Upsince</th>
									<th scope="col" style="display: none;">Site ID</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>	
				</div>		
				</div>
			</div>
			<!-- /IP container div -->
		</div>
		<!-- /table content row -->
	</div>
	<!-- /IP management table row -->
<?php include_once ('footer.php'); ?>
</body>
</html>
