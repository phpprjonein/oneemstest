<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';
onerr();
// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();

if ($_SESSION['userlevel'] == 1)
    include_once ('config/session_check_cellsite_tech.php');
else if ($_SESSION['userlevel'] == 2)
    include_once ('config/session_check_switch_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Generate script page Description: Cell Site Tech has navigated to the Generate Script page.";
write_log($mesg);

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
<script src="resources/js/inventory.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid ems-inventory" id="ems-inventory">
	<?php include_once ('menu.php'); ?>
		    <?php
    $values = array(
        'Inventory' => '#'
    );
    echo generate_site_breadcrumb($values);
    ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
					<!-- inventory management content row -->
						<div class="row">
							<!-- router selection content row -->
							<div class="col-sm-12 col-md-4 inventory-leftselector">
								<div class="jf-form">
								
                        			<!-- select Inventory Type options -->
                        			<?php $configtmpddwndata = generic_get_deviceseries(); ?>
                                    <div class="form-group inventory_type required" data-fid="inventory_type">
										<label class="control-label" for="inventory_type">Inventory Type</label>
										<select class="form-control custom-select" id="select_inventory_type" name="select_inventory_type" data-rule-required="true">
											<option value="">- SELECT Inventory Type -</option>
											<option value="hw_inventory">Hardware</option>
											<option value="sw_inventory">Software</option>
											<option value="devices">Device Name / IP</option>
             							</select>
									</div>
									<!-- select SELECT Region options -->
                        			<?php $region_list = get_inventory_region_list(); ?>
                                    <div class="form-group region_list required" data-fid="region_list">
										<label class="control-label" for="region_list">Region</label>
										<select class="form-control custom-select" id="select_region_list" name="select_region_list" data-rule-required="true">
											<option value="">- SELECT Region -</option>
										<?php
											foreach ($region_list['result'] as $rkey => $rvalue) :
													if (! empty($rvalue['region'])) :
										?>
											<option value="<?php echo $rvalue['region'];?>"><?php echo $rvalue['region']; ?></option>
										<?php
											         endif;
										      endforeach;
										?>
             							</select>
									</div>
									<!-- select SELECT Market options -->
                        			<?php //$market_list = get_inventory_market_list(); ?>
                                    <div class="form-group market_list required" data-fid="market_list">
										<label class="control-label" for="market_list">Market</label>
										<select class="form-control custom-select" id="select_market_list" name="select_market_list" data-rule-required="true">
											<option value="">- SELECT Market -</option>
										<?php
											foreach ($market_list['result'] as $rkey => $rvalue) :
													if (! empty($rvalue['market'])) :
										?>
											<option value="<?php echo $rvalue['market'];?>"><?php echo $rvalue['market']; ?></option>
										<?php
											         endif;
										      endforeach;
										?>
             							</select>
									</div>
									<div class="clearfix"></div>
									<p>&nbsp;</p>
									<!-- /router scripting selection form div -->
									<div class="row" id="show_files_act">
            							<div class="col">
            								<button type="submit" class="btn">Show Files</button>
            							</div>
            						</div>
								</div>
							</div>
							<!-- /router selection content row -->
							<!-- right side -->
							<!-- script output -->
							<div class="col-sm-12 col-md-8" id="inventory_template_info">
								<div class="row">
									<div class="col">
                                            <?php
                                            //$path = '/usr/apps/oneems/config/bkup/sd';
                                            //$path = '/usr/apps/oneems/sd/sw_inventory';
                                            $path = '/var/www/html/oneems/sw_inventory';
                                            $contents = array_values(array_diff(scandir($path), array(
                                                '.',
                                                '..'
                                            )));
                                            ?>
                                            <table id="inventory-files" class="display table" style="display:none;">
											<thead>
												<tr>
													<th>Filename</th>
													<th>Download</th>
												</tr>
											</thead>
											<tbody>
                                                    <?php $i=1;?>
                                                    <?php
                                                    foreach ($contents as $key => $val) :
                                                    ?>
                                                        <tr id="row_<?php echo $i;?>">
															<td><?php echo $val; ?></td>
															<td><a href="#" class="btn" role="button">download</a></td></td>
														</tr>
                                                    <?php $i++; endforeach; ?>
                                            </tbody>
											</table>
											
											
									</div>
								</div>
								<!-- /right side -->
								<!-- /script output -->
							</div>
							<!-- /backup management content row -->
						</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->
        <?php include_once ('footer.php'); ?>
    </body>
</html>
