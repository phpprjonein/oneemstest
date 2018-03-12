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
<form data-licenseKey="" name="wizard-75a3c2" id="wizard-75a3c2" action='generate_script2.php' method='POST' enctype='multipart/form-data' novalidate autocomplete="on">
    <div class="row">

<!-- router selection content row -->
      <div class="col-4">
        <div class="jf-form">

<!-- router scripting selection form div -->
            <h5>SELECT TEMPLATE TYPE TO CREATE:</h5>
            <input type="hidden" name="method" value="validateForm">
            <input type="hidden" id="serverValidationFields" name="serverValidationFields" value= 	"">

<!-- select purpose options -->
            <?php 
				$configtmpddwndata = getconfigtempldpdwntbl('configscriptpurpose'); 
			?>
            <div class="form-group f4 required" data-fid="f4">
              <label class="control-label" for="f4">Select Purpose</label>
              <select id="select_purpose" class="form-control custom-select" id="f4" name="f4" data-rule-required="true">
                <option value="">- Select Purpose -</option>
				<?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				  <option value="<?php echo $val['desc'];?>"><?php echo $val['desc']; ?></option> 
				 <?php }; ?>
              </select>
            </div>
<!-- /select purpose options -->

<!-- select device series options -->
			<?php $configtmpddwndata = generic_get_deviceseries(); ?>
            <div class="form-group f7 required" data-fid="f7">
              <label class="control-label" for="f7">Select Device Series</label>
              <select id="select_device_series" class="form-control custom-select" id="f7" name="f7" data-rule-required="true">
              <option value="">- SELECT Device Series -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['deviceseries'];?>"><?php echo $val['deviceseries']; ?></option> 
			 <?php }; ?>	
              </select>
            </div>
<!-- /select device series options -->

<!-- select OS version options -->
			<?php $configtmpddwndata = generic_get_nodeVersion(); ?>
            <div class="form-group f8 required" data-fid="f8">
              <label class="control-label" for="f8">Select OS Version</label>
              <select id="select_os_version" class="form-control custom-select" id="f8" name="f8" data-rule-required="true">
              	<option value="">- SELECT OS Version -</option>
                <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				<option value="<?php echo $val['nodeVersion'];?>"><?php echo $val['nodeVersion']; ?></option> 
			 <?php }; ?>		
              </select>
            </div>
<!-- /select OS version options -->

<!-- select RAN vendor options --> 
			<?php  $configtmpddwndata =getconfigtempldpdwntbl('configscriptranvendor'); ?>
            <div class="form-group f9 required" data-fid="f9">
              <label class="control-label" for="f9">Select RAN vendor</label>
              <select id="select_ran_vendor" class="form-control custom-select" id="f9" name="f9" data-rule-required="true">
              	<option value="">- SELECT RAN vendor -</option>
			    <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['desc'];?>"><?php echo $val['desc']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select RAN vendor options -->
			<?php  $configtmpddwndata = getconfigtempldpdwntbl('configscripttype', 'type'); ?>
            <div class="form-group f10 required" data-fid="f10">
              <label class="control-label" for="f10">Select Script Type</label>
              <select id="select_script_type" class="form-control custom-select" id="f10" name="f10" data-rule-required="true">
                <option value="">- SELECT Script Type -</option>	
			   <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['type'];?>"><?php echo $val['type']; ?></option> 
				<?php }; ?>		
              </select>
            </div>
<!-- /select RAN vendor options -->

<!-- select region options -->
			<?php  $configtmpddwndata = generic_get_region(); ?>
            <div class="form-group f11 required" data-fid="f11">
              <label class="control-label" for="f11">Select Region</label>
              <select id="select_region" class="form-control custom-select" id="f11" name="f11" data-rule-required="true">
              	<option value="">- SELECT Region -</option>	
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                 <option value="<?php echo $val['region'];?>"><?php echo $val['region']; ?></option> 
			   <?php }; ?>		
              </select>
            </div>
<!-- /select region options -->

<!-- select switch type options -->
			<?php  $configtmpddwndata = generic_get_switch_name(); ?>
            <div class="form-group f12 required" data-fid="f12">
              <label class="control-label" for="f12">Select Switch Name</label>
              <select id="select_switch_name" class="form-control custom-select" id="f12" name="f12" data-rule-required="true">
              <option value="">- SELECT  Switch Name -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['switch_name'];?>"><?php echo $val['switch_name']; ?></option> 
			   <?php }; ?>			
              </select>
            </div>
<!-- /select switch type options -->

<!-- select market options -->
			<?php  $configtmpddwndata = generic_get_market(); ?>
            <div class="form-group f13 required" data-fid="f13">
              <label class="control-label" for="f13">Select Market</label>
              <select id="select_market" class="form-control custom-select" id="f13" name="f13" data-rule-required="true">
              <option value="">- SELECT  Market -</option>
			  <?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
                <option value="<?php echo $val['market'];?>"><?php echo $val['market']; ?></option> 
			  <?php }; ?>				
              </select>
            </div>
<!-- /select market options -->


            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <button type="submit" class="btn btn-primary btn-lg generate-script-submit" style="z-index: 1;">NEXT</button>
            </div>

            <div class="clearfix"></div>
<!-- /router scripting selection form div -->
        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col d-none" id="template_info">
        <!-- template output content -->
                <div class="row">
                  <div class="col">
                    <table class="table table-striped te">
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
        <!-- /template name content -->
        
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-lg generate-script-submit">SELECT</button>
          </div>
        </div>
        <!-- /right side -->
        <!-- /script output -->
    </div>
    
<!-- /backup management content row -->
				</div>
				</form>
			</section>
			<!-- /.content -->
		</div>
	</div>
	<!-- container-fluid -->

        <?php include ('footer.php'); ?> 
    </body>
</html>
