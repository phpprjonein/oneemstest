<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';
include "libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php";
include "libraries/spreadsheet-reader-master/SpreadsheetReader.php";
ini_set('max_execution_time', 500);
ini_set('display_errors',1);

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}
if(isset($_POST['tablename']))
{
	exportUsrvars($_SESSION['username']);
}
user_session_check();
check_user_authentication(array(
    8
)); // cellsite tech type user

$page_title = 'OneEMS';
if ( isset($_POST["submit"]) ) {
	if(!file_exists($_FILES["file"]["tmp_name"])){
		echo '
			<div id="main-status" class="alert alert-success">No file to upload</div>';																
	}
	else{ 
		$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
		  
		if(in_array($_FILES["file"]["type"],$allowedFileType))
		{
			$targetPath = 'upload/'.$_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
			$Reader = new SpreadsheetReader($targetPath);			
			$sheetCount = count($Reader->sheets());
			
			for($i=0;$i<$sheetCount;$i++)
			{
				$Reader->ChangeSheet($i);
				$skipRows = 1;
				$currentRow = 0;
				
				foreach ($Reader as $Row)
				{
					if ($currentRow < $skipRows)
					{	$currentRow++;
						continue;
					}
					else{
						$values_arr = array(
							'usrvarname' => $Row[1],
							'value' => $Row[2],
							'deviceseries' => $Row[3],
							'template' => $Row[4],
							'username' => $_SESSION['username'],
						);
						insert_user_variable($values_arr);
						$currentRow++;
					}
				}			
			}
			echo '<div id="main-status" class="alert alert-success">Variables inserted successfully</div>';
		}
		else
		{ 
			$type = "error";
			$message = "Invalid File Type. Upload Excel File.";
			echo $message;exit;
		}
	}	 
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes.php");  ?>
	<script src="resources/js/manageusrvars.js?t="
	<?php echo date('his'); ?>></script>
</head>
<body class="hold-transition skin-blue sidebar-mini ownfont">
	<!-- Modal HTML -->
	<div class="container-fluid">
        <?php include ('menu.php'); ?>
		
        <div class="content container-fluid" id="login-impersonate">
			<!-- Main content -->
			<section class="content" id="sw-delivery-devices">
				<div class="col-md-12">
					<?php if($_SESSION['msg'] == 'ds'){?>
					<div id="status" class="alert alert-success"> User Variable Deleted Successfully</div>
					<?php unset($_SESSION['msg']);}?>
						<!-- Button trigger modal -->
						<!--button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUsrvarForm">
							Add User Variable
						</button-->
						<div class="form-group" style="float:right">
							<form action="" method="post" id="config_file_updater" enctype="multipart/form-data">
								<input type="hidden" name="tablename" value="usrvars">
								<input type="submit" name="action" id="config-submit" class="btn" value="Get Template">
							</form>
						</div>
						<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
						<h5> Upload User Variables</h5>
							<div class="form-group">
								<label for="file">Select a file to upload</label> <input
									type="file" id="file" name="file">
								
							</div>
							<input type="submit" name="submit" value="Upload" />
						</form>

        <!-- Modal -->
                <!-- The Modal -->
        		<!--div class="modal fade" id="addUsrvarForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<!--div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Add User Variable</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div>
        					<!-- Modal body -->
        					<!--div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="usrvarId" value="">
        					
        					
                          <div class="row">
    						  <div class="form-group col-md-12">
                              <div class="form-group">
                                <label for="Template">Template Name</label>
                                  <input type="file" class="form-control"
                                  id="Template" placeholder="Template"/>
                              </div>
                              </div>
                          </div>
                          
                            <?php
                            //$role_names = generic_get_userlevels();
                            ?>
                        </form>
        					
        					</div>
        
        					<!-- Modal footer -->
        					<!--div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="addusrvar">Upload User Variable</button>
        							
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div-->
        				<!--/div>
        			</div>
        		</div-->


				<!--div class="modal fade" id="deleteUsrvarForm">
        			<div class="modal-dialog modal-lg">
        				<div class="modal-content" id="manual-device-discovery">
        					<!-- Modal Header -->
        					<!--div class="modal-header" id="restoremodalhdr">
        						<h5 class="modal-title text-center" id="modalLabelLarge">Delete User Variable</h5>
        						<button type="button" class="close" data-dismiss="modal"
        							aria-label="Close">
        							<span aria-hidden="true">&times;</span>
        						</button>
        					</div-->
        					<!-- Modal body -->
        					<!--div class="modal-body">
        					<div id="status" style="display: none;" class="alert-popup"></div><br/>
        					<form role="form">
        					<input type="hidden" id="usrvarId" value="">
                          <div class="form-group">
                            Are you sure want to delete User Variable - <b><span id="usrvarNameDel"></span></b>
                          </div>
                          
                        </form>
        					
        					</div-->
        
        					<!-- Modal footer -->
        					<!--div class="modal-footer">
        						<button type="button" class="btn btn-secondary" id="deleteuser">Delete User Variable</button>
        						<button type="button" class="btn btn-secondary"
        							data-dismiss="modal">Close</button>
        					</div>
        				</div>
        			</div>
        		</div-->
				<div class="form-group f8 required col-md-4" data-fid="f8">
					<label class="control-label" for="f8">Select Template Name</label>
					<select data-placeholder="Select Template Names..."
						class="form-control custom-select chosen-select"
						id="templname" name="templname"
						data-rule-required="true">
						<option>-- Select Template -- </option>
						<?php $templates = config_get_templates_templname();?>
						<?php //print '<pre>'; print_r($templates);die;?>
						
						<?php foreach ($templates as $key=>$val):?>
							<?php if(substr( $val['templname'], 0, 6 ) === "Golden"){?>
								<option <?php echo ($_POST['templname'] == $val['templname']) ? ' selected':''; ?>><?php echo $val['templname'];?></option>
							<?php }?>
						<?php endforeach;?>
					</select>
				</div>
				<div class="row">
					<!-- /router selection content row -->
					<div class="col-sm-12 col-md-12" id="listname-dd">
						<div class="row">
							<div class="col">
								<input type="hidden" value="<?php echo $_SESSION['userid'];?>" name="userid" id="userid" />
								<?php $usrvars = generic_get_usrvars($_SESSION['username']);?>
								<?php //print '<pre>'; print_r($usrvars);?>
								<table id="manageusrvars" class="display"
									style="width: 100%">
									<thead>
										<tr>
											<th width="75px">S.No</th>
											<th>User Variable ID</th>
											<th>User Variable Name</th>
											<th>Value</th>
											<th>Device Series</th>
											<!--th>Action</th-->
										</tr>
									</thead>
									<tbody>
									<?php /* $i=1; foreach ($usrvars['result'] as $key=>$val){?>
										<tr data-user="<?php echo $val['id'];?>" data-zones="<?php echo $val['zones'];?>" data-userlevel="<?php echo $val['userlevel'];?>" data-status="<?php echo $val['status'];?>">
										<td><?php echo $i++;?></td>
										<td><?php echo $val['usrvarid'];?></td>
										<td><?php echo $val['usrvarname'];?></td>
										<td><?php echo $val['usrvarval'];?></td>
										<td><?php echo $val['deviceseries'];?></td>
										<!--td><button type="button" class="btn btn-secondary edituser">Edit</button>&nbsp;<button type="button" class="btn btn-secondary deleteuser">Delete</button></td-->
										</tr>
									<?php } */?>

									</tbody>
								</table>
							</div>
						</div>
						<!-- /template name content -->
					</div>
							<!-- /script output -->

							<!-- /backup management content row -->
				</div>			
			</section>
			</div>
		<!--Template drop down code start by Swapnil-->
		<div class="panel panel-default" id="template-dropdown">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<?php if($_SESSION['msg'] == 'us'){ ?>
							<div id="main-status"
							class="alert alert-success">Configuration Template Updated Successfully</div>
						<?php } unset($_SESSION['msg']); ?>
						<div class="row">
							<div class="col-lg-4 tags p-b-2">
								<form action="cellsitetech-configuration-update.php" method="post"
									id="config_file_updater" enctype="multipart/form-data">
									<!--div class="form-group f8 required" data-fid="f8">
										<label class="control-label" for="f8">Select Template Name</label>
										<select data-placeholder="Select Template Names..."
											class="form-control custom-select chosen-select"
											id="templname" name="templname"
											data-rule-required="true">
											<option>-- Select Template -- </option>
											<?php $templates = config_get_templates_templname();?>
											<?php //print '<pre>'; print_r($templates);die;?>
											
											<?php foreach ($templates as $key=>$val):?>
												<?php if(substr( $val['templname'], 0, 6 ) === "Golden"){?>
													<option <?php echo ($_POST['templname'] == $val['templname']) ? ' selected':''; ?>><?php echo $val['templname'];?></option>
												<?php }?>
											<?php endforeach;?>
										</select>
									</div-->		
									<!-- select Switch options -->
									<?php  $gsswitchddwndata = configtemplate_switches_from_switchvars(); ?>
									<div class="form-group f11 required" data-fid="f11">
										<label class="control-label" for="f11">Select Switch</label> 
										<select	id="select_switch" class="form-control custom-select"
											data-rule-required="true">
											<option value="">- SELECT Switch -</option>
											<?php foreach($gsswitchddwndata as $key => $val) {;?>
											<option value="<?php echo $val['switch_name'];?>"><?php echo $val['switch_name']; ?></option>
										<?php }; ?>
										</select>
									</div>
									<div class="form-group f14 required" data-fid="f14">						
										<label class="control-label" for="exampleInputEmail1">Device Name</label>
										<input type="Device Name" name="f14" class="form-control" id="select_device_name" value="" placeholder="">						
									</div>						
									<!-- select Switch options -->
									<!--input type="submit" name="action" id="config-submit"
										class="btn" value="Select"-->
								</form>
							</div>
							<div class="col-sm-12 col-md-8">
								<?php //print '<pre>'; print_r($_POST); die;?>
								<!-- template output content -->
								<div class="row">
									<div class="col">
				<?php 
					 //$_POST['templname'] = 'Modification_ASR1000_1561S1_ALL_Hub_hubre_debarle';
					 $results = config_get_templates_from_templname($_POST['templname']);
					 //'Modification_ASR1000_1561S1_ALL_Hub_hubre_debarle'
				?>
				<?php foreach ($results as $key=>$val):?>
				<?php $newarr[intval($val['elemid']/10)][] = array('elemid' => $val['elemid'], 'elemvalue' => $val['elemvalue'], 'editable' => $val['editable'], 'tabname' => $val['tabname']); ?>
				<?php endforeach;?>
				<?php
				// print '<pre>';
				// print_r($newarr);die;
				?>
										<div id="file_process">
																	<form name="file_process" action="cellsite-config-process.php"
																		method="post">
																		<div class="tags p-b-2">

										<?php
										$output = '';
										if($_POST['templname']){
											$output .= '<div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input type="checkbox" value="1" id="show_hide_readonly"/></div>';
										}
										$pink_box_min_size = 10;
										$tablename_arr = array(
												'globalvars' => 'globalvars',
												'marketvars' => 'marketvars',
												'usrvars' => 'usrvars',
												'switchvars' => 'switchvars'
										);

										$replace_selbox = '<option val="">--Select--</option>';

													
										for ($k = 1; $k <= count($newarr); $k ++) {
											if (count($newarr[$k]) == 1) {
												$output .= '<div class="form-group">';
												if ($newarr[$k][0]["editable"] == 0) {
													if(strpos($newarr[$k][0]["elemvalue"], 'ASR9010-01') || strpos($newarr[$k][0]["elemvalue"], 'ASR9010-02')){
														$output .= '<div class="jf-form form-group col-xs-10 col-sm-3 col-md-3 col-lg-12 alert alert-secondary panel-heading-lstmgmt"><b>'.$newarr[$k][0]["elemvalue"].'</b></div>';
													}
													
													$output .= "<input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $newarr[$k][0]["elemvalue"] . "'><span class='form-non-editable-fields'><label class='readonly'>" . $newarr[$k][0]["elemvalue"] . "</label></span>";
												} else {
													$pink_box_size = strlen($result[$newarr[$k][0]["tabname"]][$newarr[$k][0]["elemvalue"]]);
													$pink_box_size = ($pink_box_size == 0 || $pink_box_size < $pink_box_min_size) ? $pink_box_min_size : $pink_box_size;
													$output .= "<span class='form-editable-fields'><input type='text' size='" . $pink_box_size . "'  name='loop[looper_" . $k . "][]' class='form-control cellsitech-configtxtinp border border-dark' value='" . $result[$newarr[$k][0]["tabname"]][$newarr[$k][0]["elemvalue"]] . "'></span>";
												}
												$output .= '</div>';
											} else {
												$output .= '<div class="form-group">';
												$editable = 0;
												$outputin = '';
												for ($l = 0; $l < count($newarr[$k]); $l ++) {
													if ($newarr[$k][$l]["editable"] == 0) {
														$rowval = generatescript_str_preprocess($newarr[$k][$l]["elemvalue"], $bmbps);
														$rowval_arr = explode('||', $rowval);
														if(count($rowval_arr) > 1){
															$outputin .= "<label class='readonly'>" . $rowval_arr[0] . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $rowval_arr[1] . "'>";
														}else{
															$outputin .= "<label class='readonly'>" . $rowval . "</label><input type='text' style='display:none !important;' name='loop[looper_" . $k . "][]' value='" . $rowval . "'>";
														}
													} else {
														$editable = 1;
														//echo $newarr[$k][$l]["elemvalue"]; 
														//echo $newarr[$k][$l]["tabname"];
														//die;
														
														$table_selbox = '<option val="">--Select--</option>';
														foreach ($tablename_arr as $key => $val) {
															$selected = $newarr[$k][$l]["tabname"] == $val ? 'selected':'';
															$table_selbox .= '<option value="' . $key . '" '.$selected.'>' . $val . '</option>';
														}
														$table_selbox .= "</select>";
														if($newarr[$k][$l]["tabname"] == 'usrvars'){
															$vars_usrvars = configtemplate_elemvalue_pos_script('usrvars', 'usrvarname', 'usrvarval');
															foreach ($vars_usrvars as $key11=>$val11){
																$selected = $newarr[$k][$l]["elemvalue"] == $val11['usrvarname'] ? 'selected':'';
																$replace_selbox .= '<option val="'.$val11['usrvarname'].'" '.$selected.'>'.$val11['usrvarname'].'</option>';
															}
															$replace_selbox .= '</select>';
														}
														if($newarr[$k][$l]["tabname"] == 'switchvars'){
															$vars_switchvars = configtemplate_elemvalue_pos_script('switchvars', 'swvarname', 'swvarval');
															foreach ($vars_switchvars as $key11=>$val11){
																$selected = $newarr[$k][$l]["elemvalue"] == $val11['swvarname'] ? 'selected':'';
																$replace_selbox .= '<option val="'.$val11['swvarname'].'" '.$selected.'>'.$val11['swvarname'].'</option>';
															}
															$replace_selbox .= '</select>';
														}
														if($newarr[$k][$l]["tabname"] == 'marketvars'){
															$vars_marketvars = configtemplate_elemvalue_pos_script('marketvars', 'mvarname', 'mvarval');
															foreach ($vars_marketvars as $key11=>$val11){
																$selected = $newarr[$k][$l]["elemvalue"] == $val11['mvarname'] ? 'selected':'';
																$replace_selbox .= '<option val="'.$val11['mvarname'].'" '.$selected.'>'.$val11['mvarname'].'</option>';
															}
															$replace_selbox .= '</select>';
														}
														if($newarr[$k][$l]["tabname"] == 'globalvars'){
															$vars_globalvars = configtemplate_elemvalue_pos_script('globalvars', 'gvarname', 'gvarval');
															foreach ($vars_globalvars as $key11=>$val11){
																$selected = $newarr[$k][$l]["elemvalue"] == $val11['gvarname'] ? 'selected':'';
																$replace_selbox .= '<option val="'.$val11['gvarname'].'" '.$selected.'>'.$val11['gvarname'].'</option>';
															}
															$replace_selbox .= '</select>';
														}
														$outputin .= "<select id='conf_selbox_" . $k . $l . "' class='elementvalref' name='looptabler[looper_" . $newarr[$k][$l]['elemid'] . "]'>" . $table_selbox . "
														<span id='wrap_conf_selbox_" . $k . $l . "'><select id='val_conf_selbox_" . $k . $l . "' name='looptablerval[looper_" . $newarr[$k][$l]['elemid'] . "]'>" . $replace_selbox . "<input type='hidden' name='hidden[looper_" . $k . "][]' value='1' >";
														//$pink_box_size = strlen($result[$newarr[$k][$l]["tabname"]][$newarr[$k][$l]["elemvalue"]]);
														//$pink_box_size = ($pink_box_size == 0 || $pink_box_size < $pink_box_min_size) ? $pink_box_min_size : $pink_box_size;
														$replace_selbox = '';
														//$outputin .= "<input type='text' size='" . $pink_box_size . "' name='loop[looper_" . $k . "][]' class='form-control cellsitech-configtxtinp border border-dark' value='" . $result[$newarr[$k][$l]["tabname"]][$newarr[$k][$l]["elemvalue"]] . "'>";
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
											</div>
											<?php if(isset($_POST['templname']) && !empty($_POST['templname'])):?>
											<div class="form-group">
												<input type="hidden" name="templname" value="<?php echo $_POST['templname'];?>">
												<button type="submit" value="Update Config Script" name="action"
													class="btn btn-primary btn-lg">Update</button>
											</div>
											<?php endif;?>
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
				
				<!-- Content Wrapper. Contains page content -->
				<div class="content">
					<!-- Main content -->
					<section class="content">
						<div class="col-md-12">
							<div id="status" style="display: none;" class="alert"></div>
							<!-- backup management content row -->
							<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2"
								action='generate-post-script-usrvars.php' method='POST'
								enctype='multipart/form-data' novalidate autocomplete="on">
								<input type="hidden" name="templnamefwd" id="templnamefwd">
								<input type="hidden" name="f7" id="f7">
								<input type="hidden" name="f8" id="f8">
								<input type="hidden" name="f11" id="f11">
								<input type="hidden" name="f14" id="f14">
								<div class="row">
									<input type="hidden" name="tmplcategory" value="Golden">
									<!-- router selection content row -->
									<div class="col-sm-12 col-md-4 leftselector">
										<div class="jf-form">

											<!-- router scripting selection form div -->
											<!--<h5>SELECT TEMPLATE TYPE TO CREATE:</h5> -->
											<input type="hidden" name="method" value="validateForm"> <input
												type="hidden" id="serverValidationFields"
												name="serverValidationFields" value="">

											<!-- select purpose options -->
											<?php
											$configtmpddwndata = getconfigtempldpdwntbl('configscriptpurpose');
											?>					
											<div class="clearfix"></div>
											<p>&nbsp;</p>
											<!-- /router scripting selection form div -->
										</div>
									</div>
									<!-- /router selection content row -->


									<!-- right side -->
									<!-- script output -->
									<div class="col-sm-12 col-md-8 d-none" id="template_info">
										<!-- template output content -->
										<div class="form-group col-md-8">
											<input type="inputAlias" name="alias" class="form-control"
												id="aliasName" placeholder="Alias Name">
										</div>
										<div class="row">
											<div class="col">
												<table class="table table-striped table-responsive">
													<thead>
														<tr>
															<th scope="col">Template Name</th>
															<th scope="col">Select Template</th>
														</tr>
													</thead>
													<tbody id="loadtemplates">

													</tbody>
												</table>

											</div>
										</div>

										<!-- /right side -->
										<!-- /script output -->
									</div>

									<!-- /backup management content row -->
								</div>
								<div class="row">
								
									<?php
							$vars['usrvars'] = golden_modification_configtemplate_elemvalue_pos_script('import_usrvars', 'usrvarname', 'usrvarval');


							$predevice_series = '';
							foreach ($vars['usrvars'] as $key => $val) {
								?>
									<?php


										   if($predevice_series != $val['deviceseries']){
											   $predevice_series = $val['deviceseries'];
											   ?>
												<div
										class="jf-form form-group col-xs-10 col-sm-3 col-md-3 col-lg-12 gsalert alert-secondary panel-heading-lstmgmt <?php if($val['deviceseries'] == 'Bandwidth'): ?> bandwidth <?php else: ?> non-bandwidth <?php endif;?>"  <?php if($val['deviceseries'] == 'Bandwidth'): ?>  style="display: none;" <?php endif;?>><b><?php echo $val['deviceseries']; ?></b></div>

									<?php }else{
											 $predevice_series = $val['deviceseries'];
										  }
									?>
									<!-- <p>if device series = bandwidth</p> -->
									<div
										class="jf-form <?php if($val['deviceseries'] == 'Bandwidth'): ?> bandwidth <?php else: ?> non-bandwidth <?php endif;?> form-group col-xs-10 col-sm-3 col-md-3 col-lg-3" <?php if($val['deviceseries'] == 'Bandwidth'): ?>  style="display: none;" <?php endif;?>>
										<?php   
											if ((($val['usrvarname'] == 'BW -- Bandwidth Type(6/8)') && ($val['deviceseries'] == 'Bandwidth')) || ($val['usrvarname'] == 'Bandwidth Type')  || ($val['usrvarname'] == 'MTU') ){ 
												echo generate_option_button_for_configs_static_type($val['usrvarname']);
											}elseif ($val['usrvarname'] == 'MTU'){ 
												echo generate_option_button_for_configs_bandwidth_type($val['usrvarname']);
											}elseif ((('Telco Interface-ASR9010-Even' == $val['usrvarname'])) || (('Telco Interface-ASR9010-Odd' == $val['usrvarname']))){   
												echo generate_option_button_for_configs_sw_inventory('software_inventory', 'interface', $val['usrvarname'], $val['deviceseries']);
											//}elseif (('Time Zone' == $val['usrvarname']) || ('BGP Password-ASR9010-Even' == $val['usrvarname']) || ('BGP Password-ASR9010-Odd' == $val['usrvarname'])){   
											}elseif (('BGP Password-ASR9010-Even' == $val['usrvarname']) || ('BGP Password-ASR9010-Odd' == $val['usrvarname'])){   
												echo generate_option_button_for_configs_marketvars('marketvars', 'mvarval', $val['usrvarname']);
											}/*elseif (('Time Zone' == $val['usrvarname'])){   
												echo generate_option_button_for_configs_marketvars_timezone('marketvars', 'mvarval', $val['usrvarname']);
											}*/elseif ((('BW -- Bandwidth(Mbps)' == $val['usrvarname']))){   
												echo generate_option_button_for_configs('bandwidth', 'bwid', $val['usrvarname']);
											}elseif (('Vlan(Even)' == $val['usrvarname']) || ('Vlan(Odd)' == $val['usrvarname'])){   
												echo generate_option_button_for_configs_sw_inventory_vlan('software_inventory', 'vlan', $val['usrvarname']);
											}elseif ('Bandwidth (Mbps)' == $val['usrvarname']){
												echo generate_option_button_for_configs('bandwidth', 'bwid', $val['usrvarname']);
											}
											elseif ('Enable Secret' == $val['usrvarname']){
												echo generate_option_button_for_configs_enable_usrvar('import_usrvars', 'usrvarval', $val['usrvarname']);
											}
											else{   
												//echo generate_option_button_for_configs_defaultbox_type($val['usrvarname'], $val['deviceseries']);
												echo generate_option_button_for_configs_defaultbox_type_usrvars($val['usrvarname'], $val['deviceseries'], $val['usrvarval']);
											} 
										?>	
									</div>
									<?php
								// $result['usrvars'][$val['usrvarname']] = $val['usrvarval'];
							}
							?>
								</div>
								<!-- /template name content -->
								<div class="row" id="template_info_act">
									<div class="col">
										<button type="submit" class="btn btn-lg generate-script-submit">Select</button>
									</div>
								</div>
							</form>

					</section>
					<!-- /.content -->

				</div>
			</div>
			<!-- container-fluid -->
			</div>
			<!--Template drop down code end by Swapnil-->
		</div>
	</div>
	<?php include ('footer.php'); ?>
    </body>
</html>
