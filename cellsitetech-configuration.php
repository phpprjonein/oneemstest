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

if ($_SESSION['userlevel'] == 1 )
include_once ('config/session_check_cellsite_tech.php');
else  if ($_SESSION['userlevel'] == 2 )
include_once ('config/session_check_switch_tech.php');


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
										class="alert alert-success">Configuration Template Stored Into Database Successfully</div>
                                  	<?php }elseif($_SESSION['msg'] == 'fus'){ ?>
                                  		<div id="main-status"
										class="alert alert-success">Configuration Template Uploaded Successfully</div>
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
                                  	if(empty($_SESSION['filename'])){
                                  	     $_SESSION['filename'] = isset($_POST['filename']) ? $_POST['filename']:'';
                                  	}
                                  	if(empty($_SESSION['filename'])){
                                  	    $filename = getcwd()."/upload/sampleconfigfile_".$_SESSION['userid'].".txt";
                                  	    $templname = 'templ_'.generateRandomString();
                                  	}else{
                                  	    $filename = getcwd()."/upload/".$_SESSION['filename'].".txt";
                                  	    $templname = $_SESSION['filename'];
                                  	}
                                  	?>
                                  	<div id="upload_status"
										style="display: none;" class="alert"></div>
										<?php if(!empty($_SESSION['filename'])): ?>
                                      <div class="col" id="template_info">
                                        <label for="inputRegion">TEMPLATE:</label>
                                        <small><b><span id="filename"><?php echo $_SESSION['filename']; ?></span></b></small>
                                      </div>
                                    <?php endif; ?>
									<div class="row">
										<div class="col-lg-4 tags p-b-2">
    										<form action="cellsite-config-process.php" method="post" id="config_file_uploader" enctype="multipart/form-data">
        							        	<input type="hidden" name="filename" value="<?php echo $filename;?>" id="upload_filename">
        							        	<div class="form-group">
                            				    <label for="file">Select a file to upload</label>
                            				    <input type="file"  id="file" name="file">
                            				    <p class="help-block">Please upload <b>.txt</b> files with a maximum size of 2 MB.</p>
                            				  	</div>
                            				  	<input type="submit" name="action" id="config-submit" class="btn" value="Upload">
                        					</form>
										</div>
										<div class="col-lg-8 tags p-b-2">
											<?php
							/*if(!file_exists($filename)){
							    $filename = getcwd()."/upload/Default_Gold_ASR920_Great-Lakes_Allnew.txt";
							}*/
							$output = '<form name="file_process" action="cellsite-config-process.php" method="post" class="border">';
							$output .= '<div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input type="checkbox" value="1" id="show_hide_readonly"/></div>';
							$output .= '<input type="hidden" name="templname" value="'.$templname.'" />';
							?>
							<div id="file_process">
							<?php
							if(file_exists($filename)){
									$fd = fopen ($filename, "r");
									$line = 0;
									while(!feof($fd))
									{
									    ++$line;
    									$contents = fgets($fd,filesize ($filename));									
    									$delimiter = "#";
    									$splitcontents = explode($delimiter, $contents);
    									$splitcontcount = count($splitcontents);
    									if ($splitcontcount > 1) {
    									    $output .= '<div class="form-group">';
    									    $output_inner = '';
    										foreach ( $splitcontents as $color )
    										{
    										    if(!empty($color)){
    										        if (substr_count(strtolower('#'.$color),"#x") > 0 || substr_count(strtolower('#'.$color),"#y") > 0 || substr_count(strtolower('#'.$color),"#x.x.x.x") > 0 || substr_count(strtolower('#'.$color),"#y.y.y.y") > 0 || substr_count(strtolower('#'.$color), "#z.z.z.z") > 0  || substr_count(strtolower('#'.$color),"#a.a.a.a") > 0 || substr_count(strtolower('#'.$color), "#b.b.b.b") > 0 ){
        											    $output_inner .= "<input type='text' size='".strlen($color)."' name='loop[looper_".$line."][]' value='".$color."' class='form-control cellsitech-configtxtinp border border-dark'><input type='hidden' name='hidden[looper_".$line."][]' value='1' >";
        											}else{
        											     if(strlen($color)!=0){
        											         $orgcolor = $color;
        											         $color = ($color == " ") ? '&nbsp;' : $color;
        											         $output_inner .= "<label class='readonly'>".$color."</label><input type='text' style='display:none !important;' size='".strlen($orgcolor)."' name='loop[looper_".$line."][]' value='".$orgcolor."'  class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_".$line."][]' value='0' >";
        											     }
        										    }
    										    }
    										};
    										
    										
    										$output .= '<span class="form-editable-fields">'.$output_inner.'</span>';
    										
    										$output .= '</div>';										
    									} elseif($splitcontcount == 1) {
    										foreach ( $splitcontents as $color )
    										{   
    										    if(!empty($color)){
    										        $orgcolor = $color;
    										        $color = ($color == " ") ? '&nbsp;' : $color;
    										        $output .= "<div class='form-group'><span class='form-non-editable-fields'><label  class='readonly'>".$color."</label><input style='display:none !important;' type='text' size='".strlen($orgcolor)."' name='loop[looper_".$line."][]' value='".$orgcolor."' class='form-control cellsitech-configtxtdisp'><input type='hidden' name='hidden[looper_".$line."][]' value='0' ></span></div>";
    											}
    										}; 
    									};
									};									
									fclose($fd); 
									echo $output;
									?>  
								</div>
								<br>
								<?php
									//$output = '<div class="form-group"><input class="btn" name="action" type = "submit" value = "SaveDB">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Saveasscriptfile">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Downloadsscriptfile"></div>';
									//$output = '<div class="form-group"> <input class="btn" name="action" type = "submit" value = "Save Configuration">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Download Script"></div>';
									$output = '<div class="form-group"> <input class="btn" name="action" type = "submit" value = "Save Configuration"></div>';
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
