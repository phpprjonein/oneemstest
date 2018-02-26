<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

user_session_check();
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';

if ($_POST['act'] == 'Upload' || $_POST['act'] == 'NEXT'){
    if ($_FILES["file"]["type"] == "text/plain" && $_FILES["file"]["size"] < 65536) {
        //Remove if config file exist
        $filename = $_POST['filename']."_".$_SESSION['userid'].".txt";
        if(file_exists(getcwd()."/upload/".$filename)){
            unlink(getcwd()."/upload/".$filename);
        }
        if ($_FILES["file"]["error"] > 0) {
            $_SESSION['msg'] = 'fe';
            $_SESSION['msg-param']['fileerror'] = $_FILES["file"]["error"];
        } else {
            if (file_exists("upload/" . $filename)) {
                $_SESSION['msg'] = 'fae';
                $_SESSION['msg-param']['filename'] = $filename;
            } else {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$filename)) {
                    $_SESSION['msg'] = 'fus';
                }
            }
        }
    } else {
        if ($_FILES["file"]["type"] != "text/plain"){
            $_SESSION['msg'] = 'fte';
        }
        else if ($_FILES["file"]["size"] < 65536){
            $_SESSION['msg'] = 'feps';
        }
    }
    if($_SESSION['msg'] != 'fus'){
        header("location:scripting.php");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
   <script src="resources/js/cellsitetech_config_new.js?t=<?php echo date('his'); ?>"></script>
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
    					<div id="status" style="display: none;" class="alert"></div>
						<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" id="config-select-grp" name="wizard-75a3c2" id="wizard-75a3c2" action='scripting2.php' method='GET' enctype='multipart/form-data' novalidate autocomplete="on">
            <h5>SELECT TEMPLATE TYPE TO CREATE:</h5>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value= 	"">

<!-- select purpose options -->
            <?php 
				$configtmpddwndata =getconfigtempldpdwntbl(); 
			?>
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Purpose</label>
              <select disabled="disabled" id="select_purpose" class="form-control custom-select" id="f4" name="f4" data-rule-required="true">
                <option value="">- Select Purpose -</option>
				<?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				  <option value="<?php echo $val['purpose'];?>" <?php if($_POST['f4'] == $val['purpose']) : ?>selected<?php endif; ?>><?php echo $val['purpose']; ?></option> 
				 <?php }; ?>
              </select>
            </div>
<!-- /select purpose options -->

<!-- select device series options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select Device Series</label>
              <select disabled="disabled" id="select_device_series" class="form-control custom-select" id="f7" name="f7" data-rule-required="true">
              <option value="">- SELECT Device Series -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['deviceseries'];?>" <?php if($_POST['f7'] == $val['deviceseries']) : ?>selected<?php endif; ?>><?php echo $val['deviceseries']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select device series options -->

<!-- select OS version options -->
            <div class="form-group f8 required" data-fid="f8">
              <label class="control-label" for="f8">Select OS Version</label>
              <select disabled="disabled" id="select_os_version" class="form-control custom-select" id="f8" name="f8" data-rule-required="true">
              	<option value="">- SELECT OS Version -</option>
                <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['nodeVersion'];?>" <?php if($_POST['f8'] == $val['nodeVersion']) : ?>selected<?php endif; ?>><?php echo $val['nodeVersion']; ?></option> 
			 <?php }; ?>		
              </select>
            </div>
<!-- /select OS version options -->

<!-- select RAN vendor options --> 
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select RAN vendor</label>
              <select disabled="disabled" id="select_ran_vendor" class="form-control custom-select" id="f9" name="f9" data-rule-required="true">
              	<option value="">- SELECT RAN vendor -</option>
			    <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['ranvendor'];?>" <?php if($_POST['f9'] == $val['ranvendor']) : ?>selected<?php endif; ?>><?php echo $val['ranvendor']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select Script Type</label>
              <select disabled="disabled" id="select_script_type" class="form-control custom-select" id="f10" name="f10" data-rule-required="true">
                <option value="">- SELECT Script Type -</option>	
			   <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['scripttype'];?>" <?php if($_POST['f10'] == $val['scripttype']) : ?>selected<?php endif; ?>><?php echo $val['scripttype']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select region options --> 
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select disabled="disabled" id="select_region" class="form-control custom-select" id="f11" name="f11" data-rule-required="true">
              	<option value="">- SELECT Region -</option>	
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                 <option value="<?php echo $val['region'];?>" <?php if($_POST['f11'] == $val['region']) : ?>selected<?php endif; ?>><?php echo $val['region']; ?></option> 
			   <?php }; ?>		
              </select>
            </div>
<!-- /select region options -->

<!-- select switch type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Name</label>
              <select disabled="disabled" id="select_switch_name" class="form-control custom-select" id="f12" name="f12" data-rule-required="true">
              <option value="">- SELECT  Switch Name -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['switch_name'];?>" <?php if($_POST['f12'] == $val['switch_name']) : ?>selected<?php endif; ?>><?php echo $val['switch_name']; ?></option> 
			   <?php }; ?>			
              </select>
            </div>
<!-- /select switch type options -->

<!-- select market options -->
            <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
              <select disabled="disabled" id="select_market" class="form-control custom-select" id="f13" name="f13" data-rule-required="true">
              <option value="">- SELECT  Market -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['market'];?>" <?php if($_POST['f13'] == $val['market']) : ?>selected<?php endif; ?>><?php echo $val['market']; ?></option> 
			  <?php }; ?>				
              </select>
            </div>
<!-- /select market options -->

<!-- submit button
            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <button type="submit" class="btn btn-primary btn-lg" style="z-index: 1;">NEXT</button>
            </div>
submit button -->

            <div class="clearfix"></div>
          </form>
<!-- /router scripting selection form div -->

        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col">
										<div class="col-lg-12 tags p-b-2">
											<?php
											$filename = getcwd()."/upload/".$filename;
							if(!file_exists($filename)){
							    $filename = getcwd()."/upload/Default_Gold_ASR920_Great-Lakes_Allnew.txt";
							}
							$output = '<form name="file_process" action="scripting-config-process.php" method="post" class="border">';
							$output .= '<div class="form-group cb-control"><label>Hide Readonly Fields&nbsp;</label><input type="checkbox" value="1" id="show_hide_readonly"/></div>';
							$output .= '<input type="hidden" name="templname" value="'.$_POST['filename'].'" />';
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
									$output = '<div class="form-group"> <input class="btn" name="action" type = "submit" value = "Save Configuration">&nbsp;&nbsp;&nbsp;<input class="btn" name="action" type = "submit" value = "Download Script"></div>';
									$output .= '</form>'; 
									echo $output;
								?> 
								<?php } ?>	
								</div>

    </div>
<!-- /backup management content row -->
				</div>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

        <?php include ('footer.php'); ?> 
    </body>
</html>