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
$mesg = " User name: $username User type : $usertype Page:  Load Template file upload page Description: Cell Site Tech has chosen their configuration and is ready to select a file to upload.";
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
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<h5>Load Template</h5>
					<div class="panel panel-default">
						<div class="panel-heading">Configuration Management</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<?php if($_SESSION['msg'] == 'ss'){ ?>
                                  		<div id="main-status"
										class="alert alert-success">Script File Generated Successfully
										in Upload Path</div>
                                  	<?php }elseif($_SESSION['msg'] == 'dbs'){ ?>
                                  		<div id="main-status"
										class="alert alert-success">Configuration Template Stored Into
										Database Successfully</div>
                                  	<?php }elseif($_SESSION['msg'] == 'fus'){ ?>
                                  		<div id="main-status"
										class="alert alert-success">Configuration Template Uploaded
										Successfully</div>
                                  	<?php }elseif($_SESSION['msg'] == 'fae'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> <?php echo $_SESSION['msg-param']['filename']." already exists. "; ?></div>
                                  	<?php }elseif($_SESSION['msg'] == 'fe'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> <?php echo $_SESSION['msg-param']['fileerror'];?></div>
                                  	<?php }elseif($_SESSION['msg'] == 'fte'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> File MUST be a <b>.txt</b> file!
									</div>
                                  	<?php }elseif($_SESSION['msg'] == 'feps'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> File cannot be larger than 2MB!
									</div>
                                  	<?php }unset($_SESSION['msg']);?>
                            		<?php
                            if (empty($_SESSION['filename'])) {
                                $_SESSION['filename'] = isset($_POST['filename']) ? $_POST['filename'] : '';
                                $_SESSION['filename'] = isset($_POST['filename']) ? $_POST['filename'] : '';
                                $_SESSION['alias'] = isset($_POST['alias']) ? $_POST['alias'] : '';
                                $_SESSION['refmop'] = isset($_POST['refmop']) ? $_POST['refmop'] : '';
                            }
                            if (empty($_SESSION['filename'])) {
                                //$filename = "/usr/apps/oneems/fs1/sampleconfigfile_" . $_SESSION['userid'] . ".txt";
                                $filename = "/usr/apps/oneems/fs1/upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt";
								//$filename = "upload/sampleconfigfile_" . $_SESSION['userid'] . ".txt";
                                $templname = 'templ_' . generateRandomString();
                            } else {
                                //$filename = "/usr/apps/oneems/fs1/" . $_SESSION['filename'] . ".txt";
                                $filename = "/usr/apps/oneems/fs1/upload/" . $_SESSION['filename'] . ".txt";
								//$filename = "upload/" . $_SESSION['filename'] . ".txt";
                                $templname = $_SESSION['filename'];
                                $alias = $_SESSION['alias'];
                                $refmop = $_SESSION['refmop'];
                            }
                            ?>
                                  	<div id="upload_status"
										style="display: none;" class="alert"></div>
										<?php if(!empty($_SESSION['filename'])): ?>
                                      <div class="col"
										id="template_info">
										<label for="inputRegion">TEMPLATE:</label> <small><b><span
												id="filename"><?php echo $_SESSION['filename']; ?></span></b></small>
									</div>
                                    <?php endif; ?>
									<div class="row">
										<div class="col-lg-4 tags p-b-2">
											<form action="cellsite-config-process.php" method="post"
												id="config_file_uploader" enctype="multipart/form-data">
												<input type="hidden" name="filename"
													value="<?php echo $filename;?>" id="upload_filename">
												<div class="form-group">
													<label for="file">Select a file to upload</label> <input
														type="file" id="file" name="file">
													<p class="help-block">
														Please upload <b>.txt</b> files with a maximum size of 2
														MB.
													</p>
												</div>
												<input type="submit" name="action" id="config-submit"
													class="btn" value="UPLOAD">
											</form>
										</div>
										<div class="col-lg-8 tags p-b-2">
											<?php
        /*
         * if(!file_exists($filename)){
         * $filename = getcwd()."/upload/Default_Gold_ASR920_Great-Lakes_Allnew.txt";
         * }
         */
        /*
         * $switches_conft = configtemplate_switches_from_switchvars();
         * $switches_conft_table_selbox = '<select name="switch_name" id="configt_load_switch_name"><option value="">--Select--</option>';
         * foreach ($switches_conft as $key=>$val){
         * $switches_conft_table_selbox .= '<option value="'.$val['switch_name'].'">'.$val['switch_name'].'</option>';
         * }
         * $switches_conft_table_selbox .= '</select>';
         */
        $output = '<form name="file_process" action="cellsite-config-process.php" method="post" class="border">';
        $output .= '<div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input type="checkbox" value="1" id="show_hide_readonly"/></div>';
        // $output .= '<div class="form-group cb-control"><label>Select Switch&nbsp;</label>'.$switches_conft_table_selbox.'</div>';
        $output .= '<input type="hidden" name="templname" value="' . $templname . '" />';
        $output .= '<input type="hidden" name="alias" value="' . $alias . '" />';
        $output .= '<input type="hidden" name="refmop" value="' . $refmop . '" />';
        
        ?>
							<div id="file_process">
							<?php
    if (file_exists($filename)) {
        
        $tablename_arr = array(
            'globalvars' => 'globalvars',
            'marketvars' => 'marketvars',
            'usrvars' => 'usrvars',
            'switchvars' => 'switchvars'
        );
        $table_selbox = '<option val="">--Select--</option>';
        foreach ($tablename_arr as $key => $val) {
            $table_selbox .= '<option value="' . $key . '">' . $val . '</option>';
        }
        $table_selbox .= "</select>";
        
        $replace_selbox = '<option val="">--Select--</option>';
        /*
         * $vars = configtemplate_elemvalue('globalvars', 'gvarname');
         * foreach ($vars as $key=>$val){
         * $replace_selbox .= '<option value='.$val['gvarname'].'>'.$val['gvarname'].'</option>';
         * }
         */
        $replace_selbox .= '</select>';
        
        $fd = fopen($filename, "r");
        $line = 0;
        while (! feof($fd)) {
            ++ $line;
            $contents = fgets($fd, filesize($filename));
            $delimiter = "#";
            $splitcontents = explode($delimiter, $contents);
            $splitcontcount = count($splitcontents);
            if ($splitcontcount > 1) {
                $output .= '<div class="form-group">';
                $output_inner = '';
                $l = 1;
                foreach ($splitcontents as $color) {
                    if (! empty($color)) {
                        if (substr_count(strtolower('#' . $color), "#x") > 0 || substr_count(strtolower('#' . $color), "#y") > 0 || substr_count(strtolower('#' . $color), "#x.x.x.x") > 0 || substr_count(strtolower('#' . $color), "#y.y.y.y") > 0 || substr_count(strtolower('#' . $color), "#z.z.z.z") > 0 || substr_count(strtolower('#' . $color), "#a.a.a.a") > 0 || substr_count(strtolower('#' . $color), "#b.b.b.b") > 0) {
                            /*
                             * $output_inner .= "<input type='text' size='" . strlen($color) . "' name='loop[looper_" . $line . "][]' value='" . $color . "' class='form-control cellsitech-configtxtinp border border-dark'>
                             * <input type='hidden' name='hidden[looper_" . $line . "][]' value='1' >";
                             */
                            $output_inner .= "<select id='conf_selbox_" . $line . $l . "' class='elementvalref' name='looptabler[looper_" . $line . "][]'>" . $table_selbox . "
                            <span id='wrap_conf_selbox_" . $line . $l . "'><select id='val_conf_selbox_" . $line . $l . "' name='loop[looper_" . $line . "][]'>" . $replace_selbox . "<input type='hidden' name='hidden[looper_" . $line . "][]' value='1' >";
                        } else {
                            if (strlen($color) != 0) {
                                $orgcolor = $color;
                                $color = ($color == " ") ? '&nbsp;' : $color;
                                $output_inner .= "<label class='readonly'>" . $color . "</label><input type='text' style='display:none !important;' size='" . strlen($orgcolor) . "' name='loop[looper_" . $line . "][]' value='" . $orgcolor . "'  class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_" . $line . "][]' value='0' ><input type='hidden' name='looptabler[looper_" . $line . "][]' value='' >";
                            }
                        }
                    }
                    $l ++;
                }
                ;
                
                $output .= '<span class="form-editable-fields">' . $output_inner . '</span>';
                
                $output .= '</div>';
            } elseif ($splitcontcount == 1) {
                foreach ($splitcontents as $color) {
                    if (! empty($color)) {
                        $orgcolor = $color;
                        $color = ($color == " ") ? '&nbsp;' : $color;
                        $output .= "<div class='form-group'><span class='form-non-editable-fields'><label  class='readonly'>" . $color . "</label><input style='display:none !important;' type='text' size='" . strlen($orgcolor) . "' name='loop[looper_" . $line . "][]' value='" . $orgcolor . "' class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_" . $line . "][]' value='0' ><input type='hidden' name='looptabler[looper_" . $line . "][]' value='' ></span></div>";
                    }
                }
                ;
            }
            ;
        }
        ;
        fclose($fd);
        echo $output;
        ?>
								</div>
											<div>
												<br>
												<hr>
												<a href="#top" class="border"><b>^ Back to top</b></a>
												<hr>
											</div>
								<?php
        // $output = '<div class="form-group"><input class="btn" name="action" type = "submit" value = "SaveDB">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Saveasscriptfile">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Downloadsscriptfile"></div>';
        // $output = '<div class="form-group"> <input class="btn" name="action" type = "submit" value = "Save Configuration">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Download Script"></div>';
        $output = '<div class="form-group"> <input class="btn btn-lg" name="action" type = "submit" value = "SAVE CONFIGURATION"></div>';
        $output .= '</form>';
        echo $output;
        ?>
								<?php } ?>
								</div>
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
