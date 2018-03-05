<?php
include "classes/db2.class.php";
include "classes/paginator.class.php";
include 'functions.php';

// Static variable values set
if (isset($_POST['clear'])) {
    if (strtolower($_POST['clear']) == 'search') {
        unset($_SESSION['search_term']);
    }
}

$templname = $_POST['radioGroup'];
//$templname = 'Golden_purpose1_xe_1561_ranvendor1_scripttype1_region1_switch1_market1';

user_session_check();
check_user_authentication('1'); // cellsite tech type user

$page_title = 'OneEMS';
?>
<!DOCTYPE html>
<html>
<head>
   <?php include("includes.php");  ?>
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='admin.php' method='post' enctype='multipart/form-data' novalidate autocomplete="on">
            <p style="word-wrap:break-word;"><small><b><?php echo $templname; ?></b></small></p>
            <hr>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value="">

<!-- select purpose options -->
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Purpose</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f4'];?>"><?php echo $_POST['f4']; ?></option> 
                <!-- <option value="asr920">XXXX</option> -->
              </select>
            </div>
<!-- /select purpose options -->

<!-- select device series options -->
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select Device Series</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true" disabled>
                <!-- <option value="">ASR9210</option>  -->
               <option value="<?php echo $_POST['f7'];?>"><?php echo $_POST['f7'];?></option> 
              </select>
            </div>
<!-- /select device series options -->

<!-- select OS version options -->
            <div class="form-group f8 required" data-fid="f8">
              <label class="control-label" for="f8">Select OS Version</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f8'];?>"><?php echo $_POST['f8'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select OS version options -->

<!-- select RAN vendor options -->
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select RAN vendor</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true" disabled>
                <!-- <option value="">ALL</option> -->
                <option value="<?php echo $_POST['f9'];?>"><?php echo $_POST['f9'];?></option> 
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select Script Type</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f10'];?>"><?php echo $_POST['f10'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select region options -->
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true" disabled>
                <option value="">Great Lakes</option>
                <option value="<?php echo $_POST['f11'];?>"><?php echo $_POST['f11'];?></option> 
              </select>
            </div>
<!-- /select region options -->

<!-- select switch type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f12'];?>"><?php echo $_POST['f12'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select switch type options -->

<!-- select market options -->
            <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
              <select class="form-control custom-select" id="f13" name="f13" data-rule-required="true" disabled>
                <option value="<?php echo $_POST['f13'];?>"><?php echo $_POST['f13'];?></option> 
                <option></option>
              </select>
            </div>
<!-- /select market options -->

            <div class="clearfix"></div>
          </form>
<!-- /router scripting selection form div -->

        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col-8">

<!-- template output content -->
        <div class="row">
          <div class="col">
			<?php $results = config_get_templates_from_templname($templname);?>

			<?php foreach ($results as $key=>$val):?>
			<?php $newarr[intval($val['elemid']/10)][] = array('elemid' => $val['elemid'], 'elemvalue' => $val['elemvalue'], 'editable' => $val['editable']); ?>
			<?php endforeach;?>
			
			<?php 
//			print '<pre>';
//			print_r($newarr);die;
			
			?>
			
			
			
			<form name="file_process" action="cellsite-config-process.php" method="post" class="border">
			<div class="scroller tags p-b-2">
			<div id="file_process">
            <?php 
			$output = '<div id="file_process">';
			for ($k=1;$k<=count($newarr);$k++){
			    if(count($newarr[$k]) == 1){
                    $output .= '<div class="form-group"><input type="text" style="display:none !important;" name="loop[looper_'.$k.'][]" value="'.$newarr[$k][0]['elemvalue'].'">';
                    
                    $output .= '<label class="readonly">'.$newarr[$k][0]['elemvalue'].'</label></div>';
                    
                }else{
                    $output .= '<div class="form-group">';
                    for ($l=0;$l<=count($newarr[$k][0]);$l++){
                        
                        $output .= '<label class="readonly">'.$newarr[$k][$l]['elemvalue'].'</label>';
                        
                        $output .= '<input type="text" style="display:none !important;" name="loop[looper_'.$k.'][]" value="'.$newarr[$k][$l]['elemvalue'].'">';
                    }
                    $output .= '</div>';
                }
                
            }
            echo $output .= '</div></div>';
            ?>
			</div>
                <br>
                <div class="form-group"><button type="submit" value="Download Script" name="action" class="btn btn-primary btn-lg">DOWNLOAD</button></div>
                </div>
                </form>
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
        <?php include ('footer.php'); ?> 
    </body>
</html>
