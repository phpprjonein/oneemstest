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

check_user_authentication(array(
        8
)); // cellsite tech type user
    
$page_title = 'OneEMS';

// page logging
$usertype = (isset($_SESSION['userlevel']) == 1) ? "Cell sitetechnician" : "";
$username = $_SESSION['username'];
$mesg = " User name: $username User type : $usertype Page:  Load Template file upload page Description: Cell Site Tech has chosen their configuration and is ready to select a file to upload.";
write_log($mesg);

?>
<!DOCTYPE html>
<html>
<head>
   <?php include_once("includes.php");  ?>
   <script
	src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
		<script>
    $(function() {
        $(".chosen-select").chosen({
          disable_search_threshold: 10,
          inherit_select_classes: true,
          no_results_text: "No results found! Please try searching again...",
          width: "100%"
        });
    });
</script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include_once ('menu.php'); ?>
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<h5> View / Modify Template </h5>
					<div class="panel panel-default">
						<div class="panel-heading">Configuration Management</div>
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
									<div class="form-group f8 required" data-fid="f8">
										<label class="control-label" for="f8">Select File Name</label>
										<select data-placeholder="Select Template Names..."
											class="form-control custom-select chosen-select"
											id="templname" name="templname"
											data-rule-required="true">
											<?php $templates = config_get_templates_templname();?>
											<?php //print '<pre>'; print_r($templates);die;?>
											
											<?php foreach ($templates as $key=>$val):?>
											<option <?php echo ($_POST['templname'] == $val['templname']) ? ' selected':''; ?>><?php echo $val['templname'];?></option>
											<?php endforeach;?>
										</select>
									</div>															
												<input type="submit" name="action" id="config-submit"
													class="btn" value="Select">
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
							</div>
						</div>
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
