<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

// Static variable values set
if (isset($_GET['clear'])) {
    if (strtolower($_GET['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

user_session_check();
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t="
	.<?php echo date('his'); ?>></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
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
										class="alert alert-success">Configurations Saved Successfully</div>
                                  	<?php }elseif($_SESSION['msg'] == 'fus'){ ?>
                                  		<div id="main-status"
										class="alert alert-success">File Saved Successfully</div>
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
										<strong>Error!</strong> File is not of the permitted type.
									</div>
                                  	<?php }elseif($_SESSION['msg'] == 'feps'){ ?>
                                  		<div id="main-status"
										class="alert alert-danger">
										<strong>Error!</strong> File exceeds permitted size.
									</div>
                                  	<?php }unset($_SESSION['msg']);?>
                                  	<div id="upload_status"
										style="display: none;" class="alert"></div>
									<div class="row">
										<div class="col-lg-4 tags p-b-2">
    										<form action="cellsite-config-process.php" method="post" id="config_file_uploader" enctype="multipart/form-data">
        							        	<div class="form-group">
                            				    <label for="file">Select a file to upload</label>
                            				    <input type="file"  id="file" name="file">
                            				    <p class="help-block">Only txt file with maximum size of 2 MB is allowed.</p>
                            				  	</div>
                            				  	<input type="submit" name="action" id="config-submit" class="btn" value="Upload">
                        					</form>
										</div>
										<div class="col-lg-8 tags p-b-2">
											<?php
							$filename = getcwd()."/upload/sampleconfigfile.txt";
							$output = '<form name="file_process" action="cellsite-config-process.php" method="post" class="border">';
							$output .= '<div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input type="checkbox" value="1" id="show_hide_readonly"/></div>';
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
        											if (substr_count(strtolower($color),"x") > 0 ){
        											    $output_inner .= '<input type="text" size="'.strlen($color).'" name="loop[looper_'.$line.'][]" value="'.$color.'"  style="background-color:pink;" class="form-control"><input type="hidden" name="hidden[looper_'.$line.'][]" value="1" >';
        											}else{
        											     if(strlen(trim($color))!=0){
        											         $output_inner .= '<input type="text" size="'.strlen($color).'" name="loop[looper_'.$line.'][]" value="'.$color.'" style="background-color:lightgrey;" readonly class="form-control" ><input type="hidden" name="hidden[looper_'.$line.'][]" value="0" >';
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
    											    $output .= '<div class="form-group"><span class="form-non-editable-fields"><input type="text" size="'.strlen($color).'" name="loop[looper_'.$line.'][]" value="'.$color.'" style="background-color:lightgrey;" readonly class="form-control"><input type="hidden" name="hidden[looper_'.$line.'][]" value="0" ></span></div>';
    											}
    										}; 
    									};
									};									
									fclose($fd); 
									echo $output;
									?>  
								</div>
								<?php
									//$output = '<div class="form-group"><input class="btn" name="action" type = "submit" value = "SaveDB">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Saveasscriptfile">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Downloadsscriptfile"></div>';
									$output = '<div class="form-group"> <input class="btn" name="action" type = "submit" value = "Save Configuration">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Download Script"></div>';
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

        <?php include ('footer.php'); ?> 
    </body>
</html>
