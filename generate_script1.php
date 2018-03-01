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
   <script src="resources/js/cellsitetech_config.js?t=<?php echo date('his'); ?>"></script>
   <script src="resources/js/cellsitetech_config_new.js?t=<?php echo date('his'); ?>"></script>
</head>
<body>
	<div class="container-fluid" id="cellsitech-generate-script">
	<?php include ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div id="status" style="display: none;" class="alert"></div>
<!-- backup management content row -->
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
          <form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='generate_script2.php' method='GET' enctype='multipart/form-data' novalidate autocomplete="on">
            <h5>SELECT SCRIPT TYPE TO CREATE:</h5>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value="">

<!-- select router model options -->
			<?php 
				$configtmpscriptddwndata =getconfigtemplscriptddwntbl(); 				
			?>
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Device Model</label>
              <select class="form-control custom-select" id="f4" name="f4" data-rule-required="true">
                <option value="">- SELECT MODEL -</option>
               <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select router model options -->

<!-- select router model options -->

            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select OS</label>
              <select class="form-control custom-select" id="f7" name="f7" data-rule-required="true">
              	<option value="">- Select OS -</option>
                <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['deviceos'];?>"><?php echo $val['deviceos']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select router model options -->

<!-- select template options -->
            <div class="form-group f8 required" data-fid="f8">
              <!-- <label class="control-label" for="f8">Select OS Configuration</label> -->
              <label class="control-label" for="f8">Select Template Type</label>
              <select class="form-control custom-select" id="f8" name="f8" data-rule-required="true">
              	<option value="">- Select Template Type -</option>
			   <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 
                	<option value="<?php echo $val['templtype'];?>"><?php echo $val['templtype']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select template options -->

<!-- select region options -->
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select Region</label>
              <select class="form-control custom-select" id="f9" name="f9" data-rule-required="true">
              	<option value="">- Select Region -</option>
                <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
                 <option value="<?php echo $val['region'];?>"><?php echo $val['region']; ?></option> 
			   <?php }; ?>		
              </select>
            </div>
<!-- /select region options -->

<!-- select RAN vendor options -->
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select RAN Vendor</label>
              <select class="form-control custom-select" id="f10" name="f10" data-rule-required="true">
              	<option value="">- Select RAN Vendor -</option>
                <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['ranvendor'];?>"><?php echo $val['ranvendor']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select service options -->
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Service</label>
              <select class="form-control custom-select" id="f11" name="f11" data-rule-required="true">
              <option value="">- Select Service -</option>
			  <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['service'];?>"><?php echo $val['service']; ?></option> 
			  <?php }; ?>		
              </select>
            </div>
<!-- /select service options -->

<!-- select site type options -->
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Site Type</label>
              <select class="form-control custom-select" id="f12" name="f12" data-rule-required="true">
              <option value="">- Select Site Type -</option>
              <?php foreach($configtmpscriptddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['sitetype'];?>"><?php echo $val['sitetype']; ?></option> 
			  <?php }; ?>	
              </select>
            </div>
<!-- /select site type options -->

<!-- submit button -->
            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <button type="submit" class="btn btn-primary btn-lg generate-script-submit" style="z-index: 1;">NEXT</button>
            </div>
<!-- /submit button -->

            <div class="clearfix"></div>
          </form>
<!-- /router scripting selection form div -->
        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
		<form name="loadtemplate" action="generate_script2.php" method="post" id="loadtemplate">
      <div class="col">
<!-- template output content -->
        <div class="row">
          <div class="col">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Template Name</th>
                    <th scope="col">Select Template</th>
                  </tr>
                </thead>
                <tbody>
                <?php $results = config_get_templates(); ?>	
                <?php foreach ($results as $key=>$val):?>
                  <tr>
                    <td><?php echo $val['templname'];?></td>
                    <td>
                      <input type="radio" value="<?php echo $val['templname'];?>" name="radioGroup">
                    </td>
                  </tr>
                 <?php endforeach;?> 
                  <tr>
                    <td>Golden_ASR1K_15.6_ALL_standalone_GreatLakes_MICHIGAN_opw_021418</td>
                    <td>
                      <input type="radio" name="radioGroup">
                    </td>
                  </tr>
                  
                  <tr>
                    <td>Golden_ASR910_15.6_ALL_standalone_GreatLakes_AKRON_opw_021418</td>
                    <td>
                      <input type="radio" name="radioGroup">
                    </td>
                  </tr>
                </tbody>
              </table>
              
          </div>
        </div>
<!-- /template name content -->

<div class="row">
  <div class="col">
    <button type="submit" class="btn btn-primary btn-lg">SELECT</button>
  </div>
</div>
<!-- /right side -->
<!-- /script output -->

    </div>
    </form>
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
