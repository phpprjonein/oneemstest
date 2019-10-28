<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';
/*
  print '<pre>';
  echo "Device Name";
  echo "<br>";
  print_r($_POST['f14']);
  die;
*/  
$bmbps = get_bandwidth_mbpsvalues($_POST['Bandwidth_(Mbps)']);
 /*
 * $vars['usrvars'] = configtemplate_elemvalue_pos_script('usrvars', 'usrvarname', 'usrvarval');
 * foreach ($vars['usrvars'] as $key => $val){
 * $value = str_replace(' ', '_', $val['usrvarname']);
 * $result['usrvars'][$val['usrvarname']] = $_POST[$value];
 * }
 *
 * print_r($result);
 *
 * die;
 */

// Static variable values set
if (isset($_POST['clear'])) {
    if (strtolower($_POST['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

$templname = $_POST['radioGroup'];
// $templname = 'Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1';

user_session_check();

if ($_SESSION['userlevel'] == 1)
    include_once ('config/session_check_cellsite_tech.php');
else if ($_SESSION['userlevel'] == 2)
    include_once ('config/session_check_switch_tech.php');
else if ($_SESSION['userlevel'] == 8)
    include_once ('config/session_check_admin.php');
else if ($_SESSION['userlevel'] == 9)
    include_once ('config/session_check_limited_admin.php');

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Generate script 2 page Description: Cell Site Tech has chosen their configuration and is ready to edit their script's editable fields.";
write_log($mesg);
?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script
	src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?>
			<?php
$values = array(
    'Generate Script' => '#'
);
echo generate_site_breadcrumb($values);
?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<!-- backup management content row -->
					<div class="row">

						<!-- router selection content row -->
						<div class="col-sm-12 col-md-4">
							<div class="jf-form">

								<!-- router scripting selection form div -->
								<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2"
									action='admin.php' method='post' enctype='multipart/form-data'
									novalidate autocomplete="on">
									<p style="word-wrap: break-word;">
										<small><b><?php echo $templname; ?></b></small>
									</p>
									<hr>
									<input type="hidden" name="method" value="validateForm"> <input
										type="hidden" id="serverValidationFields"
										name="serverValidationFields" value="">

									<!-- select purpose options -->
									<div class="form-group f4 required" data-fid="f4">
										<label class="control-label" for="f4">Select Purpose</label> <select
											class="form-control custom-select" id="f4" name="f4"
											data-rule-required="true" disabled>
											<option value="<?php echo $_POST['f4'];?>"><?php echo $_POST['f4']; ?></option>
											<!-- <option value="asr920">XXXX</option> -->
										</select>
										<input name="f4" value="<?php echo $_POST['f4'];?>" type="hidden">
									</div>
									<!-- /select purpose options -->

									<!-- select device series options -->
									<div class="form-group f7 required" data-fid="f7">
										<label class="control-label" for="f7">Select Device Series</label>
										<select class="form-control custom-select" id="f7" name="f7"
											data-rule-required="true" disabled>
											<!-- <option value="">ASR9210</option>  -->
											<option value="<?php echo $_POST['f7'];?>"><?php echo $_POST['f7'];?></option>
										</select>
									</div>
									<!-- /select device series options -->

									<!-- select OS version options -->
									<div class="form-group f8 required" data-fid="f8">
										<label class="control-label" for="f8">Select OS Version</label>
										<select class="form-control custom-select" id="f8" name="f8"
											data-rule-required="true" disabled>
											<option value="<?php echo $_POST['f8'];?>"><?php echo $_POST['f8'];?></option>
											<option></option>
										</select>
									</div>
									<!-- /select OS version options -->

									<!-- select RAN vendor options -->
									<div class="form-group f9 required" data-fid="f9">
										<label class="control-label" for="f9">Select RAN vendor</label>
										<select class="form-control custom-select" id="f9" name="f9"
											data-rule-required="true" disabled>
											<!-- <option value="">ALL</option> -->
											<option value="<?php echo $_POST['f9'];?>"><?php echo $_POST['f9'];?></option>
										</select>
									</div>
									<!-- /select RAN vendor options -->

									<!-- select RAN vendor options -->
									<div class="form-group f10 required" data-fid="f10">
										<label class="control-label" for="f10">Select Script Type</label>
										<select class="form-control custom-select" id="f10" name="f10"
											data-rule-required="true" disabled>
											<option value="<?php echo $_POST['f10'];?>"><?php echo $_POST['f10'];?></option>
											<option></option>
										</select>
									</div>
									<!-- /select RAN vendor options -->

									<!-- select region options -->
									<!-- <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f11'];?>"><?php echo $_POST['f11'];?></option>
              </select>
            </div> -->
									<!-- /select region options -->

									<!-- select market options -->
									<!-- <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
              <select class="form-control custom-select" id="f13" name="f13" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f13'];?>"><?php echo $_POST['f13'];?></option>
                <option></option>
              </select>
            </div> -->
									<!-- /select market options -->

									<!-- select switch type options -->
			<div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Type</label>
              <select class="form-control custom-select" id="f11" name="f11"
											data-rule-required="true" disabled>
											<!-- <option value="">ASR9210</option>  -->
											<option value="<?php echo $_POST['f11'];?>"><?php echo $_POST['f11'];?></option>
										</select>
            </div>
									<!-- /select switch type options -->
			<div class="form-group f14 required bandwidth" data-fid="f14">						
				<label class="control-label" for="exampleInputEmail1">Device Name</label>
				<input type="Device Name" name="f14" class="form-control" disabled id="select_device_name" value="<?php echo $_POST['f14'];?>" placeholder="">						
			</div>								
									

									<div class="clearfix"></div>
								</form>
								<!-- /router scripting selection form div -->

							</div>
						</div>
						<!-- /router selection content row -->
						<!-- right side -->
						<!-- script output -->
						<div class="col-sm-12 col-md-8">

							<!-- template output content -->	
							<div class="row">
								<div class="col">
									<?php $results = config_get_templates_from_templname($templname);?>

									<?php foreach ($results as $key=>$val):?>
									<?php $newarr[intval($val['elemid']/10)][] = array('elemid' => $val['elemid'], 'elemvalue' => $val['elemvalue'], 'editable' => $val['editable'], 'tabname' => $val['tabname']); ?>
									<?php endforeach;?>
			
									<div id="file_process">
										<form name="file_process" action="cellsite-config-process.php"
											method="post" class="border">
											<input type="hidden" value="<?php echo $templname; ?>"
												name="templname" /> <input type="hidden"
												value="<?php echo $_POST['f7']; ?>" name="deviceseries" /> <input
												type="hidden" value="<?php echo $_POST['f8']; ?>"
												name="deviceos" />
												<input
												type="hidden" value="<?php echo $_POST['f11']; ?>"
												name="switch_type" />
												<input
												type="hidden" value="<?php echo (count($newarr)+1); ?>"
												name="last-element" id="last-element" />
											<div class="tags p-b-2">
												<div class="form-group cb-control">
													<label>Hide Readonly Fields&nbsp;</label><input
														type="checkbox" value="1" id="show_hide_readonly" />
												</div>
												<a href="#" id="append-interface-section" style="position:fixed; margin-left:700px"><font size="25">+</font></a>												
												<?php
												$output = '';
												$pink_box_min_size = 10;
												$vars['globalvars'] = configtemplate_elemvalue_pos_script('globalvars', 'gvarname', 'gvarval');
												foreach ($vars['globalvars'] as $key => $val) {
													$result['globalvars'][$_POST['f11'] . $val['gvarname']] = $val['gvarval'];
												}
												
												$vars['usrvars'] = configtemplate_elemvalue_pos_script('usrvars', 'usrvarname', 'usrvarval');
												foreach ($vars['usrvars'] as $key => $val) {
													$value = str_replace(' ', '_', $val['usrvarname']);
													$result['usrvars'][$_POST['f11'] . $val['usrvarname']] = $_POST[$value];
												}
												
												$vars['marketvars'] = configtemplate_elemvalue_pos_script_market('marketvars', 'mvarname', 'mvarval', $_POST['f11']);
												foreach ($vars['marketvars'] as $key => $val) {
													$result['marketvars'][$_POST['f11'] . $val['mvarname']] = $val['mvarval'];
												}
												
												$vars = configtemplate_elemvalue_pos_script_switch_name($_POST['f11']);
												
												foreach ($vars as $key => $val) {
													$result['switchvars'][$_POST['f11'] . $val['swvarname']] = $val['swvarval'];
												}
												
												//Pre populate device name
												$result['globalvars'][$_POST['f11'] . 'device name'] = $result['usrvars'][$_POST['f11'] . 'device name'] = $result['marketvars'][$_POST['f11'] . 'device name'] = $result['switchvars'][$_POST['f11'] . 'device name'] = $_POST['f14'];
												
												$checkcount=0;
												
												for ($k = 1; $k <= count($newarr); $k ++) {
													if (count($newarr[$k]) == 1) {
														$output .= '<div class="form-group">';
														if ($newarr[$k][0]["editable"] == 0) {
															if(strpos($newarr[$k][0]["elemvalue"], 'ASR9010-01') || strpos($newarr[$k][0]["elemvalue"], 'ASR9010-02')){
																$output .= '<div class="jf-form form-group col-xs-10 col-sm-3 col-md-3 col-lg-12 alert alert-secondary panel-heading-lstmgmt"><b>'.$newarr[$k][0]["elemvalue"].'</b></div>';
															}
															
															$output .= "<input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $newarr[$k][0]["elemvalue"] . "'><span class='form-non-editable-fields'><label class='readonly'>" . $newarr[$k][0]["elemvalue"] . "</label></span>";
														} else {
															$pink_box_size = strlen($result[$newarr[$k][0]["tabname"]][$_POST['f11'] . $newarr[$k][0]["elemvalue"]]);
															$pink_box_size = ($pink_box_size == 0 || $pink_box_size < $pink_box_min_size) ? $pink_box_min_size : $pink_box_size;
															$output .= "<span class='form-editable-fields'><input type='text' size='" . $pink_box_size . "'  name='loop[looper_" . $k . "][]' class='form-control cellsitech-configtxtinp border border-dark' value='" . $result[$newarr[$k][0]["tabname"]][$_POST['f11'] . $newarr[$k][0]["elemvalue"]] . "'></span>";
														}
														$output .= '</div>';
													} else {
														$output .= '<div class="form-group">';
														$editable = 0;
														$outputin = '';
														for ($l = 0; $l < count($newarr[$k]); $l ++) {$checkcount++;
															if ($newarr[$k][$l]["editable"] == 0) {
																$rowval = generatescript_str_preprocess($newarr[$k][$l]["elemvalue"], $bmbps);
																$rowval_arr = explode('||', $rowval);
																if(count($rowval_arr) > 1){
																	$outputin .= "<label class='readonly'>" . $rowval_arr[0] . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $rowval_arr[1] . "'>";
																}else{
																	$outputin .= "<label class='readonly'>" . $rowval . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $rowval . "'>";
																}
																//$outputin .= "<label class='readonly'>" . $rowval . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $rowval . "'>";
															} else {
																$editable = 1;
																/*
																 * if($newarr[$k][$l]["tabname"] == 'usrvars'){
																 * echo $newarr[$k][$l]["elemvalue"];
																 * die;
																 * }
																 */
																$pink_box_size = strlen($result[$newarr[$k][$l]["tabname"]][$_POST['f11'] . $newarr[$k][$l]["elemvalue"]]);
																$pink_box_size = ($pink_box_size == 0 || $pink_box_size < $pink_box_min_size) ? $pink_box_min_size : $pink_box_size;
																
																$outputin .= "<input type='text' size='" . $pink_box_size . "' name='loop[looper_" . $k . "][]' class='form-control cellsitech-configtxtinp border border-dark' value='" . $result[$newarr[$k][$l]["tabname"]][$_POST['f11'] . $newarr[$k][$l]["elemvalue"]] . "'>";
															}
														}
														if ($editable == 1) {
															$output .= "<span class='form-editable-fields'>" . $outputin . "</span><input type='hidden' name='edit[looper_" . $k . "][]' value='1'>";
														} else {
															$output .= "<span class='form-non-editable-fields'>" . $outputin . "</span>";
														}
														$output .= '</div>';
													}
												}$output .= '<span class="form-editable-fields-to-append"> </span>';
												echo $output .= '</div>';
												
												//code start for new section addition by Swapnil
												/* $usrvars = generic_get_usrvars_section();$limit=count($usrvars['result'])/2;
												$s=0;
												if(count($usrvars['result'])<2){
													echo $output .= '</div>';
												}
												else{
													for($usrvarloop=0;$usrvarloop<$limit;$usrvarloop++){
														$filename = 'resources/scripts/ASR920_eNodeB_interface_section_v7.txt';
														//$filename = '/usr/apps/oneems/fs1/resources/scripts/ASR920_eNodeB_interface_section_v7.txt';
														$fd = fopen($filename, "r");
														$line = $checkcount;				
														
														while (! feof($fd)) {
															++ $line;
															$contents = fgets($fd, filesize($filename));
															$delimiter = "#";
															$splitcontents = explode($delimiter, $contents);
															$splitcontcount = count($splitcontents);
															if ($splitcontcount > 1) {
																$output .= '<div class="form-group" id="mysection" style="display:none">';
																$output_inner1 = '';
																$l = 1;
																foreach ($splitcontents as $color) {
																	if (! empty($color)) {
																		if (substr_count(strtolower('#' . $color), "#x") > 0 || substr_count(strtolower('#' . $color), "#y") > 0 || substr_count(strtolower('#' . $color), "#x.x.x.x") > 0 || substr_count(strtolower('#' . $color), "#y.y.y.y") > 0 || substr_count(strtolower('#' . $color), "#z.z.z.z") > 0 || substr_count(strtolower('#' . $color), "#a.a.a.a") > 0 || substr_count(strtolower('#' . $color), "#b.b.b.b") > 0) {
																	
																			$output .= "<span class='form-editable-fields'><input type='text' size='" . $pink_box_size . "' name='loop[looper_" . $line . "][]' class='form-control cellsitech-configtxtinp border border-dark' value='".$usrvars['result'][$s]['usrvarval']."'></span><input type='hidden' name='edit[looper_" . $line . "][]' value='1'>";
																			$s++;
																		} else {
																			if (strlen($color) != 0) {
																				$orgcolor = $color;
																				$color = ($color == " ") ? '&nbsp;' : $color;
																				//$output_inner .= "<label class='readonly'>" . $color . "</label><input type='text' style='display:none !important;' size='" . strlen($orgcolor) . "' name='loop[looper_" . $line . "][]' value='" . $orgcolor . "'  class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_" . $line . "][]' value='0' ><input type='hidden' name='looptabler[looper_" . $line . "][]' value='' >";
																				$output .= "<span class='form-non-editable-fields'><label class='readonly'>" . $color . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $line . "][]' value='" . $color . "'></span>";
																			}
																		}
																	}
																	$l ++;
																};
																
																$output .= '<span class="form-editable-fields">' . $output_inner1 . '</span>';
																
																$output .= '</div>';
															} elseif ($splitcontcount == 1) {
																foreach ($splitcontents as $color) {
																	if (! empty($color)) {
																		$orgcolor = $color;
																		$color = ($color == " ") ? '&nbsp;' : $color;
																		$output .= "<div class='form-group'  id='mysection1' style='display:none'><span class='form-non-editable-fields'><label  class='readonly'>" . $color . "</label><input style='display:none !important;' type='text' size='" . strlen($orgcolor) . "' name='loop[looper_" . $line . "][]' value='" . $orgcolor . "' class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_" . $line . "][]' value='0' ><input type='hidden' name='looptabler[looper_" . $line . "][]' value='' ></span></div>";
																	}
																};
															};
														};
														fclose($fd);//code end for new section addition by Swapnil
														 
													}
												}
												
												echo $output .= '</div>';*/
												?>
											</div>
											<div>
												<br>
												<hr>
												<a href="#top" class="border"><b>^ Back to top</b></a>
												<hr>
											</div>
											<div class="form-group">
												<input type="hidden" name="tmplcategory" value="<?php echo $_POST['tmplcategory'];?>">
												<button type="submit" value="Download Script" name="action"
													class="btn btn-primary btn-lg">DOWNLOAD</button>
													<?php if($_POST['tmplcategory'] != 'Golden'){ ?>
												<button type="submit" value="Execute Script" name="action"
													class="m-2 btn btn-primary btn-lg">Execute</button>
													<?php } ?>
											</div>
										</form>
									</div>
									<p></p>
								</div>
							</div>
							<!-- /template name content -->
							<!--
<div class="row">
  <div class="col">
    <button type="submit" class="btn btn-primary btn-lg">DOWNLOAD</button>
  </div>
</div> -->
							<!-- /right side -->
							<!-- /script output -->

						</div>
						<!-- /backup management content row -->
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->
        <?php include_once ('footer.php'); ?>
    </body>
</html>