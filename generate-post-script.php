<?php
include_once "classes/db2.class.php";
include_once "classes/paginator.class.php";
include_once 'functions.php';

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

$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1 ) ? "Cell sitetechnician" : "";
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
									<!-- <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f12'];?>"><?php echo $_POST['f12'];?></option>
                <option></option>
              </select>
            </div> -->
									<!-- /select switch type options -->

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
											<div class="tags p-b-2">
												<div class="form-group cb-control">
													<label>Hide Readonly Fields&nbsp;</label><input
														type="checkbox" value="1" id="show_hide_readonly" />
												</div>

            <?php
            $output = '';
            $tablename_arr = array('globalvars' => 'globalvars', 'marketvars' => 'marketvars', 'usrvars' => 'usrvars');
            $table_selbox = "<option val=''>--Select--</option>";
            foreach ($tablename_arr as $key=>$val){
                $table_selbox .= "<option value='".$key."'>".$val."</option>";
            }
            $table_selbox .= "</select>";
            
            $vars['globalvars'] = configtemplate_elemvalue('globalvars', 'gvarname');
            $vars['usrvars'] = configtemplate_elemvalue('usrvars', 'usrvarname');
            $vars['marketvars'] = configtemplate_elemvalue('marketvars', 'mvarname');
            $select_field_arr = array('globalvars'=>'gvarname', 'usrvars'=>'usrvarname', 'marketvars'=>'mvarname');
            
            for ($k = 1; $k <= count($newarr); $k ++) {
                 if (count($newarr[$k]) == 1) {
                    $output .= '<div class="form-group">';
                    if ($newarr[$k][0]["editable"] == 0) {
                        $output .= "<input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $newarr[$k][0]["elemvalue"] . "'><span class='form-non-editable-fields'><label class='readonly'>" . $newarr[$k][0]["elemvalue"] . "</label></span><input type='hidden' name='looptabler[looper_" . $k . "][]' value='' >";
                    } else {
                        $output .= "<span class='form-editable-fields'>";
                        $outputin .= "<select id='conf_selbox_".$k."0' class='elementvalref' name='looptabler[looper_" . $k . "][]'><option val=''>--Select--</option>";
                        foreach ($tablename_arr as $key=>$val){
                            $sel = $seltab = '';
                            if($newarr[$k][0]["tabname"] == $key){
                                $sel = 'selected';
                                $seltab = $key;
                                $field = $select_field_arr[$key];
                            }
                            $outputin .= "<option value='".$key."' ".$sel.">".$val."</option>";
                        }
                        $outputin .= "</select>";
                        $outputin .= "<span id='wrap_conf_selbox_".$k."0'><select id='val_conf_selbox_".$k."0' name='loop[looper_" . $k . "][]'>";
                        $replace_selbox = '<option val="">--Select--</option>';
                        foreach ($vars[$seltab] as $key=>$val){
                            $sel = ($val[$field] == $newarr[$k][0]["elemvalue"]) ? 'selected':'';
                            $replace_selbox .= "<option value='".$val[$field]."' ".$sel.">".$val[$field].'</option>';
                        }
                        $outputin .= $replace_selbox.'</span>';
                       $output .= "</span>";
                    }
                    $output .= '</div>';
                } else {
                    $output .= '<div class="form-group">';
                    $editable = 0;
                    $outputin = '';
                    for ($l = 0; $l < count($newarr[$k]); $l ++) {
                        if ($newarr[$k][$l]["editable"] == 0) {
                            $outputin .= "<label class='readonly'>" . $newarr[$k][$l]["elemvalue"] . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $newarr[$k][$l]["elemvalue"] . "'><input type='hidden' name='looptabler[looper_" . $k . "][]' value='' >";
                        } else {
                            $editable = 1;
                            if(!empty($newarr[$k][$l]["tabname"]) && !empty($newarr[$k][$l]["elemvalue"])){
                                $outputin .= "<select id='conf_selbox_".$k.$l."' class='elementvalref' name='looptabler[looper_" . $k . "][]'><option val=''>--Select--</option>";
                                $seltab = '';
                                foreach ($tablename_arr as $key=>$val){
                                    $sel = '';
                                    if($newarr[$k][$l]["tabname"] == $key){
                                        $sel = 'selected';
                                        $seltab = $key;
                                        $field = $select_field_arr[$key];
                                    }
                                    $outputin .= "<option value='".$key."' ".$sel.">".$val."</option>";
                                }
                                $outputin .= "</select>";
                                $outputin .= "<span id='wrap_conf_selbox_".$k.$l."'><select id='val_conf_selbox_".$k.$l."' name='loop[looper_" . $k . "][]'>";
                                $replace_selbox = '<option val="">--Select--</option>';
                                foreach ($vars[$seltab] as $key=>$val){
                                    $sel = ($val[$field] == $newarr[$k][$l]["elemvalue"]) ? 'selected':'';
                                    $replace_selbox .= "<option value='".$val[$field]."' ".$sel.">".$val[$field].'</option>';
                                }
                                $outputin .= $replace_selbox.'</span>';
                                
                            }
                        }
                    }
                    if ($editable == 1) {
                        $output .= "<span class='form-editable-fields'>" . $outputin . "</span><input type='hidden' name='edit[looper_" . $k . "][]' value='1'>";
                    } else {
                        $output .= "<span class='form-non-editable-fields'>" . $outputin . "</span>";
                    }
                    $output .= '</div>';
                }
            }
            echo $output .= '</div>';
            ?>
			</div>
											<div>
												<br>
												<hr>
												<a href="#top" class="border"><b>^ Back to top</b></a>
												<hr>
											</div>
											<div class="form-group">
												<button type="submit" value="Download Script" name="action"
													class="btn btn-primary btn-lg">DOWNLOAD</button>
												<button type="submit" value="Execute Script" name="action"
													class="m-2 btn btn-primary btn-lg">Execute</button>
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
