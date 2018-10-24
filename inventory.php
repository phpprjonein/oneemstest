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
// check_user_authentication('1'); // cellsite tech type user
if ($_SESSION['userlevel'] == 1)
    include_once ('config/session_check_cellsite_tech.php');
else if ($_SESSION['userlevel'] == 2)
    include_once ('config/session_check_switch_tech.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Inventory page Description: User has navigated to the Inventory page.";
write_log($mesg);

$userid = $_SESSION['userid'];
$succss_msg = '';

?>
<!DOCTYPE html>
	<html>
		<head>
			<?php include_once("includes.php");  ?>
			<script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
		</head>
	<body>

<!-- container-fluid -->
	<div class="container-fluid">
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

<!-- inventory check content row -->
					<div class="row">

<!-- left side -->
<!-- inventory form div -->
						<div class="col-md-4 col-sm-12">
							<hr class="d-md-none" />
							<!-- <h4 id="item-1">Inventory</h4> -->
							<p>

<!-- inventory form -->
							<form id="selectInventoryCategories" method="post">

<!-- select inventory type -->
								<div class="form-group f4 required" data-fid="f4">
									<label class="control-label" for="f4">Inventory Type</label>
									<input name="f4" value="Golden" type="hidden">
										<select id="select_inventory_type" class="form-control custom-select" id="f4" name='select_inventory_type[]'' data-rule-required="true">
											<option value="">- SELECT Inventory Type -</option>
											<option value="hw_inventory">Hardware</option>
											<option value="sw_inventory">Software</option>
											<option value="devices">Device Name / IP</option>
										</select>
								</div>
<!-- /select inventory type -->

<!-- select region from db -->
								<?php
									$configtmpddwndata = getconfigtempldpdwntbl('configscriptpurpose');  ?>
									<div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Region</label>
										<input name="f4" value="Golden" type="hidden">
										<select id="select_region" class="form-control custom-select" id="f4"  name="select_region" data-rule-required="true">
											<option value="NULL">- SELECT Region -</option>

<!-- iterate through Region values from switch_map table -->
											<?php
												$region_list = get_inventory_region_list();
												foreach ($region_list['result'] as $rkey => $rvalue) :
													if (! empty($rvalue['region'])) :
											?>
											<option value="<?php echo $rvalue['region'];?>"><?php echo $rvalue['region']; ?></option>
											<?php
												endif;
												endforeach;
												if (count($region_list['result']) > 1) :
											?>
											<?php endif; ?>
										</select>
									</div>
<!-- select region from db -->

<!-- select market from db -->
								<?php
									$configtmpddwndata = getconfigtempldpdwntbl('configscriptpurpose');  ?>
									<div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Market</label>
										<input name="f4" value="" type="hidden">
											<select id="select_market" class="form-control custom-select" id="f4"  name="select_market" data-rule-required="true">
												<option value="NULL">- SELECT Market -</option>

												<?php
													$market_list = get_inventory_market_list();
        											foreach ($market_list['result'] as $rkey => $rvalue) :
            										if (! empty($rvalue['market'])) :
                								?>
												<option value="<?php echo $rvalue['market'];?>"><?php echo $rvalue['market']; ?></option>
          										<?php
          											endif;
													endforeach;
													if (count($market_list['result']) > 1) :
												?>
												<?php endif; ?>
											</select>
									</div>
<!-- select market from db -->

<!-- initiate stream_resolve_include_path -->
									<input type="submit" name="Submit" value="Show Files" class="btn config-submit">
<!-- /initiate stream_resolve_include_path -->

									<p>&nbsp;</p>

								</form>
<!-- /inventory form -->

							</div>
<!--/ inventory form div -->
<!-- left side -->

<!-- right side -->
							<div class="col-md-8 col-sm-12">
							<?php
									@$folderOne = $_POST['select_inventory_type'];
									if( is_array($folderOne)){
									while (list ($key, $val) = each ($folderOne))
										{

// set the Region and Market values from respective dropdowns
											$selectFolder = ($_POST['select_inventory_type']);
											$selectRegion = ($_POST['select_region']);
											$selectMarket = ($_POST['select_market']);

// concatenate Region and Market names into $filenameString
											$filenameString = ("$selectRegion-$selectMarket");
											$folderLocation = glob('sd/{'.$val.'}/{'.$filenameString.'}*', GLOB_BRACE);

// check to see if dropdown values are null or empty
// show results if values are valid
											if (!empty($folderLocation)){
												echo '<table class="table table-striped">
												<tbody id="loadtemplates">';
												foreach ($folderLocation as $key=>$val)
													{
														echo
															'<tr>';
															$path_parts = pathinfo($val);
														echo
																'<td class="templname">' . $path_parts ['basename'], "\n" .'</td>
																<td><a href="' . $val . '" class="btn btn-primary float-right" role="button" target="_blank">download</a></td>
															</tr>';
													}
												echo
												'</tbody>
												</table>';
											}

// show error messaging if values are invalid
											else {
												echo '<p class="alert alert-danger"><b class="text-danger">Your search for </b> ' . $folderLocation . ' <b class="text-danger">and</b> ' . $selectRegion . ' <b class="text-danger">and</b> ' . $selectMarket . ' <b class="text-danger">returned no results.</b><br>Please select different criteria from the dropdown menus on the left.</p>';
											}
										}
									}
								?>
							</div>
<!-- /right side -->

							</div>
<!-- inventory check content row -->

						</div>
					</section>
<!-- /Main content -->

				</div>
<!-- Content Wrapper. Contains page content -->

			</div>
<!-- container-fluid -->

<!-- footer div -->
		<?php include_once ('footer.php'); ?>
<!-- /footer div -->

</body>
</html>