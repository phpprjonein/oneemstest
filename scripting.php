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
	<div class="container-fluid" id="cellsitech-config">
	<?php include ('menu.php'); ?> 
        <!-- Content Wrapper. Contains page content -->
		<div class="content">
			<!-- Main content -->
			<section class="content">
				<div class="col-md-12">
					<div class="panel panel-default">
    					<div id="status" style="display: none;" class="alert"></div>
    					<?php if($_SESSION['msg'] == 'dbs'){ ?>
                                  		<div id="main-status" class="alert alert-success">Configurations Saved Successfully</div>
                        <?php } unset($_SESSION['msg']); ?>
						<!-- backup management content row -->
	<form action="cellsitetech-configuration.php" method="post" id="config_file_uploader" enctype="multipart/form-data">						
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
                unset($_SESSION['filename']);
				$configtmpddwndata = getconfigtempldpdwntbl('configscriptpurpose'); 
			?>
            <div class="form-group">
              <label class="control-label" for="f4">Select Purpose</label>
              <select id="select_purpose" class="form-control custom-select" name="f4" data-rule-required="true">
                <option value="">- Select Purpose -</option>
				<?php foreach($configtmpddwndata['result'] as $key => $val) {;?> 			  
				  <option value="<?php echo $val['desc'];?>"><?php echo $val['desc']; ?></option> 
				 <?php }; ?>
              </select>
            </div>
<!-- /select purpose options -->
            <div class="form-group submitf0" data-fid="f0" style="position: relative;">
              <input type="submit" name="act" class="btn config-submit" value="NEXT">
            </div>

            <div class="clearfix"></div>
<!-- /router scripting selection form div -->

        </div>
      </div>
<!-- /router selection content row -->


<!-- right side -->
<!-- script output -->
      <div class="col">

<!-- template name content -->
        <div class="row">
          <div class="col d-none" id="template_info">
            <label for="inputRegion">TEMPLATE:</label>
            <small><b><span id="filename"></span></b></small>
            <!-- Golden_ASR920_15.6_ALL_standalone_GreatLakes_AKRON_opw_021418 -->
          </div>
        </div>
<!-- /template name content -->

<!-- browse / upload template -->
        <div class="row">
		
			<input type="hidden" name="filename" id="upload_filename">
			<!-- 
        	<div class="form-group">
		    <label for="file">Select a file to upload</label>
		    <input type="file"  id="file" name="file">
		    <p class="help-block">Please upload <b>.txt</b> files with a maximum size of 2 MB.</p>
		    		  	<input type="submit" name="act" class="btn config-submit" value="Upload">
		  	</div>
             -->
		
        </div>
<!-- /browse / upload template -->
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
